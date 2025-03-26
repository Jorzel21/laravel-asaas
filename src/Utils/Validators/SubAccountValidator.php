<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class SubAccountValidator
{
    public static function validateCreateSubAccount(array $subAccount)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'loginEmail' => 'nullable|email',
            'cpfCnpj' => 'required|string',
            'birthDate' => 'nullable|date_format:Y-m-d',
            'companyType' => 'required|string|in:MEI,LIMITED,INDIVIDUAL,ASSOCIATION',
            'phone' => 'nullable|string',
            'mobilePhone' => 'required|string',
            'site' => 'nullable|url',
            'incomeValue' => 'required|numeric',
            'address' => 'required|string',
            'addressNumber' => 'required|string',
            'complement' => 'nullable|string',
            'province' => 'required|string',
            'postalCode' => 'required|string:8',
            'webhooks' => 'nullable|array',
            'webhooks.name' => 'nullable|string',
            'webhooks.url' => 'nullable|url',
            'webhooks.email' => 'nullable|email',
            'webhooks.enabled' => 'nullable|boolean',
            'webhooks.interrupted' => 'nullable|boolean',
            'webhooks.apiVersion' => 'nullable|integer',
            'webhooks.authToken' => 'nullable|string',
            'webhooks.sendType' => 'nullable|string|in:SEQUENTIALLY, NON_SEQUENTIALLY',
            'webhooks.events' => 'nullable|array',
        ];

        $validator = Validator::make($subAccount, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}
