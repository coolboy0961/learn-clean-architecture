<?php

namespace App\Applications\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function create(User $user): User;

    // public function getAll(): array;
}
