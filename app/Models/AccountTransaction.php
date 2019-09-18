<?php

namespace App\Models;

use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use Formatter;

    protected $formats = [
        'amount' => 'decimal',
        'balance' => 'decimal',
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
