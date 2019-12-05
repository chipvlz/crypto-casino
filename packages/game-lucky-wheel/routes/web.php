<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameLuckyWheel\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/lucky-wheel/{index}', 'GameLuckyWheelController@show')->name('lucky-wheel.show');
        // play game (spin the reels)
        Route::post('games/lucky-wheel/{index}/play', 'GameLuckyWheelController@play')->name('lucky-wheel.play');
    });
