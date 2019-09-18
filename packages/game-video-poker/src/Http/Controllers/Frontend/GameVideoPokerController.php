<?php

namespace Packages\GameVideoPoker\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameVideoPoker\Http\Requests\Frontend\DrawCards;
use Packages\GameVideoPoker\Http\Requests\Frontend\PlayGame;
use Packages\GameVideoPoker\Models\GameVideoPoker;
use Packages\GameVideoPoker\Services\GameVideoPokerService;

class GameVideoPokerController extends Controller
{
    public function show(GameVideoPokerService $gameVideoPokerService)
    {
        return view('game-video-poker::frontend.pages.game', [
            'combinations'  => GameVideoPoker::combinations(),
            'game'          => $gameVideoPokerService->init()->get()
        ]);
    }

    /**
     * Draw cards
     *
     * @param DrawCards $request
     * @param GameVideoPokerService $gameVideoPokerService
     * @return mixed
     */
    public function draw(DrawCards $request, GameVideoPokerService $gameVideoPokerService)
    {
        return $gameVideoPokerService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->draw($request->only(['bet_coins', 'bet_amount']))
            ->get();
    }

    /**
     * Second round
     *
     * @param PlayGame $request
     * @param GameVideoPokerService $gameVideoPokerService
     * @return \App\Services\GameService|array|mixed
     * @throws \Exception
     */
    public function play(PlayGame $request, GameVideoPokerService $gameVideoPokerService)
    {
        // complete the game
        return $gameVideoPokerService
            ->load($request->game_id)
            ->play($request->only(['hold']))
            ->get();
    }
}
