<?php

return [
    'version'               => '1.0.0',
    'min_bet'               => env('GAME_KENO_MIN_BET', 1),
    'max_bet'               => env('GAME_KENO_MAX_BET', 50),
    'bet_change_amount'     => env('GAME_KENO_BET_CHANGE_AMOUNT', 1),
    'default_bet_amount'    => env('GAME_KENO_DEFAULT_BET_AMOUNT', 1), // how much in credits to bet
    'draw_count'            => env('GAME_KENO_DRAW_COUNT', 20), // how many numbers to draw
    'payouts'               => json_decode(env('GAME_KENO_PAYOUTS','{"1":0,"2":0,"3":0,"4":1,"5":5,"6":10,"7":25,"8":125,"9":500,"10":1000}'), TRUE),
];