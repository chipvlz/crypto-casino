<?php

return [
    'version'               => '1.1.1',
    'min_bet'               => env('GAME_VIDEO_POKER_MIN_BET', 1),
    'max_bet'               => env('GAME_VIDEO_POKER_MAX_BET', 50),
    'bet_change_amount'     => env('GAME_VIDEO_POKER_BET_CHANGE_AMOUNT', 1),
    'default_bet_amount'    => env('GAME_VIDEO_POKER_DEFAULT_BET_AMOUNT', 1), // how much in credits to bet
    'default_bet_coins'     => env('GAME_VIDEO_POKER_DEFAULT_BET_COINS', 1), // how many coins (1 to 5) to bet
    'paytable'              => env("GAME_VIDEO_POKER_PAYTABLE",'[[0,1,2,3,4,6,9,25,50,250],[0,2,4,6,8,12,18,50,100,500],[0,3,6,9,12,18,27,75,150,750],[0,4,8,12,16,24,36,100,200,1000],[0,5,10,15,20,30,45,125,250,4000]]')
];