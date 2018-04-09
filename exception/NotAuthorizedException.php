<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 8/4/2018
 * Time: 16:39
 */

namespace Exception;

use Throwable;

class NotAuthorizedException extends \Exception
{
    public $email;

    public function __construct(string $message = "",string $email = "")
    {
        parent::__construct($message);
        $this->email = $email;
    }

}