<?php

namespace Packages\Raffle\Models;

use App\Models\Account;
use App\Models\Formatters\Formatter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Raffle extends Model
{
    use Formatter;

    const STATUS_IN_PROGRESS = 0;
    const STATUS_COMPLETED = 1;

    protected $formats = [
        'max_win_amount'    => 'integer',
        'win_amount'        => 'decimal',
        'pot_size'          => 'decimal',
    ];

    protected $dates = ['start_date', 'end_date'];

    /**
     * Tickets of a particular raffle
     *
     * @param null $account
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|mixed
     */
    public function tickets($account = NULL)
    {
        return $this->hasMany(RaffleTicket::class)
            ->when($account, function ($query) use ($account) {
                $query->where('account_id', $account->id);
            });
    }

    /**
     * Raffle <--> Account many to many relationship (via raffle_tickets intermediate table)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accounts()
    {
        return $this
            ->belongsToMany(Account::class, 'raffle_tickets', 'raffle_id', 'account_id')
            ->using(RaffleTicket::class)
            ->withPivot('winner')
            ->withTimestamps();
    }

    /**
     * Get raffle winner
     *
     * @return App\Models\User
     */
    public function winner()
    {
        return $this->accounts()->wherePivot('winner', 1)->first()->user();
    }

    /**
     * Get max number of tickets a given user can purchase
     *
     * @param User $user
     * @return mixed
     */
    public function getMaxTicketsUserCanPurchase(User $user)
    {
        $totalTickets = $this->total_tickets;
        $totalPurchasedTickets = $this->tickets()->count();
        $maxTicketsPerUser = $this->max_tickets_per_user  ?: $totalTickets;
        $purchasedTicketsUser = $this->tickets($user->account)->count();
        return min(
            $totalTickets - $totalPurchasedTickets, // number of tickets left in the raffle
            $maxTicketsPerUser - $purchasedTicketsUser // number of tickets allowed for a user
        );
    }

    /**
     * Custom attribute: $raffle->max_win_amount
     *
     * @return float|int
     */
    public function getMaxWinAmountAttribute()
    {
        return $this->total_tickets * $this->ticket_price * $this->pot_size_pct / 100;
    }

    /**
     * Custom attribute: $raffle->pot_size
     *
     * @return float|int
     */
    public function getPotSizeAttribute()
    {
        return $this->tickets->count() * $this->ticket_price * $this->pot_size_pct / 100;
    }

    /**
     * Custom attribute: $raffle->is_completed
     *
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        return $this->status == Raffle::STATUS_COMPLETED;
    }

    /**
     * Custom attribute: $raffle->next_start_date
     *
     * @return mixed
     */
    public function getNextStartDateAttribute()
    {
        return $this->end_date->addSeconds(config('raffle.lag'));
    }

    /**
     * Custom attribute: $raffle->is_end_date_passed
     *
     * @return mixed
     */
    public function getIsEndDatePassedAttribute()
    {
        return $this->end_date->lt(Carbon::now());
    }
}
