<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:52
 */

namespace View;


class LibroDetalleView extends BasicView
{
    public $libro = [];
    public $autor = [];

    public function __construct()
    {
        parent::__construct('libro-detalle', 'Libro: ');
    }

}