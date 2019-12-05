<?php

namespace Packages\Raffle\Console\Commands;

use App\Events\CommandExecuted;
use App\Models\Account;
use App\Models\Credit;
use App\Services\AccountService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Packages\Raffle\Models\Raffle;

class ProcessRaffle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:raffle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and process raffle';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // process raffles that are due to complete
        Raffle::where('status', Raffle::STATUS_IN_PROGRESS)->where('end_date', '<=', Carbon::now())->each(function ($raffle) {
            $tickets = $raffle->tickets()->select('id','account_id')->get();
            $win = 0;

            // if some tickets were purchased
            if ($tickets->count() > 0) {
                // draw a random ticket
                $winTicket = $tickets->random();

                // get account of the winning ticket
                if ($account = Account::find($winTicket->account_id)) {
                    $winTicket->update(['winner' => 1]);
                    $win = $raffle->ticket_price * $tickets->count() * $raffle->pot_size_pct / 100;

                    // credit user account by win amount
                    $credit = new Credit();
                    $credit->account()->associate($account);
                    $credit->amount = $win;
                    $credit->save();

                    // create account transaction
                    $accountService = new AccountService($account);
                    $accountService->transaction($credit, $win);
                }
            }

            // mark raffle as completed
            $raffle->status = Raffle::STATUS_COMPLETED;
            $raffle->win_amount = $win;
            $raffle->save();
        });

        // count nunmber of raffles
        $rafflesInProgress = Raffle::where('status', Raffle::STATUS_IN_PROGRESS)->count();

        // if no raffles are running at the moment
        if ($rafflesInProgress == 0) {
            // create a new raffle if the lag time passed
            $previousRaffle = Raffle::orderBy('id', 'desc')->first();
            $minStartDate = $previousRaffle ? $previousRaffle->end_date->addSeconds(config('raffle.lag')) : Carbon::minValue();
            if ($minStartDate->lte(Carbon::now())) {
                $raffle = new Raffle();
                $raffle->ticket_price = config('raffle.ticket_price');
                $raffle->max_tickets_per_user = config('raffle.max_tickets_per_user');
                $raffle->total_tickets = config('raffle.total_tickets');
                $raffle->total_tickets = config('raffle.total_tickets');
                $raffle->pot_size_pct = config('raffle.pot_size_pct');
                $raffle->start_date = Carbon::now();
                $raffle->end_date = $raffle->start_date->addSeconds(config('raffle.duration'));
                $raffle->status = Raffle::STATUS_IN_PROGRESS;
                $raffle->save();
            }
        }

        event(new CommandExecuted(__CLASS__));
    }
}
