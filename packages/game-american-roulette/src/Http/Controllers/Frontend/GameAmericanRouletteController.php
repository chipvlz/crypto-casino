<?php

namespace Packages\GameAmericanRoulette\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameAmericanRoulette\Http\Requests\Frontend\Play;
use Packages\GameAmericanRoulette\Services\GameAmericanRouletteService;

class GameAmericanRouletteController extends Controller
{
    public function show(GameAmericanRouletteService $gameRouletteService)
    {
        $game = $gameRouletteService->init()->get();
		$game->loadMissing(['account']);
        return view('game-american-roulette::frontend.pages.game', [
            'options'=>[
				'game'          => $game,
				'preloaderImgUrl' => asset('images/preloader/' . config('settings.theme') . '/preloader.svg'),
				'config' => [
					'minBet'            => config('game-american-roulette.min_bet'),
					'maxBet'            => config('game-american-roulette.max_bet'),
					'maxTotalBet'       => config('game-american-roulette.max_total_bet'),
					'betChangeAmount'   => config('game-american-roulette.bet_change_amount'),
					'defaultBetAmount'  => config('game-american-roulette.default_bet_amount'),
					'images_path'       => asset('images/games/american-roulette/' . config('settings.theme') . '/')
				],
				'routes' => [
					'play'       		=> route('games.american-roulette.play'),
				],
				'sounds' => [
					'none'          => asset('audio/games/american-roulette/none.wav'),
					'bet'           => asset('audio/games/american-roulette/bet.wav'),
					'click'         => asset('audio/games/american-roulette/click.wav'),
					'lose'         	=> asset('audio/games/american-roulette/lose.wav'),
					'spin'          => asset('audio/games/american-roulette/spin.wav'),
					'start'   	    => asset('audio/games/american-roulette/start.wav'),
					'stop'          => asset('audio/games/american-roulette/stop.wav'),
					'unbet'       	=> asset('audio/games/american-roulette/unbet.wav'),
					'win'           => asset('audio/games/american-roulette/win.wav')
				]
			]
        ]);
    }

    /**
     * Draw cards
     *
     * @param Play $request
     * @param GameAmericanRouletteService $GameAmericanRouletteService
     * @return mixed
     */
    public function play(Play $request, GameAmericanRouletteService $GameAmericanRouletteService)
    {
        return $GameAmericanRouletteService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bets']))
            ->get();
    }
}
