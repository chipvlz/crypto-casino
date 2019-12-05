<?php

namespace Packages\Raffle\Models;

use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RaffleTicket extends Pivot
{
    protected $table = 'raffle_tickets';

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transaction()
    {
        return $this->morphOne(AccountTransaction::class, 'transactionable');
    }

    public function getTitleAttribute()
    {
        return __('Raffle ticket');
    }
}
