<?php

// game routes
Route::name('games.')
    ->namespace('Packages\GameMultiSlots\Http\Controllers\Frontend')
    ->middleware(['web', 'auth', 'active', 'email_verified', '2fa']) // it's important to add web middleware as it's not automatically added for packages routes
    ->group(function () {
        // show initial game screen
        Route::get('games/multi-slots/{index}', 'GameMultiSlotsController@show')->name('multi-slots.show');
        // play game (spin the reels)
        Route::post('games/multi-slots/{index}/play', 'GameMultiSlotsController@play')->name('multi-slots.play');
    });

    
Route::prefix('admin')
    ->name('backend.games.multi-slots.')
    ->namespace('Packages\GameMultiSlots\Http\Controllers\Backend')
    ->middleware('web', 'auth', 'active', 'email_verified', 'role:' . App\Models\User::ROLE_ADMIN)
    ->group(function () {
        Route::post('games/multi-slots/{index}/files', 'GameMultiSlotsController@files')->name('files');
        Route::post('games/multi-slots/{index}/clone', 'GameMultiSlotsController@clone')->name('clone');
        Route::post('games/multi-slots/{index}/delete', 'GameMultiSlotsController@delete')->name('delete');
    });