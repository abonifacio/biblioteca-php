<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 21:50
 */

namespace Entity;


class Usuario extends AbstractEntity
{
    public $email;
    public $nombre;
    public $apellido;
    public $foto;
    public $clave;
    public $rol;

    public function __construct()
    {
        $this->rol = 'LECTOR';
    }

    public static function getTable()
    {
        return "usuarios";
    }

    public function getFullName(){
        return $this->nombre.' '.$this->apellido;
    }

    public function getFoto(){
        return "data:image/jpg;base64,".base64_encode($this->foto);
    }

}