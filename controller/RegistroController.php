<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 19:35
 */

namespace Controller;


use Entity\Usuario;
use Repository\UsuarioRepository;
use Utils\AuthenticactionService;
use View\RegistroView;

class RegistroController extends BasicController
{

    /**
     * @throws \Exception\NotAuthorizedException
     */
    public function register()
    {
        $errors = $this->validatePresent();
        if(count($errors)>0){
            $this->form($errors);
            return;
        }
        $foto = $_FILES['foto']['tmp_name'];
        $u = new Usuario();
        $u->apellido = $this->post_params['apellido'];
        $u->nombre = $this->post_params['nombre'];
        $u->email = $this->post_params['email'];
        $u->foto = $foto;
        $u->clave = $this->post_params['password'];

        $errors = $this->validateRules($u);
        if(count($errors)>0){
            $this->form($errors,$u);
            return;
        }

        if(UsuarioRepository::emailExists($u->email)){
            $this->form(['El email ya está registrado'],$u);
            return;
        }

        try{
            UsuarioRepository::save($u);
        }catch (\Exception $e){
            $this->form([$e->getMessage()],$u);
            return;
        }

        AuthenticactionService::authenticate($u->email,$u->clave);

        $this->redirectTo('/');
    }

    public function form($errors = [],$u = null){
        $view = new RegistroView($errors,$u);
        parent::initView($view);
    }


    private function validatePresent(){
        $errors = [];
        if(empty($this->post_params['email'])){
            array_push($errors,'El email es obligatorio');
        }
        if(empty($this->post_params['nombre'])){
            array_push($errors,'El nombre es obligatorio');
        }
        if(empty($this->post_params['apellido'])){
            array_push($errors,'El apellido es obligatorio');
        }
        if(empty($this->post_params['password'])){
            array_push($errors,'La contraseña es obligatoria');
        }
        if(empty($this->post_params['confirm_password'])){
            array_push($errors,'La confirmación de contraseña es obligatoria');
        }
        if(!isset($_FILES['foto'])){
            array_push($errors,'La foto es obligatoria');
        }
        return $errors;
    }

    private function validateRules(){
        $errors = [];
        if(!preg_match('/^[a-z]+$/i',$this->post_params['nombre'])){
            array_push($errors,'El nombre debe contener sólo letras');
        }
        if(!preg_match('/^[a-z]+$/i',$this->post_params['apellido'])){
            array_push($errors,'El apellido debe contener sólo letras');
        }
        if(!filter_var($this->post_params['email'], FILTER_VALIDATE_EMAIL)){
            array_push($errors,'El email no es válido');
        }
        if(strlen($this->post_params['password'])<6){
            array_push($errors,'La contraseña debe tener al menos 6 caracteres');
        }
        if(!preg_match('/[a-z]{1,}/',$this->post_params['password'])){
            array_push($errors,'La contraseña debe tener al menos 1 caracter en minúscula');
        }
        if(!preg_match('/[A-Z]{1,}/',$this->post_params['password'])){
            array_push($errors,'La contraseña debe tener al menos 1 caracter en mayúscula');
        }
        if(!preg_match('/([0-9]|\W){1,}/',$this->post_params['password'])){
            array_push($errors,'La contraseña debe tener al menos 1 número o símbolo');
        }
        if($this->post_params['confirm_password']!==$this->post_params['password']){
            array_push($errors,'La contraseñas no coinciden');
        }
        return $errors;
    }
}