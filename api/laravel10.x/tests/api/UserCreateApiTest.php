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

    protected WireMock $wiremock;

    public function setUp(): void // voidをつけないとIlluminate\Foundation\Testing\TestCase の setUpにならずエラー
    {
        parent::setUp();
        // WireMockサーバーのセットアップ
        $this->wiremock = WireMock::create('127.0.0.1', 3000);
        $this->wiremock->reset();
    }

    public function tearDown(): void // voidをつけないとIlluminate\Foundation\Testing\TestCase の setUpにならずエラー
    {
        $this->wiremock->reset();
        parent::tearDown();
    }
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

    public function test_すべてのユーザ情報を取得できること()
    {
        // Arrange
        $expectedStatus = 200;
        $expectedUsers = json_encode([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phoneNumber' => '08011112222'
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'phoneNumber' => '08011113333'
            ]
        ]);
        // Database準備
        $client = new Client();
        EloquentUser::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        EloquentUser::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        // John Doeのプライバシー情報を返すマッピング
        $this->wiremock->stubFor(
            WireMock::get(WireMock::urlPathEqualTo('/api/v1/privacy'))
                ->withQueryParam('email', WireMock::equalTo('john@example.com'))
                ->willReturn(
                    WireMock::aResponse()
                        ->withStatus(200)
                        ->withBody('{ "address": "Tokyo", "phone_number": "08011112222" }')
                )
        );
        // Jane Doeのプライバシー情報を返すマッピング
        $this->wiremock->stubFor(
            WireMock::get(WireMock::urlPathEqualTo('/api/v1/privacy'))
                ->withQueryParam('email', WireMock::equalTo('jane@example.com'))
                ->willReturn(
                    WireMock::aResponse()
                        ->withStatus(200)
                        ->withBody('{ "address": "Tokyo", "phone_number": "08011113333" }')
                )
        );

        // Act
        $client = new Client();
        $response = $client->get('http://localhost:8000/api/v1/users');
        $actualStatus = $response->getStatusCode();
        $actualUsers = $response->getBody()->getContents();

        // Assert
        $this->assertSame($expectedStatus, $actualStatus);
        $this->assertEquals($expectedUsers, $actualUsers);
    }
}
