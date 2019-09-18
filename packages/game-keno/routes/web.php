<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameKeno\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/keno', 'GameKenoController@show')->name('keno.show');
        // play game
        Route::post('games/keno/play', 'GameKenoController@play')->name('keno.play');
    });