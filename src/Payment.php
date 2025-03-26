<?php

namespace Asaas;

use Asaas\Utils\Validators\PaymentValidator;

class Payment
{
    public $http;

    protected $payment;

    public function __construct(string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * List payments
     *
     * @see https://docs.asaas.com/reference/list-payments
     *
     * @param string name
     * @return json
     */
    public function list(array $queryParams = [])
    {
        $queryString = http_build_query($queryParams);
        $url = 'v3/payments' . ($queryString ? '?' . $queryString : '');

        return $this->http->get($url);
    }

    /**
     * Get payment
     *
     * @see https://docs.asaas.com/reference/retrieve-a-single-payment
     *
     * @param  string  $id
     * @return array
     */
    public function get(string $id)
    {
        return $this->http->get('v3/payments/' . $id);
    }

    /**
     * Create payment
     *
     * @see https://docs.asaas.com/reference/create-new-paymentt
     *
     * @param  array  $payment
     * @return array
     */
    public function create(array $payment)
    {
        PaymentValidator::validateCreatePayment($payment);
        return $this->http->post('v3/payments', $payment);
    }

    /**
     * Update existing charge
     *
     * @see https://docs.asaas.com/reference/update-existing-payment
     *
     * @param  string  $id
     * @param  array  $payment
     * @return array
     */
    public function update(string $id, array $payment)
    {
        PaymentValidator::validateUpdatePayment($payment);
        return $this->http->put('v3/payments/' . $id, $payment);
    }


    /**
     * Capture payment with pre authorization
     *
     * @see https://docs.asaas.com/reference/capture-payment-with-pre-authorization
     *
     * @param  string  $id
     * @return array
     */
    public function capturePaymentWithPreAuthorization(string $id)
    {
        return $this->http->post('v3/payments/' . $id . '/captureAuthorizedPayment');
    }

    /**
     * Pay charge with credit card
     *
     * @see https://docs.asaas.com/reference/pay-a-charge-with-credit-card
     *
     * @param  string  $id
     * @return array
     */
    public function payChargeWithCreditCard(string $id)
    {
        return $this->http->post('v3/payments/' . $id . '/payWithCreditCard');
    }

    /**
     * Get QR Code for Pix
     *
     * @see https://docs.asaas.com/reference/get-qr-code-for-pix-payments
     *
     * @param  string  $id
     * @return array
     */
    public function getQrCodeForPix(string $id)
    {
        return $this->http->get('v3/payments/' . $id . '/pixQrCode');
    }

    /**
     * Get Digitable Bill Line
     *
     * @see https://docs.asaas.com/reference/get-digitable-bill-line
     *
     * @param  string  $id
     * @return array
     */
    public function getDigitableBillLine(string $id)
    {
        return $this->http->get('v3/payments/' . $id . '/identificationField');
    }

    /**
     * Confirm payment as cash payment
     *
     * @see https://docs.asaas.com/reference/confirm-cash-receipt
     *
     * @param  string  $id
     * @param  array  $params
     * @return array
     */
    public function payed(string $id, array $params)
    {
        PaymentValidator::validatePayed($params);
        return $this->http->post('v3/payments/' . $id . '/receiveInCash', $params);
    }

    /**
     * Reverse a credit card charge
     *
     * @see https://docs.asaas.com/reference/refund-payment
     *
     * @param  string  $id
     * @param  array  $param
     * @return array
     */
    public function refund(string $id, array $params)
    {
        PaymentValidator::validateRefund($params);
        return $this->http->post('v3/payments/' . $id . '/refund', $params);
    }

    /**
     * Remove an existing charge.
     *
     * @see https://docs.asaas.com/reference/remove-existing-charge
     *
     * @param  string  $id
     * @return Json
     */
    public function delete(string $id)
    {
        return $this->http->delete('v3/payments/' . $id);
    }
}
