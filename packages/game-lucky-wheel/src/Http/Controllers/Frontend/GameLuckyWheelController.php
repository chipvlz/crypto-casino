<?php

namespace Packages\GameLuckyWheel\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameLuckyWheel\Http\Requests\Frontend\PlayGame;
use Packages\GameLuckyWheel\Services\GameLuckyWheelService;

class GameLuckyWheelController extends Controller
{
    public function __construct(GameLuckyWheelService $gameLuckyWheelService)
    {
        if (is_null($gameLuckyWheelService->getIndex()))
            abort(404);
    }

    public function show(GameLuckyWheelService $gameLuckyWheelService)
    {
        $index = $gameLuckyWheelService->getIndex();
        $config = config('game-lucky-wheel.variations')[$index];
        $game = $gameLuckyWheelService->init()->get();
        $game->loadMissing(['account']);

        return view('game-lucky-wheel::frontend.pages.game', [
            'index'  => $index,
            'options'=>[
                'game'                  => $game,
                'preloaderImgUrl'       => asset('images/preloader/' . config('settings.theme') . '/preloader.svg'),
                'config' => [
                    'title'             => $config->title,
                    'minBet'            => $config->min_bet,
                    'maxBet'            => $config->max_bet,
                    'betChangeAmount'   => $config->bet_change_amount,
                    'defaultBetAmount'  => $config->default_bet,
                    'segments'          => $config->sections
                ],
                'routes' => [
                    'play' => route('games.lucky-wheel.play', ['index' => $index]),
                ],
                'sounds' => [
                    'spin'             => asset('audio/games/lucky-wheel/spin.wav'),
                    'clack'             => asset('audio/games/lucky-wheel/clack.wav'),
                    'click'             => asset('audio/games/lucky-wheel/click.wav'),
                    'lose'              => asset('audio/games/lucky-wheel/lose.wav'),
                    'start'             => asset('audio/games/lucky-wheel/start.wav'),
                    'stop'              => asset('audio/games/lucky-wheel/stop.wav'),
                    'win'   	        => asset('audio/games/lucky-wheel/win.wav'),
                ]
            ]
        ]);
    }

    public function play(PlayGame $request, GameLuckyWheelService $gameLuckyWheelService)
    {
        return $gameLuckyWheelService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bet']))
            ->get();
    }
}
