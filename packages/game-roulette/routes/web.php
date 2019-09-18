<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameRoulette\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/roulette', 'GameRouletteController@show')->name('roulette.show');
        // play game
        Route::post('games/roulette/play', 'GameRouletteController@play')->name('roulette.play');
    });