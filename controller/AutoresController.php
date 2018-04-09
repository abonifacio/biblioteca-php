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
use View\AutorDetalleView;

class AutoresController extends BasicController
{

    public function get(){
        $view = new AutorDetalleView();
        $view->autor = AutorRepository::get($this->route_params['id']);
        $view->libros = LibroRepository::forAutor($this->route_params['id'],$this->pager_params);
        foreach ($view->libros->content as $libro){
            $libro->reservados = LibroRepository::countReservados($libro->id);
            $libro->prestados = LibroRepository::countPrestados($libro->id);
        }
        parent::initView($view);
    }
}