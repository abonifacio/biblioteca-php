<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 9/4/2018
 * Time: 19:36
 */

namespace Repository;


use Entity\Operacion;

class OperacionRepository extends AbstractRepository
{

    protected static function getEntity()
    {
        return Operacion::class;
    }

    public static function findOperacion($libroId,$userId){
        return parent::findOne("SELECT * FROM operaciones WHERE libros_id = ? and lector_id = ?",['dd',$libroId,$userId]);
    }

    public static function setEstado($operacionId,$estado){
        parent::update("UPDATE operaciones SET ultimo_estado = ? WHERE id = ?",['sd',$estado,$operacionId,]);
    }

    public static function create($userId,$libroId,$estado){
        parent::insert("INSERT INTO operaciones (ultimo_estado,fecha_ultima_modificacion,lector_id,libros_id) VALUES (?,NOW(),?,?)",['sdd',$estado,$userId,$libroId]);
    }

    public static function countReservadosOPrestadosForUser($user_id){
        return parent::count("SELECT COUNT(*) FROM operaciones where ultimo_estado in ('RESERVADO','PRESTADO') and lector_id = $user_id");
    }

    public static function countReservados($libroId){
        return parent::count("SELECT count(*) FROM operaciones WHERE ultimo_estado = 'RESERVADO' AND libros_id = $libroId");
    }

    public static function countPrestados($libroId){
        return parent::count("SELECT count(*) FROM operaciones WHERE ultimo_estado = 'PRESTADO' AND libros_id = $libroId");
    }

    public static function countReservadosOPrestadosForLibro($libroId){
        return parent::count("SELECT count(*) FROM operaciones WHERE ultimo_estado in ('PRESTADO','RESERVADO') AND libros_id = ?",['d',$libroId]);
    }

    public static function userTieneLibro($userId,$libroId){
        return 0<parent::count("SELECT COUNT(*) FROM operaciones where lector_id = ? and libros_id = ? and ultimo_estado in ('PRESTADO','RESERVADO')",['dd',$userId,$libroId]);
    }

    public static function findAllOperacionesForUser($userId, $pager){
        $sql = "SELECT o.*, l.titulo libroTitulo, l.portada libroPortada, a.nombre autorNombre, a.apellido autorApellido, a.id autorId FROM operaciones o "
            ."INNER JOIN libros l on o.libros_id = l.id "
            ."INNER JOIN autores a on a.id = l.autores_id "
            ."WHERE o.lector_id = ?";
        return parent::page($sql,['d',$userId],$pager);
    }

    public static function findAll($filter,$pager){
        $sql = "SELECT o.*, l.titulo libroTitulo, l.portada libroPortada, a.nombre autorNombre, a.apellido autorApellido, a.id autorId, u.nombre lectorNombre, u.apellido lectorApellido FROM operaciones o "
            ."INNER JOIN libros l on o.libros_id = l.id "
            ."INNER JOIN usuarios u on o.lector_id = u.id "
            ."INNER JOIN autores a on a.id = l.autores_id ";
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
        if(!empty($filter['lector'])){
            array_push($conds,'(u.nombre like ? or u.apellido like ?)');
            array_push($params,"%".$filter['lector']."%");
            array_push($params,"%".$filter['lector']."%");
        }
        if(!empty($filter['desde']) && !empty($filter['hasta'])){
            array_push($conds,'o.fecha_ultima_modificacion BETWEEN ? and ?');
            array_push($params,$filter['desde']);
            array_push($params,$filter['hasta']);
        }
        if(count($conds)>0){
            $sql .= " WHERE ".join(" and ",$conds);
        }
        return parent::page($sql,self::formatParams($params),$pager);
    }

}