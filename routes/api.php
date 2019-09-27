<?php

use Illuminate\Http\Request;

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

\Illuminate\Support\Facades\Route::post('accounts/increase', '\\'.\App\Http\Controllers\Backend\AccountController::class.'@increaseBalance');
\Illuminate\Support\Facades\Route::post('accounts/cash-out', '\\'.\App\Http\Controllers\Backend\AccountController::class.'@cashOut');