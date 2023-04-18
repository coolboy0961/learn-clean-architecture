<?php

namespace App\Adapters\Gateway\ExternalApis\Infrastructure;

interface ExternalApiClient
{
    public function get(string $url);
}
