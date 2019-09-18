<?php

namespace Packages\GameSlots\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\GameSlots\Http\Requests\Frontend\PlayGame;
use Packages\GameSlots\Services\GameSlotsService;

class GameSlotsController extends Controller
{
    public function show(GameSlotsService $gameSlotsService)
    {
        $syms = [];
        $paytable = [];
        $symbols = config('game-slots.symbols');
        $reels = config('game-slots.reels');

        foreach($symbols as $sym){
            $syms[] = asset('storage/games/slots/' . $sym['filename']);
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

        return view('game-slots::frontend.pages.game', [
            'symbols'           => $symbols,
            'reels'             => $reels,
            'syms'              => $syms,
            'paytable'          => $paytable,
            'game'              => $gameSlotsService->init()->get()
        ]);
    }
    
    public function play(PlayGame $request, GameSlotsService $gameSlotsService)
    {
        return $gameSlotsService
            ->load($request->game_id)
            ->setGameProperty('client_seed', $request->seed)
            ->play($request->only(['lines_count', 'bet']))
            ->get();
    }
}
