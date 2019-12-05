<?php

return [
    'version'    => '1.0.0',
    'variations' => json_decode(env('GAME_LUCKY_WHEEL_VARIATIONS', json_encode([
        [
            'title'             => 'Lucky Wheel',
            'slug'              => 'lucky-wheel',
            'min_bet'           => 1,
            'max_bet'           => 500,
            'bet_change_amount' => 1,
            'default_bet'       => 1,
            'sections'          => [
                // ability to specify the font size for a section: 'font' => 150
                ['title'  => 'No luck',     'payout' => 0],
                ['title'  => 'x1',          'payout' => 1],
                ['title'  => 'x2',          'payout' => 2],
                ['title'  => 'No luck',     'payout' => 0],
                ['title'  => 'x1',          'payout' => 1],
                ['title'  => 'x3',          'payout' => 3],
                ['title'  => 'No luck',     'payout' => 0],
                ['title'  => 'x1',          'payout' => 1],
                ['title'  => 'x4',          'payout' => 4],
            ]
        ]
    ]))),
];
