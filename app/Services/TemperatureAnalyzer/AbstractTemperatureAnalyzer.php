<?php

declare(strict_types=1);

namespace App\Services\TemperatureAnalyzer;

use App\Services\TemperatureAnalyzer\Contracts\TemperatureAnalyzerInterface;

abstract class AbstractTemperatureAnalyzer implements TemperatureAnalyzerInterface
{
    /**
     * @var float
     */
    protected $temperature;

    /**
     * AbstractTemperatureAnalyzer constructor.
     *
     * @param float $temperature
     */
    public function __construct(float $temperature)
    {
        $this->temperature = $temperature;
    }
}