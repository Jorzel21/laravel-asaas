<?php

namespace Luanrodrigues\Asaas;

use Exception;
use Luanrodrigues\Asaas\Exceptions\ClienteException;

class Cliente
{
    public $http;

    protected $cliente;

    public function __construct($apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * Recupera todos os clientes
     *
     * @see https://asaasv3.docs.apiary.io/#reference/0/clientes/listar-clientes
     *
     * @param string name
     * @return json
     */
    public function all($name = null)
    {
        return $this->http->get('/customers'.'?&name='.$name.'&offset=0&limit=3000');
    }

    /**
     * Cria um novo cliente.
     *
     * @see https://asaasv3.docs.apiary.io/reference/0/clientes/criar-novo-cliente
     *
     * @param  array  $cliente
     * @return bool
     */
    public function create($cliente)
    {
        $cliente = $this->setCliente($cliente);

        return $this->http->post('/customers', ['form_params' => $cliente]);
    }

    /**
     * Faz merge nas informações do cliente.
     *
     * @param  array  $cliente
     * @return array
     */
    public function setCliente($cliente)
    {
        try {
            if (! $this->cliente_valid($cliente)) {
                throw ClienteException::invalidClient();
            }

            $this->cliente = [
                'name' => '',
                'cpfCnpj' => '',
                'email' => '',
                'phone' => '',
                'mobilePhone' => '',
                'address' => '',
                'addressNumber' => '',
                'complement' => '',
                'province' => '',
                'postalCode' => '',
                'externalReference' => '',
                'notificationDisabled' => '',
                'additionalEmails' => '',
            ];

            $this->cliente = array_merge($this->cliente, $cliente);

            return $this->cliente;
        } catch (Exception $e) {
            throw $e;
            //return 'Erro ao definir o cliente. - '.$e;
        }
    }

    /**
     * Verifica se os dados do cliente são válidos.
     *
     * @param  array  $cliente
     * @return bool
     */
    public function cliente_valid($cliente)
    {
        return ! (empty($cliente['name']) or empty($cliente['cpfCnpj']) or empty($cliente['email']));
    }

    /**
     * Atualiza um cliente.
     *
     * @see https://asaasv3.docs.apiary.io/reference/0/clientes/recuperar-um-unico-cliente
     *
     * @param  string  $id
     * @param  array  $param
     * @return json
     */
    public function update($id, $param)
    {
        $cliente = $this->find($id);
        $cliente = $this->setCliente((array) $cliente['response']);
        $cliente = array_merge($cliente, $param);

        return $this->http->post('/customers'.'/'.$id, ['form_params' => $cliente]);
    }

    /**
     * Recupera um cliente pelo id.
     *
     * @see https://asaasv3.docs.apiary.io/reference/0/clientes/recuperar-um-unico-cliente
     *
     * @param  string  $id
     * @return json
     */
    public function find($id)
    {
        return $this->http->get('/customers'.'/'.$id);
    }

    /**
     * Remove um cliente.
     *
     * @see https://asaasv3.docs.apiary.io/#reference/0/clientes/remover-cliente
     *
     * @param string id
     * @return bool
     */
    public function delete($id)
    {
        return $this->http->delete('/customers'.'/'.$id);
    }
}
