<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class PixValidator
{
    public static function validateCreateStaticQrCode(array $data)
    {
        $rules = [
            'addressKey' => 'nullable|string',
            'description' => 'nullable|string',
            'value' => 'nullable|numeric',
            'format' => 'nullable|string:ALL,IMAGE,PAYLOAD',
            'expirationDate' => 'nullable|datetime:Y-m-d H:i:s',
            'expirationSeconds' => 'nullable|integer',
            'allowsMultiplePayments' => 'nullable|boolean',
            'externalReference' => 'nullable|string:100',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}
