<?php

declare(strict_types=1);

namespace App\Services\TemperatureAnalyzer;

use App\Services\TemperatureAnalyzer\Contracts\TemperatureAnalyzerInterface;

class TemperatureAnalyzerFactory
{
    /**
     * @const array
     */
    private const CLASS_NAMES = [
        LessThanTwenty::class,
        MoreThanTwenty::class,
    ];

    /**
     * @param float $temperature
     *
     * @return TemperatureAnalyzerInterface
     *
     * @throws \Exception
     */
    public static function getInstance(float $temperature): TemperatureAnalyzerInterface
    {
        foreach (self::CLASS_NAMES as $className) {
            $instance = new $className($temperature);
            if ($instance instanceof TemperatureAnalyzerInterface && $instance->isValid()) {
                return $instance;
            }
        }

        throw new \Exception('TemperatureAnalyzerInstance not found');
    }
}