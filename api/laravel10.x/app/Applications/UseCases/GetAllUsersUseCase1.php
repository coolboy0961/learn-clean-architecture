<?php

namespace App\Applications\UseCases;

use App\Applications\ExternalApis\PrivacyExternalApi;
use App\Applications\Repositories\UserRepository;

class GetAllUsersUseCase
{
    private UserRepository $userRepository;
    private PrivacyExternalApi $privacyExternalApi;

    public function __construct(UserRepository $userRepository, PrivacyExternalApi $privacyExternalApi)
    {
        $this->userRepository = $userRepository;
        $this->privacyExternalApi = $privacyExternalApi;
    }

    public function execute(): array
    {

        $users = $this->userRepository->getAll();
        $usersWithPrivacy = [];

        foreach ($users as $user) {
            $userWithPrivacy = $this->privacyExternalApi->getUserPrivacy($user);
            array_push($usersWithPrivacy, $userWithPrivacy);
        }

        return $usersWithPrivacy;
    }
}
