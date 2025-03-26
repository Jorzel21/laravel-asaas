<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Asaas\Exceptions;

use Exception;

/**
 * Description of CobrancaException
 *
 * @author Rafael
 */
class PaymentException extends Exception
{
    public static function invalidInvoice()
    {   
        return new static('The data provided for the invoice is not valid. Type: Array | Keys: "customer", "billingType", "value" and "dueDate".');
    }
}
