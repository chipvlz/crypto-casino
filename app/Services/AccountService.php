<?php

namespace App\Services;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountService
{
    private $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Create account transaction
     *
     * @param Model $transactionable
     * @param float $amount
     */
    public function transaction(Model $transactionable, float $amount, $c_id = null)
    {
        if ($amount != 0 && abs($amount) >= 0.01) {
            DB::transaction(function () use ($transactionable, $amount, $c_id) {
                // update account balance
                if ($amount > 0)
                    $this->account->increment('balance', $amount);
                else
                    $this->account->decrement('balance', abs($amount));

                $this->account->update([
                	'currency_id' => $c_id,
                ]);

                // create account transaction
                $transaction = new AccountTransaction();
                $transaction->account()->associate($this->account);
                $transaction->amount = $amount;
                $transaction->balance = $this->account->balance;
                $transaction->currency_id = $c_id;
                $transactionable->transaction()->save($transaction);
            });
        }
    }

    /**
     * Create a new user account
     *
     * @param User $user
     * @return Account
     */
    public static function create(User $user)
    {
        $account = new Account();
        $account->user()->associate($user);
        $account->code = bin2hex(random_bytes(25));
        $account->balance = config('settings.accounts.initial_balance');
        $account->save();

        return $account;
    }
}