<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class CreditCardValidator
{
    public static function tokenize(array $creditCard)
    {
        $rules = [
            'customer' => 'required|string',
            'remoteIp' => 'required|string',
            // Credit Card Information
            'creditCard' => 'required|array',
            'creditCard.holderName' => 'required|string',
            'creditCard.number' => 'required|string',
            'creditCard.expiryMonth' => 'required|string:2',
            'creditCard.expiryYear' => 'required|string:4',
            'creditCard.ccv' => 'required|string',
            // Holder Information
            'creditCardHolderInfo' => 'required|array',
            'creditCardHolderInfo.name' => 'required|string',
            'creditCardHolderInfo.email' => 'required|email',
            'creditCardHolderInfo.cpfCnpj' => 'required|string',
            'creditCardHolderInfo.postalCode' => 'required|string:8',
            'creditCardHolderInfo.addressNumber' => 'required|string',
            'creditCardHolderInfo.addressComplement' => 'nullable|string',
            'creditCardHolderInfo.phone' => 'required|string',
            'creditCardHolderInfo.mobilePhone' => 'nullable|string',
        ];

        $validator = Validator::make($creditCard, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}
