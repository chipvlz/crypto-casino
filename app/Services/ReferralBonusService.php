<?php

namespace App\Services;


use App\Models\ReferralBonus;
use App\Models\User;

class ReferralBonusService
{
    public static function create(User $user, int $type, float $amount)
    {
        $referralBonus = new ReferralBonus();
        $referralBonus->user()->associate($user);
        $referralBonus->type = $type;
        $referralBonus->amount = $amount;
        $referralBonus->save();

        return $referralBonus;
    }
}