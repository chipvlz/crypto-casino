<?php

namespace Packages\GameDice\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameDice\Http\Requests\Frontend\Play;
use Packages\GameDice\Services\GameDiceService;

class GameDiceController extends Controller
{
    public function show(GameDiceService $gameDiceService)
    {
        $game = $gameDiceService->init()->get();
        $game->loadMissing('account');

        return view('game-dice::frontend.pages.game', [
            'options' => [
                'game' => $game,
                'preloaderImgUrl' => asset('images/games/dice/' . config('settings.theme') . '/loader.svg'),
                'config' => [
                    'minBet'            => config('game-dice.min_bet'),
                    'maxBet'            => config('game-dice.max_bet'),
                    'betChangeAmount'   => config('game-dice.bet_change_amount'),
                    'minWinChance'      => config('game-dice.min_win_chance'),
                    'maxWinChance'      => config('game-dice.max_win_chance'),
                    'defaultBetAmount'  => config('game-dice.default_bet_amount'),
                    'houseEdge'         => config('game-dice.house_edge'),
                    'animationDuration' => config('game-dice.animation_duration'),
                ],
                'routes' => [
                    'play' => route('games.dice.play'),
                ],
                'sounds' => [
                    'click'     => asset('audio/games/dice/click.wav'),
                    'bet'       => asset('audio/games/dice/bet.wav'),
                    'lose'      => asset('audio/games/dice/lose.wav'),
                    'win'       => asset('audio/games/dice/win.wav'),
                    'blocked'   => asset('audio/games/dice/blocked.wav')
                ]
            ]
        ]);
    }

    /**
     * Draw cards
     *
     * @param Play $request
     * @param GameDiceService $gameDiceService
     * @return mixed
     */
    public function play(Play $request, GameDiceService $gameDiceService)
    {
        return $gameDiceService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['direction', 'bet', 'win_chance']))
            ->get();
    }
}
