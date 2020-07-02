<?php

declare(strict_types=1);

namespace App\Services\CurlExecutor;

class Client
{
    /**
     * @var array
     */
    private $params = [];


    /**
     * @var string|null
     */
    private $response;

    /**
     * CurlExecutor constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @throws ClientException
     *
     * Sends curl request with params from constructor.
     */
    private function sendRequest(): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt_array($ch, $this->params);
        $this->response = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new ClientException($error, curl_getinfo($ch, CURLINFO_HTTP_CODE));
        }
    }

    /**
     * @return string|null
     *
     * @throws ClientException
     */
    public function getResponse(): ?string
    {
        $this->sendRequest();

        return $this->response;
    }
}