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
        $this->app->bind(ExternalApiClient::class, ExternalApiClientImpl::class);
        $this->app->bind(PrivacyExternalApi::class, function ($app) {
            return new PrivacyExternalApiImpl($app->make(ExternalApiClient::class));
        });
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(
            CreateUserUseCase::class,
            function ($app) {
                return new CreateUserUseCase($app->make(UserRepository::class));
            }
        );
        $this->app->bind(
            GetAllUsersUseCase::class,
            function ($app) {
                return new GetAllUsersUseCase(
                    $app->make(UserRepository::class),
                    $app->make(PrivacyExternalApi::class)
                );
            }
        );
        $this->app->bind(
            UserController::class,
            function ($app) {
                return new UserController(
                    $app->make(CreateUserUseCase::class),
                    $app->make(GetAllUsersUseCase::class)
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
