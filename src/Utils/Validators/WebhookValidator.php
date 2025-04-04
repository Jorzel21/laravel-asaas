<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class WebhookValidator
{
    public static function validateCreate(array $data)
    {
        $rules = [
            'name' => 'nullable|string',
            'url' => 'nullable|string',
            'email' => 'nullable|string',
            'enabled' => 'nullable|boolean',
            'interrupted' => 'nullable|boolean',
            'apiVersion' => 'nullable|integer',
            'authToken' => 'nullable|string',
            'sendType' => 'nullable|string:SEQUENTIALLY,NON_SEQUENTIALLY',
            'events' => 'nullable|array',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}
