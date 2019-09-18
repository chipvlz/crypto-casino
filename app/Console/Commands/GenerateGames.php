<?php

namespace App\Console\Commands;

use App\Helpers\Games\NumberGenerator;
use App\Helpers\PackageManager;
use App\Models\Game;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate games (each selected bot will play one game)';

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
        $count = random_int(config('settings.bots.select_count_min'), config('settings.bots.select_count_max'));

        // retrieve bots
        $users = User::where('role', User::ROLE_BOT)
            ->where('status', User::STATUS_ACTIVE)
            ->inRandomOrder()
            ->limit($count)
            ->get();

        // if bots exist
        if (!$users->isEmpty()) {
            // get all game service classes
            $gameServiceClasses = [];
            $packageManager = new PackageManager();
            foreach ($packageManager->getEnabled() as $package) {
                if (strpos($package->id, 'game-') !== FALSE) {
                    $gameServiceClass = $package->namespace . 'Services\\' . ucfirst(Str::camel($package->id)) . 'Service';
                    if (class_exists($gameServiceClass))
                        $gameServiceClasses[] = $gameServiceClass;
                }
            }

            $n = count($gameServiceClasses);

            if ($n > 0) {
                // loop through bots users
                foreach ($users as $user) {
                    $i = random_int(0, $n - 1);
                    $seed = random_int(10000,99999);
                    $gameServiceClass = $gameServiceClasses[$i];
                    $gameService = new $gameServiceClass($user);
                    $gameService->init()->setGameProperty('client_seed', $seed);

                    // slots
                    if ($gameServiceClass == 'Packages\GameSlots\Services\GameSlotsService') {
                        $gameService
                            ->play([
                                'lines_count' => random_int(1, 20),
                                'bet' => random_int(config('game-slots.min_bet'), config('game-slots.max_bet'))
                            ]);

                    // multi-slots
                    } else if ($gameServiceClass == 'Packages\GameMultiSlots\Services\GameMultiSlotsService') {
                        $gameService
                            ->play([
                                'lines_count'   => random_int(1, 20),
                                'bet'           => random_int(config('game-multi-slots.min_bet')[0], config('game-multi-slots.max_bet')[0])
                            ]);

                    // video poker
                    } elseif ($gameServiceClass == 'Packages\GameVideoPoker\Services\GameVideoPokerService') {
                        $hold = [];
                        // randomly hold or not
                        if (random_int(0,1)==1) {
                            foreach ([0, 1, 2, 3, 4] as $item) {
                                // hold only random cards
                                if (random_int(0, 1) == 1)
                                    $hold[] = $item;
                            }
                        }
                        $gameService
                            ->draw([
                                'bet_coins'   => random_int(1, 5),
                                'bet_amount'  => random_int(config('game-video-poker.min_bet'), config('game-video-poker.max_bet'))
                            ])
                            ->play(['hold' => $hold]);

                    // blackjack
                    } elseif ($gameServiceClass == 'Packages\GameBlackjack\Services\GameBlackjackService') {
                        $game = $gameService
                            ->deal(['bet' => random_int(config('game-blackjack.min_bet'), config('game-blackjack.max_bet'))])
                            ->get();

                        // hit until player gets 17 or more
                        while($gameService->get()->gameable->player_score < 17) {
                            $gameService->hit();
                        }

                        // stand if not busted
                        if ($game->status != Game::STATUS_COMPLETED)
                            $gameService->stand();
                    // roulette
                    } elseif ($gameServiceClass == 'Packages\GameRoulette\Services\GameRouletteService') {
                        $bets = [];
                        $betsCount = random_int(1, 10);
                        $betTypes = array_keys($gameServiceClass::BET_TYPES);
                        $betTypesCount = count($betTypes);

                        while (count($bets) < $betsCount) {
                            $bet = $betTypes[random_int(0, $betTypesCount-1)];
                            if (!array_key_exists($bet, $bets))
                                $bets[$bet] = random_int(config('game-slots.min_bet'), config('game-slots.max_bet'));
                        }
                        $gameService->play(['bets' => $bets]);
                    // dice
                    } elseif ($gameServiceClass == 'Packages\GameDice\Services\GameDiceService') {
                        $gameService
                            ->play([
                                'direction'     => array_random([-1, 1]),
                                'bet'           => random_int(config('game-dice.min_bet'), config('game-dice.max_bet')),
                                'win_chance'    => random_int(config('game-dice.min_win_chance'), config('game-dice.max_win_chance')),
                            ]);
                    // american bingo
                    } elseif ($gameServiceClass == 'Packages\GameAmericanBingo\Services\GameAmericanBingoService') {
                        $gameService
                            ->play([
                                'bet' => random_int(config('game-american-bingo.min_bet'), config('game-american-bingo.max_bet'))
                            ]);
                    // keno
                    } elseif ($gameServiceClass == 'Packages\GameKeno\Services\GameKenoService') {
                        $numbers = [];
                        $ng = new NumberGenerator(1, 80);

                        while(count($numbers) < 10) {
                            $number = $ng->generate()->getNumber();
                            if (!in_array($number, $numbers))
                                $numbers[] = $number;
                        }

                        $gameService
                            ->play([
                                'bet' => random_int(config('game-keno.min_bet'), config('game-keno.max_bet')),
                                'bet_numbers' => $numbers
                            ]);
                    }
                }
            }
        }
    }
}
