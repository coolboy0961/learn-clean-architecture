<?php

namespace Tests\Unit\Domain\UseCases;

use App\Domain\Entities\User;
use App\Applications\Repositories\UserRepository;
use App\Applications\UseCases\CreateUserUseCase;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    public function test_ユーザ情報を登録して登録したユーザ情報を返却する()
    {
        // Arrange
        $expectedUser = new User('John Doe', 'john@example.com');

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())
            ->method('create')
            ->with(new User('John Doe', 'john@example.com'))
            ->willReturn(new User('John Doe', 'john@example.com'));

        // Act
        $useCase = new CreateUserUseCase($repository);
        $actualUser = $useCase->execute($expectedUser);

        // Assert
        $this->assertEquals($actualUser, $expectedUser);
    }
}
