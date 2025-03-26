<?php

namespace Asaas;

use GuzzleHttp\Client;

class Connection
{
    public $http;

    public $api_key;

    public $base_url;

    public function __construct(string $apiKey)
    {
        $this->http = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => $apiKey,
            ],
        ]);

        return $this->http;
    }

    public function get(string $url): array
    {
        try {
            $response = $this->http->get($this->base_url . $url);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents()),
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e,
            ];
        }

        $response = $this->http->get($this->base_url . $url);
    }

    public function post(string $url, array $params = []): array
    {
        try {
            $response = $this->http->post($this->base_url . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents()),
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e,
            ];
        }
    }

    public function put(string $url, array $params = []): array
    {
        try {
            $response = $this->http->put($this->base_url . $url, $params);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents()),
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e,
            ];
        }
    }

    public function delete(string $url): array
    {
        try {
            $response = $this->http->delete($this->base_url . $url);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents()),
            ];
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e,
            ];
        }
    }
}
