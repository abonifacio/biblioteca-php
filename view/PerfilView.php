<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 9/4/2018
 * Time: 22:29
 */

namespace View;


class PerfilView extends BasicView
{

    public $operaciones;
    public $user;

    public function __construct()
    {
        parent::__construct('perfil', 'Perfil');
    }

    protected function getPage()
    {
        return $this->operaciones;
    }
}