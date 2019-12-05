<?php

return [
    'version'               => '1.0.0',
    'duration'              => env('RAFFLE_DURATION', 3600), // 1 hour
    'lag'                   => env('RAFFLE_LAG', 3600), // delay between raffles
    'ticket_price'          => env('RAFFLE_TICKET_PRICE', 10),
    'max_tickets_per_user'  => env('RAFFLE_MAX_TICKETS_PER_USER', 10),
    'total_tickets'         => env('RAFFLE_TOTAL_TICKETS', 500),
    'pot_size_pct'          => env('RAFFLE_POT_SIZE_PCT', 95),
];
