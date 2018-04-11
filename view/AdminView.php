<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 10/4/2018
 * Time: 18:42
 */

namespace View;


class AdminView extends BasicView
{

    public $operaciones;

    public function __construct()
    {
        parent::__construct('admin', 'Administración');
    }

    protected function getPage()
    {
        return $this->operaciones;
    }

    public function showAccion($operacion){
        return $operacion->ultimo_estado === 'RESERVADO' || $operacion->ultimo_estado === 'PRESTADO';
    }

    public function getFormAction($operacion){
        return $operacion->ultimo_estado === 'RESERVADO' ? $this->getUrl('/prestar') : $this->getUrl('/devolver');
    }

    public function getButtonText($operacion){
        return $operacion->ultimo_estado === 'RESERVADO' ? 'PRESTAR' : 'DEVOLVER';
    }
}