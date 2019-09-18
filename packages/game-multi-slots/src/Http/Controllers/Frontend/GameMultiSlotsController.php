<?php

namespace Packages\GameMultiSlots\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\GameMultiSlots\Http\Requests\Frontend\PlayGame;
use Packages\GameMultiSlots\Services\GameMultiSlotsService;

class GameMultiSlotsController extends Controller
{
    public function __construct(Request $request)
    {
        if (!(config('game-multi-slots.titles')[$request->route()->index] ?? NULL))
            abort(404);
    }

    public function show(GameMultiSlotsService $gameMultiSlotsService, $index)
    {
        $syms = [];
        $paytable = [];
        $symbols = config('game-multi-slots.symbols')[$index];
        $reels = config('game-multi-slots.reels')[$index];

        foreach($symbols as $sym){
            $syms[] = asset('storage/games/multi-slots/' . $index . '/' . $sym['filename']);
            $paytable[] = [
                'scatter'       => $sym['scatter'],
                'wild'          => $sym['wild'],
                'w1'            => $sym['w1']?( ($sym['w1t']=='x'?'x':'').$sym['w1'] ):'',
                'w2'            => $sym['w2']?( ($sym['w2t']=='x'?'x':'').$sym['w2'] ):'',
                'w3'            => $sym['w3']?( ($sym['w3t']=='x'?'x':'').$sym['w3'] ):'',
                'w4'            => $sym['w4']?( ($sym['w4t']=='x'?'x':'').$sym['w4'] ):'',
                'w5'            => $sym['w5']?( ($sym['w5t']=='x'?'x':'').$sym['w5'] ):'',
            ];
        }

        return view('game-multi-slots::frontend.pages.game', [
            'index'             => $index,
            'symbols'           => $symbols,
            'reels'             => $reels,
            'syms'              => $syms,
            'paytable'          => $paytable,
            'game'              => $gameMultiSlotsService->init()->get()
        ]);
    }
    
    public function play(PlayGame $request, GameMultiSlotsService $gameMultiSlotsService)
    {
        return $gameMultiSlotsService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['lines_count', 'bet']))
            ->get();
    }
}
