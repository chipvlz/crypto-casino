<?php

return [
    'version'               => '1.0.0',
    'min_bet'               => env('GAME_AMERICAN_BINGO_MIN_BET', 1),
    'max_bet'               => env('GAME_AMERICAN_BINGO_MAX_BET', 50),
    'bet_change_amount'     => env('GAME_AMERICAN_BINGO_BET_CHANGE_AMOUNT', 1),
    'default_bet_amount'    => env('GAME_AMERICAN_BINGO_DEFAULT_BET_AMOUNT', 1), // how much in credits to bet
    'payouts'               => json_decode(env('GAME_AMERICAN_BINGO_PAYOUTS','{"1":5,"2":5,"3":10,"4":25}'), TRUE),
];