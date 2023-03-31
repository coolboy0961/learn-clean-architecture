<?php

namespace App\Gateway\ExternalApis\Infrastructure;

interface ExternalApiClient
{
    public function get(string $url);
}
