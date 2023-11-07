<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use App\Models\Weather;

class WeatherApi
{
    private Client $client;

    private const API_URL = 'https://api.openweathermap.org/data/2.5/weather';
    private const API_KEY = '6891f499c77e1c03df0b56d48fa8ca51';

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false
        ]);
    }

    public function fetchWeather(string $city): ?Weather
    {
        $apiKey = self::API_KEY;
        $url = self::API_URL . "?q=$city&appid=$apiKey";

        $response = $this->client->get($url);
        $data = json_decode((string)$response->getBody());

        $temperatureCelsius = $data->main->temp - 273.15;

        return new Weather(
            $temperatureCelsius,
            $data->weather[0]->description,
            $data->name
        );
    }
}