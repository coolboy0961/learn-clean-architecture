<?php

namespace Tests\Unit\Http\Controllers;

use App\Domain\Entities\User;
use App\Applications\UseCases\CreateUserUseCase;
use App\Applications\UseCases\GetAllUsersUseCase;
use App\Gateway\Controllers\UserController;
use App\Gateway\Controllers\Requests\CreateUserRequest;
use App\Gateway\Controllers\Responses\UserResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_Requestのユーザ情報を受け取って正しくCreateUseCaseに渡せること()
    {
        // Arrange
        $expectedContent = json_encode(new UserResponse(new User('John Doe', 'john@example.com')));
        $expectedStatus = Response::HTTP_CREATED;
        $createUserUseCaseMock = $this->createMock(CreateUserUseCase::class);
        $createUserUseCaseMock->expects($this->once()) // モックした対象はcontroller内で一回しか呼び出されていないかチェック
            ->method('execute') // モックする関数を選択
            ->with(new User('John Doe', 'john@example.com')) // executeに渡された引数が想定通りかチェック
            ->willReturn(new User('John Doe', 'john@example.com')); // モックしたexecuteメソッドの戻り値
        $getAllUsersUseCaseMock = $this->createMock(GetAllUsersUseCase::class);
        $getAllUsersUseCaseMock->expects($this->never())->method('execute');

        // Act
        $request = new CreateUserRequest();
        $request->merge([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        $controller = new UserController($createUserUseCaseMock, $getAllUsersUseCaseMock);
        $response = $controller->create($request);
        $actualContent = $response->getContent();
        $actualStatus = $response->getStatusCode();

        // console logを確認する小技
        // echo 'this is a test log.';
        // $this->expectOutputString('');

        // Assert
        $this->assertSame($expectedStatus, $actualStatus);
        $this->assertEquals($expectedContent, $actualContent);
    }

    public function test_GetAllUsersUseCaseから取得したユーザ情報を正しくResponseの形で返却できること()
    {
        // Arrange
        $expectedResponse = [
            new UserResponse(new User('John Doe', 'john@example.com', '08011112222')),
            new UserResponse(new User('Jane Doe', 'jane@example.com', '08011113333')),
        ];


        $getAllUsersUseCaseMock = $this->createMock(GetAllUsersUseCase::class);
        $getAllUsersUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn([
                new User('John Doe', 'john@example.com', '08011112222'),
                new User('Jane Doe', 'jane@example.com', '08011113333'),
            ]);
        $createUserUseCaseMock = $this->createMock(CreateUserUseCase::class);
        $createUserUseCaseMock->expects($this->never())->method('execute');

        // Act
        $controller = new UserController($createUserUseCaseMock, $getAllUsersUseCaseMock);
        $actualResponses = $controller->getAll();

        // Assert
        $this->assertEquals($actualResponses, $expectedResponse);
    }
}
