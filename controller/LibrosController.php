<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 30/3/2018
 * Time: 13:29
 */


namespace Controller;

use Repository\AutorRepository;
use Repository\LibroRepository;
use View\LibroDetalleView;
use View\LibrosListadoView;

class LibrosController extends BasicController
{

    public function all()
    {
        $view = new LibrosListadoView();
        $view->libros = LibroRepository::findAll($this->route_params,$this->pager_params);
        foreach ($view->libros->content as $libro){
            $libro->reservados = LibroRepository::countReservados($libro->id);
            $libro->prestados = LibroRepository::countPrestados($libro->id);
        }
        parent::initView($view);
    }

    public function get(){
        $view = new LibroDetalleView();
        $view->libro = LibroRepository::get($this->route_params['id']);
        $view->autor = AutorRepository::get($view->libro->autores_id);
        parent::initView($view);
    }
}