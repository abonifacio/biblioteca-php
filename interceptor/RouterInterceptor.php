<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 16:44
 */

namespace Interceptor;

interface RouterInterceptor
{

    /**
     * @param $routerParams
     * @param $postParams
     * @throws \Exception
     */
    function intercept($routerParams, $postParams);
}