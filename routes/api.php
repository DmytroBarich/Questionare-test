<?php

use App\Http\Controllers\AuthController;
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
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

//user part
Route::middleware(['auth:sanctum', 'abilities:user:user'])->group(function () {
    Route::resource('users', 'UserController');
});

//admin part
Route::middleware(['auth:sanctum', 'abilities:user:admin'])->group(function () {
    //TODO admin endpoints
});
