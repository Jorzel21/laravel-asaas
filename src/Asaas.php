<?php

namespace Asaas;

class Asaas
{
    public function customer($apiKey)
    {
        return new Customer($apiKey);
    }

    public function creditCard($apiKey)
    {
        return new CreditCard($apiKey);
    }

    public function payment($apiKey)
    {
        return new Payment($apiKey);
    }

    public function pix($apiKey)
    {
        return new Pix($apiKey);
    }
    public function subAccount($apiKey)
    {
        return new SubAccount($apiKey);
    }

    public function webhook($apiKey)
    {
        return new Webhook($apiKey);
    }
}
