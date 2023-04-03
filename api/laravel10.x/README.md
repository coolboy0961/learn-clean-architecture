## プロジェクトのディレクトリ構成
```
├── app
│   ├── Applications
│   │   ├── ExternalApis
│   │   │   └── PrivacyExternalApi.php
│   │   ├── Repositories
│   │   │   └── UserRepository.php
│   │   └── UseCases
│   │       ├── CreateUserUseCase.php
│   │       └── GetAllUsersUseCase.php
│   ├── Console
│   ├── Domain
│   │   └── Entities
│   │       └── User.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Gateway
│   │   ├── Controllers
│   │   │   ├── Controller.php
│   │   │   ├── HelloWorldController.php
│   │   │   ├── Requests
│   │   │   │   └── CreateUserRequest.php
│   │   │   ├── Responses
│   │   │   │   └── UserResponse.php
│   │   │   └── UserController.php
│   │   ├── ExternalApis
│   │   │   ├── Infrastructure
│   │   │   │   └── ExternalApiClient.php
│   │   │   └── PrivacyExternalApiImpl.php
│   │   └── Repositories
│   │       ├── Models
│   │       │   └── EloquentUser.php
│   │       └── UserRepositoryImpl.php
│   ├── Http
│   │   ├── Kernel.php
│   │   └── Middleware
│   ├── Infrastructure
│   │   └── ExternalApiClientImpl.php
│   └── Providers
│       ├── AppServiceProvider.php
```
