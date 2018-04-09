<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 21:39
 */

namespace Entity;


abstract class AbstractEntity
{

    public static abstract function getTable();

    public $id;

    public static function fromAssociativeArray($array){
        $clazz = get_called_class();
        $obj = new $clazz();
        foreach ($array as $field => $value){
            if(property_exists($clazz,$field)){
                $obj->$field = $value;
            }
        }
        return $obj;
    }
}