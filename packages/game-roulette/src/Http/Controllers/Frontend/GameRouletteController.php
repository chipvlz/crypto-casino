<?php

namespace Packages\GameRoulette\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameRoulette\Http\Requests\Frontend\Play;
use Packages\GameRoulette\Services\GameRouletteService;

class GameRouletteController extends Controller
{
    public function show(GameRouletteService $GameRouletteService)
    {
        return view('game-roulette::frontend.pages.game', [
            'game' => $GameRouletteService->init()->get()
        ]);
    }

    /**
     * Draw cards
     *
     * @param Play $request
     * @param GameRouletteService $GameRouletteService
     * @return mixed
     */
    public function play(Play $request, GameRouletteService $GameRouletteService)
    {
        return $GameRouletteService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['bets']))
            ->get();
    }
}
