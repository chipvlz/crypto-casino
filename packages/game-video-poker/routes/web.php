<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameVideoPoker\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/video-poker', 'GameVideoPokerController@show')->name('video-poker.show');
        // 1st round (draw cards)
        Route::post('games/video-poker/draw', 'GameVideoPokerController@draw')->name('video-poker.draw');
        // 2nd round (hold cards, draw new cards)
        Route::post('games/video-poker/play', 'GameVideoPokerController@play')->name('video-poker.play');
    });