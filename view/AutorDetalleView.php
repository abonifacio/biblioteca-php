<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 1/4/2018
 * Time: 14:52
 */

namespace View;


use Entity\Autor;

class AutorDetalleView extends BasicView
{
    public $autor = [];
    public $libros = [];

    public function __construct(Autor $autor)
    {
        parent::__construct('autor-detalle', 'Autor: '.$autor->getFullName());
        $this->autor = $autor;
    }

    protected function getPage()
    {
        return $this->libros;
    }
}