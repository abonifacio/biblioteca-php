<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 30/3/2018
 * Time: 14:00
 */

namespace Controller;

use Utils\Router;

abstract class BasicController
{
    protected $route_params;
    protected $pager_params;
    protected $post_params;

    public function __construct($route_params = [],$post_params = [])
    {
        $this->pager_params = array();
        $this->extractParamIntoPage($route_params,'size');
        $this->extractParamIntoPage($route_params,'page');
        $this->route_params = $route_params;
        $this->post_params = $post_params;
    }

    private function extractParamIntoPage($params,$name){
        if(isset($params[$name])){
            $this->pager_params[$name] = $params[$name];
            unset($params[$name]);
        }
    }

    protected function initView($view){
        $view->queryParams = $this->route_params;
        $view->init();
    }

    protected function redirectTo($path){
        Router::redirect($path);
    }

}