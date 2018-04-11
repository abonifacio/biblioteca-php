<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 9/4/2018
 * Time: 22:39
 */

namespace Interceptor;


use Exception\FordibbenException;
use Utils\AuthenticactionService;

class LectorInterceptor implements RouterInterceptor
{

    /**
     * @param $routerParams
     * @param $postParams
     * @throws FordibbenException
     * @throws \Exception\NotAuthorizedException
     */
    function intercept($routerParams, $postParams)
    {
        AuthenticactionService::getCurrentId();
        if(AuthenticactionService::getCurrentRol()!=='LECTOR') throw new FordibbenException();
    }
}