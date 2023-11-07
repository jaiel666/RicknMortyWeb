<?php
declare(strict_types=1);

namespace App\Controllers;

use App\WeatherApi;
use App\Response;

class WeatherController
{
    private WeatherApi $api;

    public function __construct()
    {
        $this->api = new WeatherApi();
    }

    public function show(): Response
    {
        $city = 'Berlin';

        $weatherData = $this->api->fetchWeather($city);
        return new Response('Partials/navbar', [
            'weatherData' => $weatherData,
        ]);
    }
}
