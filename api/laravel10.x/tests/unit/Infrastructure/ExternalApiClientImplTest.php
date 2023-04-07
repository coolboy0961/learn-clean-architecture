<?php

namespace Tests\Unit\Infrastructure;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use App\Infrastructure\ExternalApiClientImpl;

class ExternalApiClientImplTest extends TestCase
{
    public function test_Getメソッドで外部APIからResponseを取得できること()
    {
        // Arrange
        $expectedStatus = 200;
        $expectedBody = json_encode(['message' => 'this is a get test.']);
        $mock = new MockHandler([
            function ($request) {
                $this->assertEquals('http://127.0.0.1:3000/api/v1/get-test', (string) $request->getUri());
                return new Response(200, [], json_encode(['message' => 'this is a get test.']));
            },
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        // Act
        $apiClient = new ExternalApiClientImpl($client);
        $result = $apiClient->get('/api/v1/get-test');
        $actualStatus = $result->getStatusCode();
        $actualBody = $result->getBody()->getContents();

        // Assert
        $this->assertEquals($expectedStatus, $actualStatus);
        $this->assertEquals($expectedBody, $actualBody);
    }
}
