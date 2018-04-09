<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 17:06
 */

namespace Utils;


use Exception\NotAuthorizedException;
use Repository\UsuarioRepository;

class AuthenticactionService
{
    public static function isAuthenticated(){
        return isset($_SESSION['user_id']);
    }

    public static function getCurrentEmail(){
        return isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
    }

    public static function getCurrentRol(){
        return isset($_SESSION['user_rol']) ? $_SESSION['user_rol'] : '';
    }

    /**
     * @param $email
     * @param $password
     * @throws NotAuthorizedException
     */
    public static function authenticate($email, $password){
        $user = UsuarioRepository::findByEmailAndPassword($email,$password);
        if(!$user) throw new NotAuthorizedException('Email o contraseña incorrecta',$email);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_rol'] = $user->rol;
    }

    public static function unAuthenticate(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_rol']);
    }

    /**
     * @throws NotAuthorizedException
     */
    public static function getCurrentUser(){
        if(!self::isAuthenticated()) throw new NotAuthorizedException('Debe estar autenticado para realizar esta operación');
        return UsuarioRepository::get($_SESSION['user_id']);
    }

}