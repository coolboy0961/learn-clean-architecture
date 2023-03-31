<?php

namespace App\Applications\UseCases;

use App\Domain\Entities\User;
use App\Applications\Repositories\UserRepository;

class CreateUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(User $user): User
    {
        return $this->userRepository->create($user);
    }
}
