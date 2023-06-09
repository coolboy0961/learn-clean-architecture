<?php

use Illuminate\Support\Facades\Route;
use App\Adapters\Controllers\HelloWorldController;
use App\Adapters\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/v1/hello-world', [HelloWorldController::class, 'helloWorld']);
Route::post('/v1/users', [UserController::class, 'create']);
Route::get('/v1/users', [UserController::class, 'getAll']);
