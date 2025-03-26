<?php

namespace Asaas\Utils\Validators;

use Illuminate\Support\Facades\Validator;

class PaymentValidator
{
    public static function validateCreatePayment(array $payment)
    {
        $rules = [
            'customer' => 'required|string',
            'billingType' => 'required|string|in:PIX,BOLETO,CREDIT_CARD',
            'value' => 'required|numeric',
            'dueDate' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string',
            'daysAfterDueDateToRegistrationCancellation' => 'nullable|integer',
            'externalReference' => 'nullable|string',
            'installmentCount' => 'nullable|integer',
            'totalValue' => 'nullable|numeric',
            'installmentValue' => 'nullable|numeric',
            'discount' => 'nullable|array',
            'discount.value' => 'nullable|numeric',
            'discount.dueDateLimitDays' => 'nullable|integer',
            'discount.type' => 'nullable|string|in:PERCENTAGE,FIXED',
            'interest' => 'nullable|array',
            'interest.value' => 'nullable|numeric',
            'fine' => 'nullable|array',
            'fine.value' => 'nullable|numeric',
            'fine.type' => 'nullable|string|in:PERCENTAGE,FIXED',
            'postalService' => 'nullable|boolean',
            'split' => 'nullable|array',
            'split.walletId' => 'required|string',
            'split.fixedValue' => 'nullable|numeric',
            'split.percentualValue' => 'nullable|numeric',
            'split.totalFixedValue' => 'nullable|numeric',
            'split.externalReference' => 'nullable|string',
            'split.description' => 'nullable|string',
            'callback' => 'nullable|array',
            'callback.successUrl' => 'required|url',
            'callback.autoRedirect' => 'nullable|boolean',
        ];

        if ($payment['billingType'] === 'CREDIT_CARD') {
            if (empty($payment['creditCardToken'])) {
                $rules = array_merge($rules, [
                    'creditCard' => 'required|array',
                    'creditCard.holderName' => 'required|string',
                    'creditCard.number' => 'required|string',
                    'creditCard.expiryMonth' => 'required|string',
                    'creditCard.expiryYear' => 'required|string',
                    'creditCard.cvv' => 'required|string',
                    'creditCardHolderInfo' => 'required|array',
                    'creditCardHolderInfo.name' => 'required|string',
                    'creditCardHolderInfo.email' => 'required|email',
                    'creditCardHolderInfo.cpfCnpj' => 'required|string',
                    'creditCardHolderInfo.postalCode' => 'required|string',
                    'creditCardHolderInfo.addressNumber' => 'required|string',
                    'creditCardHolderInfo.addressComplement' => 'nullable|string',
                    'creditCardHolderInfo.phone' => 'required|string',
                    'creditCardHolderInfo.mobilePhone' => 'nullable|string',
                    'authorizeOnly' => 'nullable|boolean',
                    'remoteIp' => 'required|string',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'creditCardToken' => 'required|string',
                    'authorizeOnly' => 'nullable|boolean',
                    'remoteIp' => 'required|string',
                ]);
            }
        }

        $validator = Validator::make($payment, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    public static function validateUpdatePayment(array $payment)
    {
        $rules = [
            'customer' => 'required|string',
            'billingType' => 'required|string|in:PIX,BOLETO,CREDIT_CARD',
            'value' => 'required|numeric',
            'dueDate' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string',
            'daysAfterDueDateToRegistrationCancellation' => 'nullable|integer',
            'externalReference' => 'nullable|string',
            'installmentCount' => 'nullable|integer',
            'totalValue' => 'nullable|numeric',
            'installmentValue' => 'nullable|numeric',
            'discount' => 'nullable|array',
            'discount.value' => 'nullable|numeric',
            'discount.dueDateLimitDays' => 'nullable|integer',
            'discount.type' => 'nullable|string|in:PERCENTAGE,FIXED',
            'interest' => 'nullable|array',
            'interest.value' => 'nullable|numeric',
            'fine' => 'nullable|array',
            'fine.value' => 'nullable|numeric',
            'fine.type' => 'nullable|string|in:PERCENTAGE,FIXED',
            'postalService' => 'nullable|boolean',
            'split' => 'nullable|array',
            'split.walletId' => 'required|string',
            'split.fixedValue' => 'nullable|numeric',
            'split.percentualValue' => 'nullable|numeric',
            'split.totalFixedValue' => 'nullable|numeric',
            'split.externalReference' => 'nullable|string',
            'split.description' => 'nullable|string',
            'callback' => 'nullable|array',
            'callback.successUrl' => 'required|url',
            'callback.autoRedirect' => 'nullable|boolean',
        ];

        $validator = Validator::make($payment, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    public static function validatePayed(array $param)
    {
        $rules = [
            'paymentDate' => 'nullable|date_format:Y-m-d',
            'value' => 'nullable|numeric',
            'notifyCustomer' => 'nullable|boolean',
        ];

        $validator = Validator::make($param, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    public static function validateRefund(array $param)
    {
        $rules = [
            'value' => 'nullable|numeric',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($param, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }
}