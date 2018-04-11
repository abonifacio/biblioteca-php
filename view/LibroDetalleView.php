<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:52
 */

namespace View;


use Entity\Libro;

class LibroDetalleView extends BasicView
{
    public $libro = [];
    public $autor = [];

    public function __construct(Libro $libro)
    {
        parent::__construct('libro-detalle', 'Libro: '.$libro->titulo);
        $this->libro = $libro;
    }

}