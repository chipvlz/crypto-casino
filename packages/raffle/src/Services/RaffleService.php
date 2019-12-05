<?php

namespace Packages\Raffle\Services;

use App\Models\User;
use App\Services\AccountService;
use Packages\Raffle\Events\RaffleTicketPurchased;
use Packages\Raffle\Models\Raffle;

class RaffleService
{
    /**
     * Purchase raffle ticket
     *
     * @param Raffle $raffle
     * @param User $user
     * @param int $quantity
     */
    public static function purchaseTicket(Raffle $raffle, User $user, int $quantity)
    {
        if ($quantity < 1) return;

        $accountService = new AccountService($user->account);

        for ($i=1; $i <= $quantity; $i++) {
            // create a RaffleTicket model
            $raffleTicket = $raffle->tickets()->create([
                'raffle_id'     => $raffle->id,
                'account_id'    => $user->account->id
            ]);

            // create account transaction
            $accountService->transaction($raffleTicket, -$raffle->ticket_price);
        }

        event(new RaffleTicketPurchased($raffle, $user, $quantity));
    }
}
