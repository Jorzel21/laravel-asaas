<?php

namespace Asaas\Api\Exceptions;

use Exception;

class AccessTokenException extends Exception
{
    public static function invalidToken()
    {
        return new static('The token provided is invalid.');
    }
}
