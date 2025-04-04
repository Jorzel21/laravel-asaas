<?php

namespace Asaas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Exception;
use Illuminate\Support\Facades\Config;

class Connection
{
    private const DEFAULT_TIMEOUT = 30;
    private const DEFAULT_HEADERS = [
        'Content-Type' => 'application/json',
    ];

    private Client $http;
    private string $apiKey;
    private string $baseUrl;
    private array $config;

    /**
     * Connection constructor.
     *
     * @param string $apiKey The Asaas API key
     * @throws Exception If the API key is empty
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new Exception('API key cannot be empty');
        }

        $this->apiKey = $apiKey;
        $this->baseUrl = Config::get('asaas.base_url');
        $this->config = array_merge([
            'timeout' => self::DEFAULT_TIMEOUT,
            'headers' => self::DEFAULT_HEADERS,
        ]);

        $this->initializeHttpClient();
    }

    /**
     * Initialize the HTTP client with the configured options
     */
    private function initializeHttpClient(): void
    {
        $this->http = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->config['timeout'],
            'headers' => array_merge($this->config['headers'], [
                'access_token' => $this->apiKey,
            ]),
        ]);
    }

    /**
     * Make a GET request
     *
     * @param string $url The endpoint URL
     * @return array The response data
     */
    public function get(string $url): array
    {
        return $this->handleRequest('GET', $url);
    }

    /**
     * Make a POST request
     *
     * @param string $url The endpoint URL
     * @param array $params The request parameters
     * @return array The response data
     */
    public function post(string $url, array $params = []): array
    {
        return $this->handleRequest('POST', $url, ['json' => $params]);
    }

    /**
     * Make a PUT request
     *
     * @param string $url The endpoint URL
     * @param array $params The request parameters
     * @return array The response data
     */
    public function put(string $url, array $params = []): array
    {
        return $this->handleRequest('PUT', $url, ['json' => $params]);
    }

    /**
     * Make a DELETE request
     *
     * @param string $url The endpoint URL
     * @return array The response data
     */
    public function delete(string $url): array
    {
        return $this->handleRequest('DELETE', $url);
    }

    /**
     * Handle the HTTP request and response
     *
     * @param string $method The HTTP method
     * @param string $url The endpoint URL
     * @param array $options The request options
     * @return array The response data
     */
    private function handleRequest(string $method, string $url, array $options = []): array
    {
        try {
            $response = $this->http->request($method, $url, $options);
            return $this->handleSuccessResponse($response);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        } catch (Exception $e) {
            return $this->handleGenericException($e);
        }
    }

    /**
     * Handle a successful response
     *
     * @param ResponseInterface $response The response object
     * @return array The formatted response data
     */
    private function handleSuccessResponse(ResponseInterface $response): array
    {
        return [
            'code' => $response->getStatusCode(),
            'response' => json_decode($response->getBody()->getContents(), true),
        ];
    }

    /**
     * Handle a RequestException
     *
     * @param RequestException $e The exception
     * @return array The formatted error response
     */
    private function handleRequestException(RequestException $e): array
    {
        if (!$e->hasResponse()) {
            return [
                'code' => $e->getCode(),
                'response' => [['code' => 'no_response', 'message' => $e->getMessage()]],
            ];
        }

        $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
        $errors = $errorResponse['errors'] ?? [['code' => $e->getCode(), 'description' => $e->getMessage()]];

        return [
            'code' => $e->getResponse()->getStatusCode(),
            'response' => array_map(function ($error) {
                return [
                    'code' => $error['code'] ?? 'unknown_error',
                    'message' => $error['description'] ?? 'Erro desconhecido',
                ];
            }, $errors),
        ];
    }

    /**
     * Handle a generic exception
     *
     * @param Exception $e The exception
     * @return array The formatted error response
     */
    private function handleGenericException(Exception $e): array
    {
        return [
            'code' => $e->getCode(),
            'response' => [['code' => 'unknown_error', 'message' => $e->getMessage()]],
        ];
    }
}
