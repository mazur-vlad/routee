<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\CurlExecutor\Client;
use Exception;

class OpenWeatherMapClient
{
    /**
     * @const string
     */
    private const URL = 'https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s&units=metric';

    /**
     * @var string
     */
    private $apiId = 'b385aa7d4e568152288b3c9f5c2458a5';

    /**
     * @var string
     */
    private $city;

    /**
     * OpenWeatherMapClient constructor.
     *
     * @param string $city
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * @return float
     *
     * @throws CurlExecutor\ClientException|Exception
     */
    public function getTemperature(): float
    {
        $client = new Client([
            CURLOPT_URL => sprintf(self::URL, $this->city, $this->apiId)
        ]);

        $response = json_decode($client->getResponse());


        if ($response->cod !== 200) {
            throw new Exception("Can\t' get temperature");
        }

        return $response->main->temp;
    }
}