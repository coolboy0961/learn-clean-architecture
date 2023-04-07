<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Gateway\Controllers\UserController;
use App\Applications\UseCases\CreateUserUseCase;
use App\Applications\UseCases\GetAllUsersUseCase;
use App\Applications\Repositories\UserRepository;
use App\Gateway\Repositories\UserRepositoryImpl;
use App\Applications\ExternalApis\PrivacyExternalApi;
use App\Gateway\ExternalApis\PrivacyExternalApiImpl;
use App\Gateway\ExternalApis\Infrastructure\ExternalApiClient;
use App\Infrastructure\ExternalApiClientImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
