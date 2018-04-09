<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 21:34
 */

namespace View;


use Entity\Usuario;

class RegistroView extends BasicView
{
    public $errors;
    public $usuario;

    public function __construct($errors = [],$usuario = null)
    {
        parent::__construct('registro', 'Registro');
        $this->errors = $errors;
        $this->usuario = is_null($usuario) ? new Usuario() : $usuario;
    }
}