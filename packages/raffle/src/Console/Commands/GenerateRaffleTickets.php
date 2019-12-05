<?php

namespace Packages\Raffle\Console\Commands;

use App\Events\CommandExecuted;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Packages\Raffle\Models\Raffle;
use Packages\Raffle\Services\RaffleService;

class GenerateRaffleTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate raffle tickets (bots will purchase tickets)';

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
        // iterate through raffles that are currently running
        Raffle::where('status', Raffle::STATUS_IN_PROGRESS)->where('end_date', '>', Carbon::now())->each(function ($raffle) {
            $minBots = config('settings.bots.raffle.count_min');
            $maxBots = config('settings.bots.raffle.count_max');
            $botsCount = $maxBots > 0 && $maxBots >= $minBots ? random_int($minBots, $maxBots) : 0;

            // retrieve bots
            $bots = User::where('role', User::ROLE_BOT)
                ->where('status', User::STATUS_ACTIVE)
                ->inRandomOrder()
                ->limit($botsCount)
                ->get();

            // if bots exist
            if (!$bots->isEmpty()) {
                // loop through bots
                foreach ($bots as $bot) {
                    $maxTicketsQuantity = $raffle->getMaxTicketsUserCanPurchase($bot);
                    if ($maxTicketsQuantity > 0 && $maxTicketsQuantity >= config('settings.bots.raffle.tickets_min')) {
                        RaffleService::purchaseTicket(
                            $raffle,
                            $bot,
                            random_int(config('settings.bots.raffle.tickets_min'), min($maxTicketsQuantity, config('settings.bots.raffle.tickets_max')))
                        );
                    }
                }
            }
        });

        event(new CommandExecuted(__CLASS__));
    }
}
