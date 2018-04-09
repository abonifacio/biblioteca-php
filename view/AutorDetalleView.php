<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:52
 */

namespace View;


class AutorDetalleView extends BasicView
{
    public $autor = [];
    public $libros = [];

    public function __construct()
    {
        parent::__construct('autor-detalle', 'Autor: ');
    }

    protected function getPage()
    {
        return $this->libros;
    }
}