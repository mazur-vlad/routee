<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\OpenWeatherMapClient;
use App\Services\Routee\MessageSender;
use App\Services\TemperatureAnalyzer\TemperatureAnalyzerFactory;
use Exception;

class WeatherSender
{
    /**
     * @const string
     */
    private const PHONE_NUMBER = '+306948872100';

    /**
     * @const string
     */
    private const FROM = 'test';

    /**
     * @var string
     */
    private $city;

    /**
     * WeatherSender constructor.
     *
     * @param string $city
     */
    public function __construct(string $city)
    {
        $this->city = $city;
    }

    /**
     * @throws Exception
     */
    public function send(): void
    {
        $temperature = (new OpenWeatherMapClient($this->city))->getTemperature();
        $temperatureAnalyzer = TemperatureAnalyzerFactory::getInstance($temperature);

        (new MessageSender())->sendMessage(
            self::PHONE_NUMBER,
            $temperatureAnalyzer->getMessage(),
            self::FROM
        );
    }
}