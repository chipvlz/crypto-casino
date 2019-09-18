<?php

namespace App\Listeners;

use App\Models\ReferralBonus;
use App\Services\AccountService;
use App\Services\ReferralBonusService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferralSignUpBonus
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        // check if user has referrer
        if ($user->referrer) {
            // referee bonus
            $bonusAmount = $user->referrer->referee_sign_up_credits ?: config('settings.referral.referee_sign_up_credits');
            if ($bonusAmount > 0) {
                $referralBonus = (new ReferralBonusService())::create($user, ReferralBonus::TYPE_REFEREE_SIGN_UP, $bonusAmount);
                $accountService = new AccountService($user->account);
                $accountService->transaction($referralBonus, $bonusAmount);
            }
            // referrer bonus
            $bonusAmount = $user->referrer->referrer_sign_up_credits ?: config('settings.referral.referrer_sign_up_credits');
            if ($bonusAmount > 0) {
                $referralBonus = (new ReferralBonusService())::create($user->referrer, ReferralBonus::TYPE_REFERRER_SIGN_UP, $bonusAmount);
                $accountService = new AccountService($user->referrer->account);
                $accountService->transaction($referralBonus, $bonusAmount);
            }
        }
    }
}
