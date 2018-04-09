<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 21:49
 */

namespace Entity;


class Autor extends AbstractEntity
{

    public $nombre;
    public $apellido;

    public static function getTable()
    {
        return "autores";
    }

    public function getFullName(){
        return $this->nombre.' '.$this->apellido;
    }
}