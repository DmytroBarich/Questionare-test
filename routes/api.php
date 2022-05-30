<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StateController;
use App\Mail\AdminAnswerNotification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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
Route::get('test', function () {

});
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

//user part
Route::middleware(['auth:sanctum', 'abilities:user:user'])->group(function () {
    Route::apiResource('cities', CityController::class)->only('index');
    Route::apiResource('countries', CountryController::class)->only('index');
    Route::apiResource('states', StateController::class)->only('index');

    Route::apiResource('answers', AnswerController::class)->only('store');
});

//admin part
Route::middleware(['auth:sanctum', 'abilities:user:admin'])->group(function () {
    Route::apiResource('questions', QuestionController::class);

    Route::apiResource('answers', AnswerController::class)->except(['store', 'update']);
});
