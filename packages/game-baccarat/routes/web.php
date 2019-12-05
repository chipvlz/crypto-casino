<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameBaccarat\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/baccarat', 'GameBaccaratController@show')->name('baccarat.show');
        // play game
        Route::post('games/baccarat/play', 'GameBaccaratController@play')->name('baccarat.play');
    });
