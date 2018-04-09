<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 23:29
 */

namespace Repository;


use Entity\Libro;

class LibroRepository extends AbstractRepository
{

    protected static function getEntity()
    {
        return Libro::class;
    }

    public static function findAll($filter,$pager){
        $sql = "SELECT l.*, a.nombre autorNombre, a.apellido autorApellido FROM libros l
          INNER JOIN autores a ON l.autores_id = a.id";
        $conds = array();
        $params = array();
        if(!empty($filter['titulo'])){
            array_push($conds,'l.titulo like ?');
            array_push($params,"%".$filter['titulo']."%");
        };
        if(!empty($filter['autor'])){
            array_push($conds,'(a.nombre like ? or a.apellido like ?)');
            array_push($params,"%".$filter['autor']."%");
            array_push($params,"%".$filter['autor']."%");
        }
        if(count($conds)>0){
            $sql .= " WHERE ".join(" and ",$conds);
        }
        return self::page($sql,self::formatParams($params),$pager);
    }

    public static function forAutor($id,$pager){
        $sql = "SELECT * FROM libros where autores_id = ?";
        $params = [$id];
        return self::page($sql,self::formatParams($params),$pager);
    }

    public static function countReservados($libroId){
        return parent::count(self::getSQLForCountOperaciones('RESERVADO',$libroId));
    }

    public static function countPrestados($libroId){
        return parent::count(self::getSQLForCountOperaciones('PRESTADO',$libroId));
    }


    private static function getSQLForCountOperaciones($estado,$libroId){
        return "SELECT count(*) FROM operaciones WHERE ultimo_estado = '$estado' AND libros_id = $libroId";
    }
}