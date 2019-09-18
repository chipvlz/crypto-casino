<?php

namespace App\Listeners;

use App\Events\GamePlayed;
use App\Models\ReferralBonus;
use App\Services\AccountService;
use App\Services\ReferralBonusService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferralGameBonus
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
     * @param  GamePlayed  $event
     * @return void
     */
    public function handle(GamePlayed $event)
    {
        $user = $event->user;

        // check if user has referrer
        if ($user->referrer) {
            $game = $event->game;
            $bonusPct = $user->referrer->referrer_game_bet_pct ?: config('settings.referral.referrer_game_bet_pct');
            if ($bonusAmount = $game->bet * $bonusPct / 100) {
                $referralBonus = (new ReferralBonusService())::create($user->referrer, ReferralBonus::TYPE_REFERRER_GAME_BET, $bonusAmount);
                $accountService = new AccountService($user->referrer->account);
                $accountService->transaction($referralBonus, $bonusAmount);
            }
        }
    }
}
