<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// AJ Developer
Route::post('payment/bill/{id}',[TaskController::class, 'payment']);
Route::get('/User', [TaskController::class, 'User']);

Route::restifyAuth();
///////published route for customization
Route::post('login', \App\Http\Controllers\Restify\Auth\LoginController::class)
    ->middleware('throttle:6,1')
    ->name('restify.login');
Route::post('register', \App\Http\Controllers\Restify\Auth\RegisterController::class)
    ->name('restify.register');
Route::post('forgotPassword', \App\Http\Controllers\Restify\Auth\ForgotPasswordController::class)
    ->middleware('throttle:6,1')
    ->name('restify.forgotPassword');
Route::post('forgotPassword', \App\Http\Controllers\Restify\Auth\ForgotPasswordController::class)
    ->middleware('throttle:6,1')
    ->name('restify.forgotPassword');
Route::post('forgotPassword', \App\Http\Controllers\Restify\Auth\ForgotPasswordController::class)
    ->middleware('throttle:6,1')
    ->name('restify.forgotPassword');
Route::post('resetPassword', \App\Http\Controllers\Restify\Auth\ResetPasswordController::class)
    ->middleware('throttle:6,1')
    ->name('restify.resetPassword');
Route::post('verify/{id}/{hash}', \App\Http\Controllers\Restify\Auth\VerifyController::class)
    ->middleware('throttle:6,1')
    ->name('restify.verify');

Route::post('verify/{id}/{hash}', \App\Http\Controllers\Restify\Auth\VerifyController::class)
    ->middleware('throttle:6,1')
    ->name('restify.verify');
//
Route::apiResource('Student',StudentController::class);
Route::apiResource('Profile',ProfileController::class);
Route::apiResource('Fee',FeeController::class);
