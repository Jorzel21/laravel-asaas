<?php

namespace Asaas;

use Asaas\Utils\Validators\PixValidator;
use Asaas\Utils\Validators\WebhookValidator;

class Webhook
{
    protected $http;

    public function __construct(protected string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * Create a new webhook
     * 
     * @see https://docs.asaas.com/reference/create-new-webhook
     * 
     * @return array
     */
    public function create(array $data): array
    {
        WebhookValidator::validateCreate($data);
        return $this->http->post('v3/webhooks', $data);
    }

    /**
     * Endpoint to list all Webhooks registered in your account.
     * 
     * @see https://docs.asaas.com/reference/list-webhooks
     * 
     * @return array
     */
    public function list(array $queryParams = [])
    {
        $queryString = http_build_query($queryParams);
        $url = 'v3/webhooks' . ($queryString ? '?' . $queryString : '');

        return $this->http->get($url);
    }

    /**
     * This endpoint retrieves a single webhook according to the provided ID.
     * 
     * @see https://docs.asaas.com/reference/retrieve-a-single-webhook
     * 
     * @return array
     */
    public function get(string $id): array
    {
        return $this->http->get("v3/webhooks/{$id}");
    }

    /**
     * Update information about an already registered webhook.
     * 
     * @see https://docs.asaas.com/reference/update-existing-webhook
     * 
     * @return array
     */
    public function update(string $id, array $data): array
    {
        return $this->http->put("v3/webhooks/{$id}", $data);
    }

    /**
     * Removes a webhook.
     * 
     * @see https://docs.asaas.com/reference/remove-webhook
     * 
     * @return array
     */
    public function delete(string $id): array
    {
        return $this->http->delete("v3/pix/qrCodes/static/{$id}");
    }
}
