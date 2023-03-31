<?php

namespace App\Infrastructure;

use App\Gateway\ExternalApis\Infrastructure\ExternalApiClient;
use GuzzleHttp\Client;

class ExternalApiClientImpl implements ExternalApiClient
{
    private string $baseUrl;
    private Client $client;

    public function __construct(Client $client = null)
    {
        $this->baseUrl = 'http://127.0.0.1:3000';
        $this->client = $client ?: new Client(['base_uri' => $this->baseUrl]);
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function get(string $url)
    {
        $response = $this->client->get($this->baseUrl . $url);
        return $response;
    }
}
