<?php

namespace Luanrodrigues\Asaas;

use Exception;
use Luanrodrigues\Asaas\Exceptions\ContaException;

class Conta
{
    public $http;

    protected $conta;

    public function __construct()
    {
        $apiKey = env('ASAAS_API_KEY', '');
        $this->http = new Connection($apiKey, 'v2');
    }

    /**
     * Cria um novo conta.
     *
     * @see https://asaasaccounts.docs.apiary.io/#reference/0/contas/criar-conta
     *
     * @param  array  $conta
     * @return bool
     */
    public function create($conta)
    {
        $conta = $this->setConta($conta);

        return $this->http->post('/accounts', ['form_params' => $conta]);
    }

    /**
     * Faz merge nas informações do conta.
     *
     * @param  array  $conta
     * @return array
     */
    public function setConta($conta)
    {
        try {
            if (! $this->conta_valid($conta)) {
                throw ContaException::invalidConta();
            }

            $this->conta = [
                'name' => '',
                'cpfCnpj' => '',
                'companyType' => '',
                'email' => '',
                'phone' => '',
                'mobilePhone' => '',
                'address' => '',
                'addressNumber' => '',
                'complement' => '',
                'province' => '',
                'postalCode' => '',
            ];

            $this->conta = array_merge($this->conta, $conta);

            return $this->conta;
        } catch (Exception $e) {
            return 'Erro ao definir a conta. - '.$e;
        }
    }

    /**
     * Verifica se os dados da conta são válidos.
     *
     * @param  array  $conta
     * @return bool
     */
    public function conta_valid($conta)
    {
        return ! (empty($conta['name']) or empty($conta['cpfCnpj']) or empty($conta['companyType']) or empty($conta['email']) or empty($conta['phone']) or empty($conta['mobilePhone']) or empty($conta['address']) or empty($conta['addressNumber']) or empty($conta['province']) or empty($conta['postalCode']));
    }
}
