<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class CustomerValidator
{
    public static function validateCreateCustomer(array $customer)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'cpfCnpj' => 'required|string',
            'phone' => 'nullable|string',
            'mobilePhone' => 'nullable|string',
            'address' => 'nullable|string',
            'addressNumber' => 'nullable|string',
            'complement' => 'nullable|string',
            'province' => 'nullable|string',
            'postalCode' => 'nullable|string',
            'externalReference' => 'nullable|string',
            'notificationDisabled' => 'nullable|boolean',
            'additionalEmails' => 'nullable|string',
            'municipalInscription' => 'nullable|string',
            'stateInscription' => 'nullable|string',
            'observations' => 'nullable|string',
            'groupName' => 'nullable|string',
            'company' => 'nullable|string',
            'foreignCustomer' => 'nullable|boolean'
        ];

        $validator = Validator::make($customer, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    public static function validateUpdateCustomer(array $customer)
    {
        $rules = [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'cpfCnpj' => 'nullable|string',
            'phone' => 'nullable|string',
            'mobilePhone' => 'nullable|string',
            'address' => 'nullable|string',
            'addressNumber' => 'nullable|string',
            'complement' => 'nullable|string',
            'province' => 'nullable|string',
            'postalCode' => 'nullable|string',
            'externalReference' => 'nullable|string',
            'notificationDisabled' => 'nullable|boolean',
            'additionalEmails' => 'nullable|string',
            'municipalInscription' => 'nullable|string',
            'stateInscription' => 'nullable|string',
            'observations' => 'nullable|string',
            'groupName' => 'nullable|string',
            'company' => 'nullable|string',
            'foreignCustomer' => 'nullable|boolean'
        ];

        $validator = Validator::make($customer, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}
