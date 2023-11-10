<?php

declare(strict_types=1);

namespace App\Models;

class Weather
{
    private float $temperature;
    private string $weather;
    private string $city;

    public function __construct(float $temperature, string $weather, string $city)
    {
        $this->temperature = $temperature;
        $this->weather = $weather;
        $this->city = $city;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getWeather(): string
    {
        return $this->weather;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
