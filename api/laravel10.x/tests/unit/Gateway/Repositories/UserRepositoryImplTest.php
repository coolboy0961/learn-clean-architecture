<?php

namespace Tests\Unit\Gateway\Repositories;

use App\Domain\Entities\User;
use App\Gateway\Repositories\Models\EloquentUser;
use App\Gateway\Repositories\UserRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryImplTest extends TestCase
{
  use RefreshDatabase;

  public function test_ユーザをDBに追加できること()
  {
    // Arrange
    $exceptedUser = new User('John Doe', 'john@example.com');

    // Act
    $repository = new UserRepositoryImpl();

    $user = new User('John Doe', 'john@example.com');
    $actualUser = $repository->create($user);

    // Assert
    $this->assertDatabaseHas('users', [
      'name' => $exceptedUser->getName(),
      'email' => $exceptedUser->getEmail(),
    ]);
    $this->assertEquals($actualUser, $exceptedUser);
  }

  public function test_DBにあるユーザを全部取得できること()
  {
    // Arrange
    $expectedUsers = [
      new User('John Doe', 'john@example.com'),
      new User('Jane Doe', 'jane@example.com')
    ];
    // Database準備
    EloquentUser::create([
      'name' => 'John Doe',
      'email' => 'john@example.com',
    ]);
    EloquentUser::create([
      'name' => 'Jane Doe',
      'email' => 'jane@example.com',
    ]);

    // Act
    $repository = new UserRepositoryImpl();
    $actualUsers = $repository->getAll();

    // Assert
    $this->assertEquals($actualUsers, $expectedUsers);
  }
}