<?php

declare(strict_types=1);

namespace App\Services\TemperatureAnalyzer;

class LessThanTwenty extends AbstractTemperatureAnalyzer
{
    /**
     * @const string
     */
    private const MESSAGE = 'Your name and Temperature less than 20C. %s';

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->temperature < 20;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return sprintf(self::MESSAGE, $this->temperature);
    }
}