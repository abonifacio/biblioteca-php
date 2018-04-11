<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:08
 */

namespace View;

use Utils\AuthenticactionService;
use Utils\Router;

abstract class BasicView
{
    private $STATIC_DIRS = [
        '/.*\.css/'=>'css',
        '/.*\.js/'=>'js',
        '/.*\.(png|jpg)/'=>'images',
    ];

    public $templateUrl;
    public $title;
    public $queryParams = [];
    private $alert = null;

    public function __construct($template,$title='Biblioteca')
    {
        $this->templateUrl = $template;
        $this->title = $title;
    }

    public function init(){
        $this->render('common');
    }

    public function render($template = null) {
        $template = is_null($template) ? $this->templateUrl : $template;
        ob_start();
        include(__DIR__.'/../templates/'.$template.'.php');
        $rendered = ob_get_clean();
        echo $rendered;
    }

    public function getStatic($file){
        foreach ($this->STATIC_DIRS as $regex => $dir){
            if(preg_match($regex,$file)){
                return $_SERVER['CONTEXT_PREFIX'].'/static/'.$dir.'/'.$file;
            }
        }
        return 'not-found';
    }

    public function getUrl($path = null){
        return Router::getUrl($path);
    }

    public function getQueryParam($param){
        return empty($this->queryParams[$param]) ? '' : $this->queryParams[$param];
    }

    public function isLoggedIn(){
        return AuthenticactionService::isAuthenticated();
    }

    public function isBibliotecario(){
        return AuthenticactionService::isAuthenticated() && AuthenticactionService::getCurrentRol()==='BIBLIOTECARIO';
    }

    public function isLector(){
        return AuthenticactionService::isAuthenticated() && !$this->isBibliotecario();
    }

    public function getCurrentEmail(){
        return AuthenticactionService::getCurrentEmail();
    }

    protected function getPage(){
        return FALSE;
    }

    public function isFirstPage(){
        $page = $this->getPage();
        if(!$page) return TRUE;
        return $page->page==1;
    }

    public function isLastPage(){
        $page = $this->getPage();
        if(!$page) return TRUE;
        return $page->page==ceil($page->count / $page->size);
    }

    public function prevPageUrl(){
        $page = $this->getPage();
        if(!$page || $this->isFirstPage()) return '';
        return Router::getCurrentUrlWithPage($page->page-1);
    }

    public function nextPageUrl(){
        $page = $this->getPage();
        if(!$page || $this->isLastPage()) return '';
        return Router::getCurrentUrlWithPage($page->page+1);
    }

    public function getPages(){
        $page = $this->getPage();
        if(!$page) return [];
        $numPages = ceil($page->count / $page->size);
        $pages = [];
        for($i = 1; $i<=$numPages;$i++){
            array_push($pages,[
                'active'=>$i==$page->page,
                'number'=>$i,
                'url'=>Router::getCurrentUrlWithPage($i)
            ]);
        }
        return $pages;
    }

    public function getSizeUrl($size){
        return Router::getSizeUrl($size);
    }

    public function setAlert($alert): void
    {
        $this->alert = $alert;
    }

    public function isAlert(){
        return !is_null($this->alert);
    }

    public function getAlertMessage(){
        return $this->alert['message'];
    }

    public function getAlertType(){
        return $this->alert['type'];
    }

}