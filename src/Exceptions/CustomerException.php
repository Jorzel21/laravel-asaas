<?php

namespace Luanrodrigues\Asaas\Exceptions;

use Exception;

class CustomerException extends Exception
{
    public static function invalidClient()
    {
        return new static('The data provided for the customer registration is not valid. Type: Array | Keys: "name", "cpfCnpj" and "email".');
    }
}
