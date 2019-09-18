<?php

return [
    'version'               => '1.1.1',
    'min_bet'               => env('GAME_DICE_MIN_BET', 1),
    'max_bet'               => env('GAME_DICE_MAX_BET', 50),
    'bet_change_amount'     => env('GAME_DICE_BET_CHANGE_AMOUNT', 10),
    'min_win_chance'        => env('GAME_DICE_MIN_WIN_CHANCE', 1),
    'max_win_chance'        => env('GAME_DICE_MAX_WIN_CHANCE', 98),
    'house_edge'            => env('GAME_DICE_HOUSE_EDGE', 1), // house edge in %
    'default_bet_amount'    => env('GAME_DICE_DEFAULT_BET_AMOUNT', 1), // how much in credits to bet
    'animation_duration'    => env('GAME_DICE_ANIMATION_DURATION', 0.3),
];