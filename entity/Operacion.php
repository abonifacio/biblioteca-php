<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 9/4/2018
 * Time: 19:37
 */

namespace Entity;


class Operacion extends AbstractEntity
{

    public $ultimo_estado;
    public $fecha_ultima_modificacion;
    public $lector_id;
    public $libros_id;
    public $libroPortada;
    public $libroTitulo;
    public $autorNombre;
    public $autorApellido;
    public $lectorNombre;
    public $lectorApellido;
    public $autorId;

    public static function getTable()
    {
        return "operaciones";
    }

    public function getPortada(){
        return "data:image/jpg;base64,".base64_encode($this->libroPortada);
    }

    public function getAutorFullName()
    {
        return $this->autorNombre." ".$this->autorApellido;
    }

    public function getLectorFullName()
    {
        return $this->lectorNombre." ".$this->lectorApellido;
    }
}