<?php

namespace Asaas;

use Asaas\Utils\Validators\CreditCardValidator;

class CreditCard
{
    public $http;

    public function __construct(protected string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    public function tokenize(array $creditCard)
    {
        CreditCardValidator::tokenize($creditCard);
        $this->http->post('v3/creditCard/tokenizeCreditCard', $creditCard);
    }
}
