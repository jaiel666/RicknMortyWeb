<?php

declare(strict_types=1);

namespace App\Models;

class Weather
{
    private $temperature;
    private $weather;
    private $city;

    public function __construct($temperature, $weather, $city)
    {
        $this->temperature = $temperature;
        $this->weather = $weather;
        $this->city = $city;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getWeather()
    {
        return $this->weather;
    }

    public function getCity()
    {
        return $this->city;
    }
}
