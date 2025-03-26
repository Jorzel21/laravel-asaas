<?php

namespace Luanrodrigues\Asaas\Exceptions;

use Exception;

class SubAccountException extends Exception
{
    public static function invalidConta()
    {
        return new static('The data provided for the account registration is not valid. Type: Array | Keys: "name", "cpfCnpj" and "email".');
    }
}
