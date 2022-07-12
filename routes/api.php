<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::POST('/users/signup', [AuthController::class, 'signup']);
Route::POST('users/signin', [AuthController::class, 'sign']);

Route::group(['middleware' => ['auth:api']], function() {
    Route::GET('users', [UserController::class, 'index']);

    //Create new shopping
    Route::POST('shopping', [ShoppingController::class, 'create']);
    //Get all shopping
    Route::GET('shopping', [ShoppingController::class, 'index']);
    //Get shopping by id
    Route::GET('shopping/{id}', [ShoppingController::class, 'show']);
    //Update shopping by id
    Route::PUT('shopping/{id}', [ShoppingController::class, 'update']);
    //Delete shopping by id
    Route::DELETE('shopping/{id}', [ShoppingController::class, 'delete']);
});
