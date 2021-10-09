<?php declare(strict_types=1);

namespace Rbrtblnk\PhpApp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClient
 */
class ApiClient
{
    private Client $client;
    private string $endPointBaseUrl;

    public function __construct($endPointBaseUrl)
    {
        $this->client = new Client();
        $this->endPointBaseUrl = $endPointBaseUrl;
    }

    /**
     * @throws GuzzleException
     */
    public function makeRequest(int $delay): ResponseInterface
    {
        $endpoint = sprintf($this->endPointBaseUrl.'/api/%d', $delay);

        return $this->client->request(
            'GET',
            $endpoint
        );
    }
}
