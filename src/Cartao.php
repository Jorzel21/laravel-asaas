<?php

namespace Luanrodrigues\Asaas;

use Luanrodrigues\Asaas\Exceptions\CobrancaException;

class Cartao
{
    public $http;

    protected $card;

    public function __construct($apiKey)
    {
        $this->http = new Connection($apiKey, 'v2');
    }

    /**
     * Tokeniza Cartão de Crédito.
     *
     * @param  array  $param
     * @return array
     *
     * @see ??
     */
    public function tokenize($param)
    {
        return $this->http->post('/creditCard/tokenizeCreditCard', ['json' => $param]);
    }

    /**
     * Realiza Cobrança no cartão de crédito.
     *
     * @param  array  $param
     * @return array
     *
     * @see ??
     */
    public function charge($param)
    {
        return $this->http->post('/creditCard/tokenizeCreditCard', ['json' => $param]);
    }

    /**
     * Faz merge nas informações do cartao.
     *
     * @param  array  $card
     * @return array
     *
     * @see
     */
    public function setCard($card)
    {
        try {
            if (! $this->card_valid($card)) {
                throw CobrancaException::invalidInvoice();
            }

            $this->cartao = [
                'creditCardHolderFullName' => '',
                'creditCardHolderEmail' => '',
                'creditCardHolderCpfCnpj' => '',
                'creditCardHolderAddressNumber' => '',
                'creditCardHolderAddressComplement' => '',
                'creditCardHolderPostalCode' => '',
                'creditCardHolderPhone' => '',
                'creditCardHolderPhoneDDD' => '',
                'creditCardHolderMobilePhone' => '',
                'creditCardHolderMobilePhoneDDD' => '',
                'creditCardHolderName' => '',
                'creditCardCcv' => '',
                'creditCardExpiryMonth' => '',
                'creditCardNumber' => '',
                'creditCardExpiryYear' => '',
                'customer' => '',
            ];

            $this->card = array_merge($this->card, $card);

            return $this->card;
        } catch (\Exception $e) {
            return 'Erro ao definir o cartão de crédito. - '.$e;
        }
    }

    /**
     * Verifica se os dados da cobrança são válidos.
     *
     * @param  array  $card
     * @return bool
     */
    public function card_valid($card)
    {
        return ! (
            empty($cobranca['creditCardHolderFullName']) or
            empty($cobranca['creditCardHolderEmail']) or
            empty($cobranca['creditCardHolderCpfCnpj']) or
            empty($cobranca['creditCardHolderAddressNumber']) or
            empty($cobranca['creditCardHolderAddressComplement']) or
            empty($cobranca['creditCardHolderPostalCode']) or
            empty($cobranca['creditCardHolderMobilePhone']) or
            empty($cobranca['creditCardHolderMobilePhoneDDD']) or
            empty($cobranca['creditCardHolderName']) or
            empty($cobranca['creditCardCcv']) or
            empty($cobranca['creditCardExpiryMonth']) or
            empty($cobranca['creditCardNumber']) or
            empty($cobranca['creditCardExpiryYear']) or
            empty($cobranca['customer'])
        );
    }
}
