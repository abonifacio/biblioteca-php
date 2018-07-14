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
                if(is_string($value) && !in_array($field,static::excluirAcentos())){
                    $obj->$field = htmlentities ($value,ENT_IGNORE,'ISO8859-1');
                }else{
                    $obj->$field = $value;
                }
            }
        }
        return $obj;
    }

    public static function excluirAcentos(){
        return [];
    }
}