<?php

namespace App\Adapters\Gateway\ExternalApis;

use App\Applications\ExternalApis\PrivacyExternalApi;
use App\Domain\Entities\User;
use App\Adapters\Gateway\ExternalApis\Infrastructure\ExternalApiClient;

class PrivacyExternalApiImpl implements PrivacyExternalApi
{
    private ExternalApiClient $apiClient;

    public function __construct(ExternalApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getUserPrivacy(User $user): User
    {
        $url = '/api/v1/privacy?email=' . $user->getEmail();
        $response = $this->apiClient->get($url);
        $responseData = json_decode($response->getBody()->getContents(), true);
        return new User($user->getName(), $user->getEmail(), $responseData['phone_number']);
    }
}
