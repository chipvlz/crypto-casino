<?php

namespace Packages\GameKeno\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameKeno\Http\Requests\Frontend\Play;
use Packages\GameKeno\Services\GameKenoService;

class GameKenoController extends Controller
{
    public function show(GameKenoService $gameKenoService)
    {
        $game = $gameKenoService->init()->get();
        $game->loadMissing(['account']);

        return view('game-keno::frontend.pages.game', [
            'options' => [
                'game' => $game,
                'preloaderImgUrl' => asset('images/games/keno/' . config('settings.theme') . '/loader.svg'),
                'config' => [
                    'minBet'            => config('game-keno.min_bet'),
                    'maxBet'            => config('game-keno.max_bet'),
                    'betChangeAmount'   => config('game-keno.bet_change_amount'),
                    'defaultBetAmount'  => config('game-keno.default_bet_amount'),
                    'drawCount'         => config('game-keno.draw_count'),
                    'payouts'           => config('game-keno.payouts'),
                ],
                'routes' => [
                    'play' => route('games.keno.play'),
                ],
                'sounds' => [
                    'click'     => asset('audio/games/keno/click.wav'),
                    'bet'       => asset('audio/games/keno/bet.wav'),
                    'lose'      => asset('audio/games/keno/lose.wav'),
                    'win'       => asset('audio/games/keno/win.wav'),
                    'blocked'   => asset('audio/games/keno/blocked.wav'),
                    'random'    => asset('audio/games/keno/random.wav'),
                ]
            ]
        ]);
    }

    /**
     * Play game
     *
     * @param Play $request
     * @param GameKenoService $gameKenoService
     * @return mixed
     */
    public function play(Play $request, GameKenoService $gameKenoService)
    {
        return $gameKenoService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bet', 'bet_numbers']))
            ->get();
    }
}
