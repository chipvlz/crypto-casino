<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    // types for referees
    const TYPE_REFEREE_SIGN_UP = 1;

    // types for referrers
    const TYPE_REFERRER_SIGN_UP = 11;
    const TYPE_REFERRER_GAME_BET = 12;
    const TYPE_REFERRER_DEPOSIT = 13;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->morphOne(AccountTransaction::class, 'transactionable');
    }
}
