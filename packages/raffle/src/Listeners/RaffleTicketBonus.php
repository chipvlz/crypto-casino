<?php

namespace Packages\Raffle\Listeners;

use App\Models\Bonus;
use App\Services\BonusService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Packages\Raffle\Events\RaffleTicketPurchased;

class RaffleTicketBonus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RaffleTicketPurchased  $event
     * @return void
     */
    public function handle(RaffleTicketPurchased $event)
    {
        $raffle = $event->raffle;
        $user = $event->user;
        $quantity = $event->quantity;

        // check if user has referrer
        if ($user->referrer) {
            BonusService::create(
                $user->referrer->account,
                Bonus::TYPE_REFERRER_RAFFLE_TICKET,
                $raffle->ticket_price * $quantity * config('settings.bonuses.raffle.ticket_pct') / 100
            );
        }
    }
}
