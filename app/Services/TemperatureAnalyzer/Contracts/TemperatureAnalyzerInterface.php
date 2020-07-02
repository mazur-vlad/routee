<?php

declare(strict_types=1);

namespace App\Services\TemperatureAnalyzer\Contracts;

interface TemperatureAnalyzerInterface {

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return string
     */
    public function getMessage(): string;
}