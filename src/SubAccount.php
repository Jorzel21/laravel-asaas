<?php

namespace Asaas;

use Asaas\Utils\Validators\SubAccountValidator;

class SubAccount
{
    protected $http;

    public function __construct(string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * Create subaccount
     *
     * @see https://docs.asaas.com/reference/create-subaccount
     *
     * @param array $subAccount
     * @return array
     */
    public function create(array $subAccount): array
    {
        SubAccountValidator::validateCreateSubAccount($subAccount);
        return $this->http->post('v3/accounts', $subAccount);
    }

    /**
     * List subaccounts
     *
     * @see https://docs.asaas.com/reference/list-subaccounts
     *
     * @param array $queryParams
     * @return array
     */
    public function list(array $queryParams = []): array
    {
        $queryString = http_build_query($queryParams);
        $url = 'v3/accounts' . ($queryString ? '?' . $queryString : '');

        return $this->http->get($url);
    }

    /**
     * Get subaccount
     *
     * @see https://docs.asaas.com/reference/retrieve-a-single-subaccount
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->http->get("v3/accounts/{$id}");
    }
}
