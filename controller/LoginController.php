<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 16:02
 */

namespace Controller;


use Exception\NotAuthorizedException;
use Utils\AuthenticactionService;
use View\LoginView;

class LoginController extends BasicController
{
    /**
     * @throws NotAuthorizedException
     */
    public function login()
    {
        $email = $this->post_params['email'];
        $password = $this->post_params['password'];
        AuthenticactionService::authenticate($email,$password);
        $this->redirectTo('/');
    }

    public function form(){
        $view = new LoginView($this->route_params);
        parent::initView($view);
    }

    public function logout(){
        AuthenticactionService::unAuthenticate();
        $this->redirectTo('/');
    }

}