<?php


use Controller\LibrosController;
use Controller\LoginController;
use Exception\FordibbenException;
use Exception\NotAuthorizedException;
use Exception\NotFoundException;

session_start();

require_once 'autoloader.php';

    $router = new Utils\Router();

    $router->add('', ['controller' => 'Libros', 'action' => 'all']);
    $router->add('/libros/{id:\d+}',['controller' => 'Libros', 'action' => 'get']);
    $router->add('/autores/{id:\d+}',['controller' => 'Autores', 'action' => 'get']);
    $router->add('/login',['controller' => 'Login', 'action' => ['GET'=>'form','POST'=>'login']]);
    $router->add('/logout',['controller' => 'Login', 'action' => 'logout']);
    $router->add('/registrarse',['controller' => 'Registro', 'action' => ['GET'=>'form','POST'=>'register']]);

$path = isset($_SERVER['PATH_INFO'])? $_SERVER['PATH_INFO'] : '';
    try {
        $router->dispatch($path);
    } catch (NotAuthorizedException $e){
        $router->dispatch('/login','GET',['error'=>$e->getMessage(),'email'=>$e->email]);
    } catch (FordibbenException $e){
        $router->dispatch('/login','GET',['error'=>'Debe tener rol de bibliotecario para realizar esta operacion']);
    } catch (NotFoundException $e){
        \Utils\Router::redirect('/');
    } catch (Exception $e) {
        print_r($e);
    }

?>