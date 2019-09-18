<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameAmericanBingo\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/american-bingo', 'GameAmericanBingoController@show')->name('american-bingo.show');
        // play game
        Route::post('games/american-bingo/play', 'GameAmericanBingoController@play')->name('american-bingo.play');
    });