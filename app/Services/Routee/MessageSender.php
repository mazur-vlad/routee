<?php

declare(strict_types=1);

namespace App\Services\Routee;

use App\Services\CurlExecutor\Client;
use Exception;

class MessageSender
{
    /**
     * @const string
     */
    private const URL = 'https://connect.routee.net/sms';

    /**
     * @var Authenticator
     */
    public $authenticator;

    /**
     * MessageSender constructor.
     */
    public function __construct()
    {
        $this->authenticator = new Authenticator();
    }

    /**
     * @param string $phoneNumber
     * @param string $message
     * @param string $from
     *
     * @throws Exception
     */
    public function sendMessage(string $phoneNumber, string $message, string $from): void
    {
        $body = json_encode([
            "body" => $message,
            "to" => $phoneNumber,
            "from" => $from,
        ]);

        $client = new Client([
            CURLOPT_URL => self::URL,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => [
                'authorization: Bearer ' . $this->authenticator->getToken(),
                'content-type: application/json',
            ],
        ]);

        if (json_decode($client->getResponse())->status !== 'Queued') {
            throw new Exception("Message wasn\'t sent. Body: " . $body);
        }
    }
}