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
use Repository\OperacionRepository;
use Utils\AuthenticactionService;
use Utils\Router;
use View\LibroDetalleView;
use View\LibrosListadoView;

class LibrosController extends BasicController
{

    public function all()
    {
        $view = new LibrosListadoView();
        $view->libros = LibroRepository::findAll($this->route_params,$this->pager_params);
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

    public function get(){
        $view = new LibroDetalleView(LibroRepository::get($this->route_params['id']));
        $view->autor = AutorRepository::get($view->libro->autores_id);
        parent::initView($view);
    }

    public function reservar(){
        $redirect = $this->post_params['current_url'];
        $libro = $this->post_params['libro_id'];
        $user_id = AuthenticactionService::getCurrentId();
        $reservados = OperacionRepository::countReservadosOPrestadosForUser($user_id);
        if($reservados>2){
            Router::redirect($redirect,Router::errorMessage('No se pueden reservar más de 3 libros en simultáneo'));
            return;
        }
        $reservados = OperacionRepository::countReservadosOPrestadosForLibro($libro);
        $libroObject = LibroRepository::get($libro);
        if($libroObject->cantidad<$reservados+1){
            Router::redirect($redirect,Router::errorMessage('El libro no tiene ejemplares disponibles'));
            return;
        }
        if(OperacionRepository::userTieneLibro($user_id,$libro)){
            Router::redirect($redirect,Router::errorMessage('El usuario ya tiene el libro reservado o prestado'));
            return;
        }
        OperacionRepository::create($user_id,$libro);
        Router::redirect($redirect,Router::successMessage('Libro reservado correctamente'));
    }


}