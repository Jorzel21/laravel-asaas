<?php

namespace Asaas;

use Exception;
use Asaas\Utils\Validators\CustomerValidator;

class Customer
{
    public $http;

    public function __construct(string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * Create a new customer
     * 
     * @see https://docs.asaas.com/reference/create-new-customer
     * 
     * @param array $customer
     * @return array
     */
    public function create(array $customer): array
    {
        CustomerValidator::validateCreateCustomer($customer);
        return $this->http->post('/v3/customers', $customer);
    }

    /**
     * List customers
     * 
     * @see https://docs.asaas.com/reference/list-customers
     * 
     * @param array $queryParams
     * @return array
     */
    public function list(array $queryParams = []): array
    {
        $queryString = http_build_query($queryParams);
        $url = 'v3/customers' . ($queryString ? '?' . $queryString : '');
        return $this->http->get($url);
    }

    /**
     * Get a customer
     * 
     * @see https://docs.asaas.com/reference/retrieve-a-single-customer
     * 
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->http->get("/v3/customers/{$id}");
    }

    /**
     * Update a customer
     * 
     * @see https://docs.asaas.com/reference/update-existing-customer
     * 
     * @param string $id
     * @param array $customer
     * @return array
     */
    public function update(string $id, array $customer): array
    {
        CustomerValidator::validateUpdateCustomer($customer);
        return $this->http->put("/v3/customers/{$id}", $customer);
    }

    /**
     * Delete a customer
     * 
     * @see https://docs.asaas.com/reference/remove-customer
     * 
     * @param string $id
     * @return array
     */
    public function delete(string $id): array
    {
        return $this->http->delete("/v3/customers/{$id}");
    }

    /**
     * Restore a removed customer
     * 
     * @see https://docs.asaas.com/reference/restore-removed-customer
     * 
     * @param string $id
     * @return array
     */
    public function restoreRemovedCustomer(string $id): array
    {
        return $this->http->post("/v3/customers/{$id}/restore");
    }

    /**
     * Get customer's notifications
     * 
     * @see https://docs.asaas.com/reference/retrieve-notifications-from-a-customer
     * 
     * @param string $id
     * @return array
     */
    public function retriveNotificationsFromCustomer(string $id): array
    {
        return $this->http->get("v3/customers/{$id}/notifications");
    }
}
