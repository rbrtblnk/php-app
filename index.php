<?php declare(strict_types=1);

require 'vendor/autoload.php';

use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$delay = $_GET['delay'] ?? 0;
$message = '-';

if ($delay > 0) {
    $apiClient = new Rbrtblnk\PhpApp\ApiClient($_ENV['API_URL']);

    try {
        $response = $apiClient->makeRequest((int)$delay);
        $message = $response->getBody();
    } catch (GuzzleException $e) {
        $message = $e;
    }
}

print $message;
