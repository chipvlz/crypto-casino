<?php

return [
	/*
	 * Theme
	 */
	'theme' => env('THEME', 'dark-purple'),

    /*
     * Number formatting
     */
    'format' => [
        'number' => [
            'decimals' => env('FORMAT_NUMBER_DECIMALS', 2),
            'decimal_point' => env('FORMAT_NUMBER_DECIMAL_POINT', 46), // period
            'thousands_separator' => env('FORMAT_NUMBER_THOUSANDS_SEPARATOR', 44), // comma
        ]
    ],

	/*
	 * Accounts configuration
	 */
    'accounts' => [
	    // initial balance in credits when creating a user account
	    'initial_balance' => env('ACCOUNTS_INITIAL_BALANCE', 1000),
    ],

    /*
     * Users configuration
     */
    'users' => [
        // require users to verify their email or not
        'email_verification' => env('USERS_EMAIL_VERIFICATION', FALSE),
    ],

    /*
     * Bots configuration
     */
    'bots' => [
        'play_frequency' => env('BOTS_PLAY_FREQUENCY', 30), // in minutes
        'select_count_min' => env('BOTS_SELECT_COUNT_MIN', 1),
        'select_count_max' => env('BOTS_SELECT_COUNT_MAX', 10),
    ],

    /*
     * Referral program
     */
    'referral' => [
        'referee_sign_up_credits'   => env('REFERRAL_REFEREE_SIGN_UP_CREDITS', 50),
        'referrer_sign_up_credits'  => env('REFERRAL_REFERRER_SIGN_UP_CREDITS', 100),
        'referrer_deposit_pct'      => env('REFERRAL_REFERRER_DEPOSIT_PCT', 10),
        'referrer_game_bet_pct'     => env('REFERRAL_REFERRER_GAME_BET_PCT', 20),
    ],

	/*
     * Google Tag Manager container ID
     */
	'gtm_container_id' => env('GTM_CONTAINER_ID'),

    /*
     * Google reCaptcha
     */
    'recaptcha' => [
        'public_key'    => env('RECAPTCHA_PUBLIC_KEY'),
        'secret_key'    => env('RECAPTCHA_SECRET_KEY'),
    ],

    'backend' => [
        'dashboard' => [
            'cache_time' => env('BACKEND_DASHBOARD_CACHE_TIME', 60) // in minutes
        ]
    ]
];