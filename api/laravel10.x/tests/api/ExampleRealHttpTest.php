<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ExampleRealHttpTest extends TestCase
{
  /**
   * A basic test example.
   */
  public function test_the_application_returns_a_successful_response(): void
  {
    // Arrange
    $expectedStatus = 200;
    $expectedContent = ['message' => 'Hello World'];

    // Act
    $client = new Client();
    $response = $client->request('GET', 'http://localhost:8000/api/v1/hello-world');
    $actualStatus = $response->getStatusCode();
    $actualContent = json_decode($response->getBody()->getContents(), true);

    // Assert
    $this->assertSame($actualStatus, $expectedStatus);
    $this->assertEquals($actualContent, $expectedContent);
    $this->assertSame('apitest', env("APP_ENV"));
  }
}
