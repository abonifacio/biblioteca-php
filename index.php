<?php


use Controller\LibrosController;
use Controller\LoginController;
use Exception\FordibbenException;
use Exception\NotAuthorizedException;
use Exception\NotFoundException;
use Utils\Router;

session_start();


require_once 'autoloader.php';


    Router::add('/', ['controller' => 'Libros', 'action' => 'all']);
    Router::add('/libros/{id:\d+}',['controller' => 'Libros', 'action' => 'get']);
    Router::add('/autores/{id:\d+}',['controller' => 'Autores', 'action' => 'get']);
    Router::add('/login',['controller' => 'Login', 'action' => ['GET'=>'form','POST'=>'login']]);
    Router::add('/logout',['controller' => 'Login', 'action' => 'logout']);
    Router::add('/registrarse',['controller' => 'Registro', 'action' => ['GET'=>'form','POST'=>'register']]);
    Router::add('/reservar',['controller' => 'Libros', 'action' => 'reservar','interceptors'=>['Lector']]);
    Router::add('/perfil',['controller' => 'Usuario', 'action' => 'perfil','interceptors'=>['Lector']]);
    Router::add('/admin',['controller' => 'Usuario', 'action' => 'admin','interceptors'=>['Bibliotecario']]);
    Router::add('/prestar',['controller' => 'Usuario', 'action' => 'prestar','interceptors'=>['Bibliotecario']]);
    Router::add('/devolver',['controller' => 'Usuario', 'action' => 'devolver','interceptors'=>['Bibliotecario']]);

$path = isset($_SERVER['PATH_INFO'])? $_SERVER['PATH_INFO'] : '/';
    try {
        Router::dispatch($path);
    } catch (NotAuthorizedException $e){
        Router::dispatch('/login','GET',['error'=>$e->getMessage(),'email'=>$e->email]);
    } catch (FordibbenException $e){
        Router::dispatch('/login','GET',['error'=>'Debe tener rol de bibliotecario para realizar esta operacion']);
    } catch (NotFoundException $e){
        echo $e->getMessage();
//        \Utils\Router::redirect('/');
    } catch (Exception $e) {
        print_r($e);
    }

?>