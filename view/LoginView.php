<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 16:03
 */

namespace View;


class LoginView extends BasicView
{
    public $email = '';
    public $error = '';

    public function __construct($params = [])
    {
        $this->email = isset($params['email']) ? $params['email'] : '';
        $this->error = isset($params['error']) ? $params['error'] : '';
        parent::__construct('login', 'Login');
    }

    public function mustShowSearch()
    {
        return false;
    }
}