<?php declare(strict_types=1);

$scriptStart = microtime(true);

require 'vendor/autoload.php';

use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$delay = $_GET['delay'] ?? 0;
$apiRequestTime = 0;

if ($delay > 0) {
    $apiClient = new Rbrtblnk\PhpApp\ApiClient($_ENV['API_URL']);

    try {
        $requestStart = microtime(true);
        $response = $apiClient->makeRequest((int)$delay);
        $apiRequestTime = getElapsedMicroseconds($requestStart);
    } catch (GuzzleException $e) {
        $message = $e;
    }
}

function getElapsedMicroseconds(float $startTime): int
{
    return (int)number_format(
        ((microtime(true) - $startTime) * 1000), // Convert microseconds to seconds
        0,
        '',
        ''
    );
}

$scriptTime = getElapsedMicroseconds($scriptStart);

header('Content-Type: application/json');

print json_encode(
    [
        $scriptTime,
        $apiRequestTime,
    ]
    ,
    JSON_THROW_ON_ERROR
);
