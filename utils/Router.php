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

    private $routes = [];

    private $params = [];

    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);

        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    private function addQueryParams(){
        $query_params = array();
        parse_str($_SERVER['QUERY_STRING'], $query_params);
        $this->params = array_merge($query_params,$this->params);
    }

    /**
     * @param $url
     * @param null $method
     * @param array $params
     * @throws NotFoundException
     * @throws \Exception
     */
    public function dispatch($url, $method = null,$params = [])
    {

        if (!$this->match($url)) throw new NotFoundException('Ninguna url fue encontrada: '.$url, 404);

        if(is_null($method)) $method = $_SERVER['REQUEST_METHOD'];

        $this->params = array_merge($params,$this->params);
        $this->addQueryParams();

        $controller = $this->params['controller'];
        $controller = 'Controller\\' . $controller. 'Controller';

        if (!class_exists($controller)) throw new \Exception("Controller $controller no existe");

        if(isset($this->params['interceptors'])){
            foreach ($this->params['interceptors'] as $int_name){
                $interceptor = 'Interceptor\\' . $int_name. 'Interceptor';
                if(!class_exists($interceptor)) throw new \Exception("Interceptor $interceptor no existe");
                $interceptor_object = new $interceptor();
                $interceptor_object->intercept($this->params,$_POST);
            }
        }

        $controller_object = new $controller($this->params,$_POST);

        if(is_array($this->params['action'])){
            $action = $this->params['action'][$method];
        }else{
            $action = $this->params['action'];
        }

        if (!preg_match('/action$/i', $action) == 0) throw new \Exception("Metodo $action de controller $controller no existe");

        $controller_object->$action();

    }

    public static function redirect($path){
        header('Location: '.$_SERVER['CONTEXT_PREFIX'].$path);
    }

}