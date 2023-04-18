<?php

namespace App\Adapters\Gateway\Repositories;

use App\Domain\Entities\User;
use App\Applications\Repositories\UserRepository;
use App\Adapters\Gateway\Repositories\Models\EloquentUser;

class UserRepositoryImpl implements UserRepository
{
    public function create(User $user): User
    {
        $eloquentUser = EloquentUser::fromDomainEntity($user);
        $eloquentUser->save();

        return $eloquentUser->toDomainEntity();
    }

    public function getAll(): array
    {
        return EloquentUser::all()
            ->map(function (EloquentUser $eloquentUser) {
                return $eloquentUser->toDomainEntity();
            })
            ->all();
    }
}
