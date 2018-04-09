<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 17:01
 */

namespace Interceptor;


use Exception\NotAuthorizedException;
use Utils\AuthenticactionService;

class AuthenticatedInterceptor implements RouterInterceptor
{

    /**
     * @param $routerParams
     * @param $postParams
     * @throws NotAuthorizedException
     */
    function intercept($routerParams, $postParams)
    {
        if(!AuthenticactionService::isAuthenticated()) throw new NotAuthorizedException('Debe estar autenticado para realizar esta operación');
    }
}