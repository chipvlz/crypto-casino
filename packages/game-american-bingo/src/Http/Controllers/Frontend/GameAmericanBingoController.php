<?php

namespace Packages\GameAmericanBingo\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameAmericanBingo\Http\Requests\Frontend\Play;
use Packages\GameAmericanBingo\Services\GameAmericanBingoService;

class GameAmericanBingoController extends Controller
{
    public function show(GameAmericanBingoService $gameAmericanBingoService)
    {
        $game = $gameAmericanBingoService->init()->get();
        $game->loadMissing(['account']);

        return view('game-american-bingo::frontend.pages.game', [
            'options' => [
                'game' => $game,
                'preloaderImgUrl' => asset('images/games/american-bingo/' . config('settings.theme') . '/loader.svg'),
                'config' => [
                    'minBet'            => config('game-american-bingo.min_bet'),
                    'maxBet'            => config('game-american-bingo.max_bet'),
                    'betChangeAmount'   => config('game-american-bingo.bet_change_amount'),
                    'defaultBetAmount'  => config('game-american-bingo.default_bet_amount'),
                    'payouts'           => config('game-american-bingo.payouts'),
                ],
                'routes' => [
                    'play' => route('games.american-bingo.play'),
                ],
                'sounds' => [
                    'click'     => asset('audio/games/american-bingo/click.wav'),
                    'bet'       => asset('audio/games/american-bingo/bet.wav'),
                    'lose'      => asset('audio/games/american-bingo/lose.wav'),
                    'win'       => asset('audio/games/american-bingo/win.wav'),
                    'blocked'   => asset('audio/games/american-bingo/blocked.wav'),
                    'random'    => asset('audio/games/american-bingo/random.wav'),
                    'balls'     => asset('audio/games/american-bingo/balls.wav'),
                ]
            ]
        ]);
    }

    /**
     * Draw cards
     *
     * @param Play $request
     * @param GameAmericanBingoService $gameAmericanBingoService
     * @return mixed
     */
    public function play(Play $request, GameAmericanBingoService $gameAmericanBingoService)
    {
        return $gameAmericanBingoService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bet']))
            ->get();
    }
}
