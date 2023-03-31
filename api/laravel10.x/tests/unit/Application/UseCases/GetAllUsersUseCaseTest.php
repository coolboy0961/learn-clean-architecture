<?php

namespace Tests\Unit\Domain\UseCases;

use App\Domain\Entities\User;
use App\Applications\Repositories\UserRepository;
use App\Applications\UseCases\GetAllUsersUseCase;
use App\Applications\ExternalApis\PrivacyExternalApi;
use Tests\TestCase;


class GetAllUsersUseCaseTest extends TestCase
{
    public function test_全部のユーザ情報をrepositoryとexternalApi経由で取得して返す()
    {
        // Arrange
        $expectedUsers = [
            new User('John Doe', 'john@example.com', '08011112222'),
            new User('Jane Doe', 'jane@example.com', '08011113333'),
        ];

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())
            ->method('getAll')
            ->willReturn([
                new User('John Doe', 'john@example.com'),
                new User('Jane Doe', 'jane@example.com'),
            ]);
        $externalApi = $this->createMock(PrivacyExternalApi::class);
        $externalApi->expects($this->exactly(2)) // 2回コールされること
            ->method('getUserPrivacy')
            ->with($this->isInstanceOf(User::class)) // 引数がUserオブジェクトであること
            ->willReturnCallback(function (User $user) { // userオブジェクトのemailによって、返すオブジェクトを選択
                if ($user->getEmail() === 'john@example.com') {
                    return new User('John Doe', 'john@example.com', '08011112222');
                } elseif ($user->getEmail() === 'jane@example.com') {
                    return new User('Jane Doe', 'jane@example.com', '08011113333');
                }
        });
        // Act
        $useCase = new GetAllUsersUseCase($repository, $externalApi);
        $actualUsers = $useCase->execute();

        // Assert
        $this->assertEquals($actualUsers, $expectedUsers);
    }
}
