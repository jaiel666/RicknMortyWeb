<?php

use App\Response;
use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use App\WeatherApi;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$loader = new FilesystemLoader(__DIR__ . '/../app/Views');
$twig = new Environment($loader);

$twig->addExtension(new DebugExtension());


$weatherApi = new WeatherApi();
$weatherData = $weatherApi->fetchWeather('Berlin');

$twig->addGlobal('weatherData', $weatherData);

$berlinTimeZone = new DateTimeZone('Europe/Berlin');
$berlinTime = new DateTime('now', $berlinTimeZone);
$berlinCurrentTime = $berlinTime->format('H:i:s');

$twig->addGlobal('berlinCurrentTime', $berlinCurrentTime);

$routeInfo = Router::dispatch();

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        [$className, $method] = $routeInfo[1];
        $vars = $routeInfo[2];

        $response = (new $className())->{$method}($vars);

        /** @var Response $response */
        echo $twig->render($response->getViewName() . '.twig', $response->getData());

        break;
}
