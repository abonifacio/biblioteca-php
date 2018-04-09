<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:52
 */

namespace View;


class LibrosListadoView extends BasicView
{
    public $libros = [];

    public function __construct()
    {
        parent::__construct('libros-listado', 'Biblioteca');
    }

    protected function getPage()
    {
        return $this->libros;
    }
}