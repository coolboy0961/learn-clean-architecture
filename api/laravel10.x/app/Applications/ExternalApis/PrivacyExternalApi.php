<?php

namespace App\Applications\ExternalApis;

use App\Domain\Entities\User;

interface PrivacyExternalApi
{
    public function getUserPrivacy(User $user): User;
}
