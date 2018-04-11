<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 6/4/2018
 * Time: 21:54
 */

namespace Repository;

use Entity\Page;
use \Utils\DBConnection;

abstract class AbstractRepository
{

    protected static abstract function getEntity();


    public static function get($id){
        $table = static::getEntity()::getTable();
        $res = self::execute("SELECT * FROM $table WHERE id = ?",['d',$id]);
        $row = $res['rows']->fetch_array(MYSQLI_ASSOC);
        return static::getEntity()::fromAssociativeArray($row);
    }

    protected static function page($sql,$params=[],$pager = []){
        $page = !empty($pager['page']) && is_numeric($pager['page']) ? intval($pager['page']) : 1;
        $size = !empty($pager['size']) && is_numeric($pager['size']) ? intval($pager['size']) : 5;
        $sql = str_replace("SELECT", "SELECT SQL_CALC_FOUND_ROWS", $sql);
        $sql = $sql." LIMIT $size OFFSET ".$size*($page-1);
        $res = self::execute($sql,$params);
        $content = self::extractResult($res['rows']);
        $count = $res['count'];

        return new Page($content,$count,$page,$size);
    }

    protected static function count($sql,$params = []){
        return self::execute($sql,$params)['rows']->fetch_row()[0];
    }

    /**
     * @param $sql
     * @param array $params
     * @throws \Exception
     */
    protected static function insert($sql, $params=[]){
        if(!self::execute($sql,$params,true)){
            throw new \Exception('Se produjo un error al persistir los datos');
        }
    }

    protected static function update($sql, $params=[]){
        if(!self::execute($sql,$params,true)){
            throw new \Exception('Se produjo un error al persistir los datos');
        }
    }

    protected static function findOne($sql,$params = []){
        $res = self::execute($sql,$params);
        $list = self::extractResult($res['rows']);
        if($list && count($list)==1){
            return $list[0];
        }
        return null;
    }

    private static function execute($sql, $params = [], $returnStatus = false){
        $db = DBConnection::get();
        $stmt = $db->prepare($sql);
//        echo $sql;
        if(count($params)>1){
            $values = array_slice($params, 1);
            $stmt->bind_param($params[0],...$values);
        }
        $execution = $stmt->execute();
        if($returnStatus){
            return $execution;
        }
        $rows = $stmt->get_result();
        $count = $db->query('SELECT FOUND_ROWS();')->fetch_row()[0];
        return [
            'rows'=>$rows,
            'count'=>$count
        ];
    }

    private static function extractResult($res){
        $content = [];
        while($row = $res->fetch_array(MYSQLI_ASSOC)) {
            array_push($content, static::getEntity()::fromAssociativeArray($row));
        }
        return $content;
    }

    protected static function formatParams($params){
        $types = "";
        foreach($params as $param){
            $types .= is_numeric($param) ? 'd' : 's';
        }
        array_unshift($params, $types);
        return $params;
    }
}