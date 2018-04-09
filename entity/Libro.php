<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 21:48
 */

namespace Entity;


class Libro extends AbstractEntity
{

    public $titulo;
    public $portada;
    public $descripcion;
    public $autores_id;
    public $autorNombre;
    public $autorApellido;
    public $cantidad;
    public $prestados;
    public $reservados;

    public static function getTable()
    {
        return "libros";
    }

    public function getPortada(){
        return "data:image/jpg;base64,".base64_encode($this->portada);
    }

    public function getDisponibles(){
        return $this->cantidad - $this->prestados - $this->reservados;
    }

}