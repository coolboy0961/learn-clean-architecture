<?php

namespace Tests\Api;

use App\Gateway\Repositories\Models\EloquentUser;
use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use WireMock\Client\WireMock;


class UserCreateApiTest extends TestCase
{
    use DatabaseMigrations; // メモリ以外のDBはRefreshDatabaseが効かない問題：https://laracasts.com/discuss/channels/testing/refreshdatabase-trait-doesnt-refresh-database

    /**
     * Test if a user can be created successfully and the expected response is returned
     */
    public function test_ユーザ登録してまたそのユーザ情報を返却できること(): void
    {
        // Arrange
        $expectedStatus = 201;
        $expectedUser = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ];

        // Act
        $client = new Client();
        $response = $client->request('POST', 'http://localhost:8000/api/v1/users', [
            'json' => [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
            ],
            'header' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $actualStatus = $response->getStatusCode();
        $actualUser = json_decode($response->getBody()->getContents(), true);

        // Assert
        $this->assertSame($actualStatus, $expectedStatus);
        $this->assertEquals($actualUser, $expectedUser);
    }
}
