<?php

namespace Packages\GameBlackjack\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Packages\GameBlackjack\Http\Requests\Frontend\Deal;
use Packages\GameBlackjack\Http\Requests\Frontend\HitStand;
use Packages\GameBlackjack\Http\Requests\Frontend\Double;
use Packages\GameBlackjack\Http\Requests\Frontend\Insurance;
use Packages\GameBlackjack\Http\Requests\Frontend\Split;
use Packages\GameBlackjack\Http\Requests\Frontend\SplitHitStand;
use Packages\GameBlackjack\Services\GameBlackjackService;

class GameBlackjackController extends Controller
{
    public function show(GameBlackjackService $gameBlackjackService)
    {
        return view('game-blackjack::frontend.pages.game', [
            'game' => $gameBlackjackService->init()->get()
        ]);
    }

    /**
     * Draw cards
     *
     * @param Deal $request
     * @param GameBlackjackService $gameBlackjackService
     * @return mixed
     */
    public function deal(Deal $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->deal($request->only(['bet']))
            ->get();
    }

    public function insurance(Insurance $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->insurance()
            ->get();
    }

    public function hit(HitStand $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->hit()
            ->get();
    }

    public function splitHit(SplitHitStand $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->splitHit($request->hand)
            ->get();
    }

    public function double(Double $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->double()
            ->get();
    }

    public function stand(HitStand $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->stand()
            ->get();
    }

    public function splitStand(SplitHitStand $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->splitStand($request->hand)
            ->get();
    }

    public function split(Split $request, GameBlackjackService $gameBlackjackService)
    {
        return $gameBlackjackService
            ->load($request->game_id)
            ->split()
            ->get();
    }
}
