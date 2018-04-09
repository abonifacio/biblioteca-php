<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 12:46
 */

namespace Repository;


use Entity\Autor;

class AutorRepository extends AbstractRepository
{

    protected static function getEntity()
    {
        return Autor::class;
    }
}