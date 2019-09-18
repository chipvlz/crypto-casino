<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameDice\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/dice', 'GameDiceController@show')->name('dice.show');
        // play game
        Route::post('games/dice/play', 'GameDiceController@play')->name('dice.play');
    });