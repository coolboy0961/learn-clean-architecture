<?php

namespace Tests\Unit\Gateway\ExternalApis;

use App\Domain\Entities\User;
use App\Gateway\ExternalApis\Infrastructure\ExternalApiClient;
use App\Gateway\ExternalApis\PrivacyExternalApiImpl;
use App\Infrastructure\ExternalApiClientImpl;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class PrivacyExternalApiImplTest extends TestCase
{
    /**
     * // 最初にExternalApiClientのインターフェイスを実装していないときに、一旦クラスをモックする
     * // ExternalApiClientのインターフェイスを実装したら、クラスのモックからHTTPのモックに変える
     * // HTTP Responseの勘違いによるバグを減らすため
     */
    public function test_電話番号を使って外部APIからユーザのプライバシー情報を取得できることv1()
    {
        // Arrange
        $expectedUser = new User('John Doe', 'john@example.com', '08011112222');

        $client = $this->createMock(ExternalApiClient::class);
        $privacyResponse = new Response(200, [], json_encode([
            'address' => 'Tokyo',
            'phone_number' => '08011112222'
        ]));
        $client->expects($this->once())
            ->method('get')
            ->with('/api/v1/privacy?email=john@example.com')
            ->willReturn($privacyResponse);

        // Act
        $privacyApi = new PrivacyExternalApiImpl($client);
        $user = new User('John Doe', 'john@example.com');
        $actualUser = $privacyApi->getUserPrivacy($user);

        // Assert
        $this->assertEquals($expectedUser, $actualUser);
    }
    public function test_電話番号を使って外部APIからユーザのプライバシー情報を取得できることv2()
    {
        // Arrange
        $expectedUser = new User('John Doe', 'john@example.com', '08011112222');
        $mock = new MockHandler([
            function ($request) {
                $this->assertEquals('http://127.0.0.1:3000/api/v1/privacy?email=john@example.com', (string) $request->getUri());
                return new Response(200, [], json_encode([
                    'address' => 'Tokyo',
                    'phone_number' => '08011112222'
                ]));
            },
            // Requestが複数あるときに、上記functionをここで複数追加すればいい
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        // Act
        $privacyApi = new PrivacyExternalApiImpl(new ExternalApiClientImpl($client));
        $user = new User('John Doe', 'john@example.com');
        $actualUser = $privacyApi->getUserPrivacy($user);

        // Assert
        $this->assertEquals($expectedUser, $actualUser);
    }
}
