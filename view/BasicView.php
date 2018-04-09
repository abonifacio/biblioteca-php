<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:08
 */

namespace View;

use Utils\AuthenticactionService;

abstract class BasicView
{
    private $STATIC_DIRS = [
        '/.*\.css/'=>'css',
        '/.*\.js/'=>'js'
    ];

    public $templateUrl;
    public $title;
    public $queryParams = [];

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

    public function getUrl($path){
        return $_SERVER['CONTEXT_PREFIX'].$path;
    }

    public function getQueryParam($param){
        return empty($this->queryParams[$param]) ? '' : $this->queryParams[$param];
    }

    public function isLoggedIn(){
        return AuthenticactionService::isAuthenticated();
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
        return $this->getCurrentUrlWithPage($page->page-1);
    }

    public function nextPageUrl(){
        $page = $this->getPage();
        if(!$page || $this->isLastPage()) return '';
        return $this->getCurrentUrlWithPage($page->page+1);
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
                'url'=>$this->getCurrentUrlWithPage($i)
            ]);
        }
        return $pages;
    }

    private function getCurrentUrlWithPage($pageNum){
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $tmp = $_GET;
        $tmp['page'] = $pageNum;
        return $url.'?'.http_build_query($tmp);
    }

    public function getSizeUrl($size){
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $tmp = $_GET;
        $tmp['size'] = $size;
        return $url.'?'.http_build_query($tmp);
    }

}