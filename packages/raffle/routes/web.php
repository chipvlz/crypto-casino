<?php

// frontend
Route::name('frontend.')
    ->namespace('Packages\Raffle\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        Route::get('raffle', 'RaffleController@index')->name('raffle.index');
        Route::get('raffle/history', 'RaffleController@history')->name('raffle.history');
        Route::post('raffles/{raffle}/ticket', 'RaffleController@ticket')->name('raffle.ticket');
    });

// backend
Route::prefix('admin')
    ->name('backend.')
    ->namespace('Packages\Raffle\Http\Controllers\Backend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa', 'role:' . App\Models\User::ROLE_ADMIN]) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        //
    });
