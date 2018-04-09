<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 17:02
 */

namespace Interceptor;


use Exception\FordibbenException;
use Exception\NotAuthorizedException;
use Utils\AuthenticactionService;

class BibliotecarioInterceptor implements RouterInterceptor
{

    /**
     * @param $routerParams
     * @param $postParams
     * @throws FordibbenException
     * @throws NotAuthorizedException
     */
    function intercept($routerParams, $postParams)
    {
        $user = AuthenticactionService::getCurrentUser();
        if($user->rol!=='BIBLIOTECARIO') throw new FordibbenException();
    }
}