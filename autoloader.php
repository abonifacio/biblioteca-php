<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 30/3/2018
 * Time: 12:59
 */

spl_autoload_register(function ($clazz) {

    $clazz = str_replace('\\','/',$clazz);
    $clazz = lcfirst($clazz);

//    echo $clazz;
    include_once $clazz.'.php';
});