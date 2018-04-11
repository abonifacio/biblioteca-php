<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 17:12
 */

namespace Repository;


use Entity\Usuario;

class UsuarioRepository extends AbstractRepository
{

    protected static function getEntity()
    {
        return Usuario::class;
    }

    public static function findByEmailAndPassword($user,$pass){
        return parent::findOne("SELECT * FROM usuarios where email = ? and clave = ?",['ss',$user,$pass]);
    }

    /**
     * @param Usuario $user
     * @throws \Exception
     */
    public static function save(Usuario $user){
        $foto = file_get_contents($user->foto);
        $sql = "INSERT INTO usuarios (email,nombre,apellido,foto,clave,rol) values (?,?,?,?,?,'LECTOR')";
        parent::insert($sql,['sssss',$user->email,$user->nombre,$user->apellido,$foto,$user->clave]);
    }

    public static function emailExists($email){
        return parent::count("SELECT COUNT(*) FROM usuarios where email = ?",['s',$email])>0;
    }

}