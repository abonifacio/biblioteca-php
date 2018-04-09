<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 22:47
 */

namespace Utils;


class DBConnection
{

    public static function get(){
        return new \mysqli("localhost","root","","biblioteca");
    }

}