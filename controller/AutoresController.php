<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 30/3/2018
 * Time: 15:35
 */

namespace Controller;

use Repository\AutorRepository;
use Repository\LibroRepository;
use Repository\OperacionRepository;
use Utils\AuthenticactionService;
use View\AutorDetalleView;

class AutoresController extends BasicController
{

    public function get(){
        $view = new AutorDetalleView(AutorRepository::get($this->route_params['id']));
        $view->libros = LibroRepository::forAutor($this->route_params['id'],$this->pager_params);
        foreach ($view->libros->content as $libro){
            $libro->reservados = OperacionRepository::countReservados($libro->id);
            $libro->prestados = OperacionRepository::countPrestados($libro->id);
            if(AuthenticactionService::isAuthenticated()){
                $userId = AuthenticactionService::getCurrentId();
                $libro->currentUserHasIt = OperacionRepository::userTieneLibro($userId,$libro->id);
            }
        }
        parent::initView($view);
    }
}