<?php

namespace Asaas;

use Asaas\Utils\Validators\PixValidator;

class Pix
{
    protected $http;

    public function __construct(protected string $apiKey)
    {
        $this->http = new Connection($apiKey);
    }

    /**
     * Create a new pix key
     * 
     * @see https://docs.asaas.com/reference/create-a-key
     * 
     * @return array
     */
    public function createPixKey(): array
    {
        return $this->http->post('v3/pix/addressKeys', ['type' => 'EVP']);
    }

    /**
     * List pix keys
     * 
     * @see https://docs.asaas.com/reference/list-keys
     * 
     * @return array
     */
    public function listPixKeys(): array
    {
        return $this->http->get('v3/pix/addressKeys');
    }

    /**
     * Get pix key
     * 
     * @see https://docs.asaas.com/reference/retrieve-a-single-key
     * 
     * @return array
     */
    public function getPixKey(string $id): array
    {
        return $this->http->get("v3/pix/addressKeys/{$id}");
    }

    /**
     * Delete pix key
     * 
     * @see https://docs.asaas.com/reference/remove-key-1
     * 
     * @return array
     */
    public function deletePixKey(string $id): array
    {
        return $this->http->delete("v3/pix/addressKeys/{$id}");
    }

    /**
     * Create a static QR code
     * 
     * @see https://docs.asaas.com/reference/create-static-qrcode
     * 
     * @return array
     */
    public function createStaticQrCode(array $data): array
    {
        PixValidator::validateCreateStaticQrCode($data);
        return $this->http->post("v3/pix/qrCodes/static", $data);
    }

    /**
     * Remove a static QR code
     * 
     * @see https://docs.asaas.com/reference/delete-static-qrcode
     * 
     * @return array
     */
    public function deleteStaticQrCode(string $id): array
    {
        return $this->http->delete("v3/pix/qrCodes/static/{$id}");
    }
}
