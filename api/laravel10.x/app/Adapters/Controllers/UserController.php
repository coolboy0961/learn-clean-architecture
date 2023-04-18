<?php

namespace App\Adapters\Controllers;

use App\Domain\Entities\User;
use App\Adapters\Controllers\Requests\CreateUserRequest;
use App\Adapters\Controllers\Responses\UserResponse;
use App\Applications\UseCases\CreateUserUseCase;
use App\Applications\UseCases\GetAllUsersUseCase;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private CreateUserUseCase $createUserUseCase;
    private GetAllUsersUseCase $getAllUsersUseCase;

    public function __construct(
        CreateUserUseCase $createUserUseCase,
        GetAllUsersUseCase $getAllUsersUseCase
    ) {
        $this->createUserUseCase = $createUserUseCase;
        $this->getAllUsersUseCase = $getAllUsersUseCase;
    }

    public function create(CreateUserRequest $request)
    {
        $user = $this->createUserUseCase->execute(
            new User($request->get('name'), $request->get('email'))
        );

        $userResponse = new UserResponse($user);
        return response()->json($userResponse, Response::HTTP_CREATED);
    }

    public function getAll()
    {
        $users = $this->getAllUsersUseCase->execute();
        return response()->json(UserResponse::collection($users), Response::HTTP_OK);
    }
}
