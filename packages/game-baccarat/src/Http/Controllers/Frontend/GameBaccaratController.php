<?php

namespace Packages\GameBaccarat\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameBaccarat\Http\Requests\Frontend\PlayGame;
use Packages\GameBaccarat\Services\GameBaccaratService;

class GameBaccaratController extends Controller
{
	public function show(GameBaccaratService $gameBaccaratService)
	{
		$game = $gameBaccaratService->init()->get();
		$game->loadMissing(['account']);

		return view('game-baccarat::frontend.pages.game', [
			'options'=>[
				'game'              => $game,
				'preloaderImgUrl'   => asset('images/preloader/' . config('settings.theme') . '/preloader.svg'),
				'config' => [
					'minBet'            => config('game-baccarat.min_bet'),
					'maxBet'            => config('game-baccarat.max_bet'),
					'betChangeAmount'   => config('game-baccarat.bet_change_amount'),
					'defaultBetAmount'  => config('game-baccarat.default_bet_amount'),
					'payouts'           => config('game-baccarat.payouts'),
					'images_path'       => asset('images/games/baccarat/cards'),
					'card_back'         => asset('images/games/baccarat/' . config('settings.theme') . '/back.png')
				],
				'routes' => [
					'play' => route('games.baccarat.play'),
				],
				'sounds' => [
					'click'         => asset('audio/games/blackjack/click.wav'),
					'deal'          => asset('audio/games/blackjack/deal.wav'),
					'card'          => asset('audio/games/blackjack/card.wav'),
					'flip'         	=> asset('audio/games/blackjack/flip.wav'),
					'lose'          => asset('audio/games/blackjack/lose.wav'),
					'none'       	=> asset('audio/games/blackjack/none.wav'),
					'shuffle'       => asset('audio/games/blackjack/shuffle.wav'),
					'win'           => asset('audio/games/blackjack/win.wav')
				]
			]
		]);
	}

    public function play(PlayGame $request, GameBaccaratService $gameBaccaratService)
    {
        return $gameBaccaratService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bet', 'bet_type']))
            ->get();
    }
}
