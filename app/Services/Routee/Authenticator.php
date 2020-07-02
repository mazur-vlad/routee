<?php

declare(strict_types=1);

namespace App\Services\Routee;

use App\Services\CurlExecutor\Client;
use App\Services\CurlExecutor\ClientException;

class Authenticator
{
    /**
     * @const string
     */
    private const URL = 'https://auth.routee.net/oauth/token';

    /**
     * @const string
     */
    private const SECRET = 'OXr7WYcP9A';

    /**
     * @const string
     */
    private const API_ID = '57cd83a3e4b0464b9119ba46';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * Authenticator constructor.
     *
     * @throws ClientException
     */
    public function __construct()
    {
        $this->authenticate();
    }

    /**
     * Authenticate to Routee
     *
     * @throws ClientException
     */
    private function authenticate(): void
    {
        $token = base64_encode(self::API_ID . ':' . self::SECRET);

        $client = new Client([
            CURLOPT_URL => self::URL,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => [
                'authorization: Basic ' . $token,
                'content-type: application/x-www-form-urlencoded',
            ],
        ]);

        $response = $client->getResponse();
        $this->accessToken = json_decode($response)->access_token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->accessToken;
    }
}