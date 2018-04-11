<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 31/3/2018
 * Time: 16:50
 */
namespace Utils;

use Exception\NotFoundException;

class Router
{

    private static $routes = [];

    private static $params = [];

    public static function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);

        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = '/^' . $route . '$/i';

        Router::$routes[$route] = $params;
    }

    public static function match($url)
    {
        foreach (Router::$routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                Router::$params = $params;
                return true;
            }
        }

        return false;
    }

    private static function addQueryParams(){
        $query_params = array();
        parse_str($_SERVER['QUERY_STRING'], $query_params);
        Router::$params = array_merge($query_params,Router::$params);
    }

    /**
     * @param $url
     * @param null $method
     * @param array $params
     * @param array $alerts
     * @throws NotFoundException
     * @throws \Exception
     */
    public static function dispatch($url, $method = null,$params = [])
    {

        if (!Router::match($url)) throw new NotFoundException('Ninguna url fue encontrada: '.$url, 404);

        if(is_null($method)) $method = $_SERVER['REQUEST_METHOD'];

        Router::$params = array_merge($params,Router::$params);
        Router::addQueryParams();

        $controller = Router::$params['controller'];
        $controller = 'Controller\\' . $controller. 'Controller';

        if (!class_exists($controller)) throw new \Exception("Controller $controller no existe");

        if(isset(Router::$params['interceptors'])){
            foreach (Router::$params['interceptors'] as $int_name){
                $interceptor = 'Interceptor\\' . $int_name. 'Interceptor';
                if(!class_exists($interceptor)) throw new \Exception("Interceptor $interceptor no existe");
                $interceptor_object = new $interceptor();
                $interceptor_object->intercept(Router::$params,$_POST);
            }
        }
        if(isset($_COOKIE['AlertMessage']) && isset($_COOKIE['AlertType'])){
            $alert = ['message'=>$_COOKIE['AlertMessage'],'type'=>$_COOKIE['AlertType']];
            setcookie('AlertMessage','',time()-1);
            setcookie('AlertType','',time()-1);
            $controller_object = new $controller(Router::$params,$_POST,$alert);
        }else{
            $controller_object = new $controller(Router::$params,$_POST);
        }

        if(is_array(Router::$params['action'])){
            $action = Router::$params['action'][$method];
        }else{
            $action = Router::$params['action'];
        }

        if (!preg_match('/action$/i', $action) == 0) throw new \Exception("Metodo $action de controller $controller no existe");

        $controller_object->$action();

    }

    public static function redirect($path,$alert = null){
        if(!is_null($alert)){
            setcookie("AlertMessage",$alert['message'],time()+360);
            setcookie("AlertType",$alert['type'],time()+360);
        }
        header('Location: '.$_SERVER['CONTEXT_PREFIX'].$path);
    }

    public static function getUrl($path = null){
        if(is_null($path)){
            return substr($_SERVER['REQUEST_URI'],strlen($_SERVER['CONTEXT_PREFIX']));
        }
        return $_SERVER['CONTEXT_PREFIX'].$path;
    }

    public static function getCurrentUrlWithPage($pageNum){
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $tmp = $_GET;
        $tmp['page'] = $pageNum;
        return $url.'?'.http_build_query($tmp);
    }

    public static function getSizeUrl($size){
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $tmp = $_GET;
        $tmp['size'] = $size;
        return $url.'?'.http_build_query($tmp);
    }

    public static function errorMessage($msg){
        return ['message'=>$msg,'type'=>'danger'];
    }

    public static function successMessage($msg){
        return ['message'=>$msg,'type'=>'success'];
    }

    public static function warningMessage($msg){
        return ['message'=>$msg,'type'=>'warning'];
    }

}