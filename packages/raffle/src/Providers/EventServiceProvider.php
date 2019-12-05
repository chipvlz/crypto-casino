<?php

namespace Packages\Raffle\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Packages\Raffle\Events\RaffleTicketPurchased;
use Packages\Raffle\Listeners\RaffleTicketBonus;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RaffleTicketPurchased::class => [
            RaffleTicketBonus::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
