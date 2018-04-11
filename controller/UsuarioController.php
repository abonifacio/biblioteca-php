<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 9/4/2018
 * Time: 22:28
 */

namespace Controller;


use Repository\OperacionRepository;
use Utils\AuthenticactionService;
use Utils\Router;
use View\AdminView;
use View\PerfilView;

class UsuarioController extends BasicController
{

    public function perfil(){
        $view = new PerfilView();
        $view->operaciones = OperacionRepository::findAllOperacionesForUser(AuthenticactionService::getCurrentId(),$this->pager_params);
        $view->user = AuthenticactionService::getCurrentUser();
        parent::initView($view);
    }

    public function admin(){
        $view = new AdminView();
        $view->operaciones = OperacionRepository::findAll($this->route_params,$this->pager_params);
        parent::initView($view);
    }

    public function prestar(){
        $this->setEstado('PRESTADO','prestó');
    }

    public function devolver(){
        $this->setEstado('DEVUELTO','devolvió');
    }

    private function setEstado($estado,$mensaje){
        $redirect = $this->post_params['current_url'];
        $operacionId = $this->post_params['operacion_id'];
        $operacion = OperacionRepository::get($operacionId);
        print_r($estado);
        if($operacion->ultimo_estado===$estado){
            Router::redirect($redirect,Router::warningMessage("Libro ya se econtraba $estado"));
            return;
        }
        OperacionRepository::setEstado($operacionId,$estado);
        Router::redirect($redirect,Router::successMessage("Se $mensaje el libro"));
    }
}

