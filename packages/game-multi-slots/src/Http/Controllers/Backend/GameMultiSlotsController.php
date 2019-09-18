<?php

namespace Packages\GameMultiSlots\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\DotEnvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GameMultiSlotsController extends Controller
{
    
    public function files(Request $request, $index)
    {
        $path = storage_path() .'/app/public/games/multi-slots/' . $index . '/';
        $used = array_filter(explode(",",$request->input('used')));
        if(!is_dir($path))
            mkdir($path,0777,true);
        
        $files = scandir($path);
        foreach($files as $file)
            if($file!='.'&&$file!='..'&&!in_array($file,$used))
                unlink($path.$file);
        
        $files = [];
        
        if($request->file('files')){
            $is_error=false;
            foreach($request->file('files') as $file)
                if($file->getMimeType()!='image/png')
                    $is_error = true;
            if($is_error)
                return response()->json([
                    'success' => false
                ]);
            
            foreach($request->file('files') as $file){
                $file_name = "sym-".str_replace('.','-',microtime(true))."-".mt_rand(10,30).".png";
                $files[] = $file_name;
                $file->move($path, $file_name);
                \Intervention\Image\ImageManagerStatic::make($path.$file_name)->resize(200, 200)->save($path.$file_name);
            }
        }
        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }

    /**
     * Clone given slots game
     *
     * @param DotEnvService $dotEnvService
     * @param $index
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function clone(DotEnvService $dotEnvService, $index)
    {
        $env = $dotEnvService->load();
        $env['GAME_MULTI_SLOTS_TITLES'] = array_merge(config('game-multi-slots.titles'), [config('game-multi-slots.titles')[$index] . ' - ' . __('cloned')]);
        $env['GAME_MULTI_SLOTS_MIN_BET'] = array_merge(config('game-multi-slots.min_bet'), [config('game-multi-slots.min_bet')[$index]]);
        $env['GAME_MULTI_SLOTS_MAX_BET'] = array_merge(config('game-multi-slots.max_bet'), [config('game-multi-slots.max_bet')[$index]]);
        $env['GAME_MULTI_SLOTS_BET_CHANGE_AMOUNT'] = array_merge(config('game-multi-slots.bet_change_amount'), [config('game-multi-slots.bet_change_amount')[$index]]);
        $env['GAME_MULTI_SLOTS_DEFAULT_BET'] = array_merge(config('game-multi-slots.default_bet'), [config('game-multi-slots.default_bet')[$index]]);
        $env['GAME_MULTI_SLOTS_DEFAULT_LINES'] = array_merge(config('game-multi-slots.default_lines'), [config('game-multi-slots.default_lines')[$index]]);
        $env['GAME_MULTI_SLOTS_SYMBOLS'] = array_merge(config('game-multi-slots.symbols'), [config('game-multi-slots.symbols')[$index]]);
        $env['GAME_MULTI_SLOTS_REELS'] = array_merge(config('game-multi-slots.reels'), [config('game-multi-slots.reels')[$index]]);

        $symbolsStoragePath = storage_path('app/public/games/multi-slots');
        File::copyDirectory($symbolsStoragePath. '/' . $index, $symbolsStoragePath . '/' . (count($env['GAME_MULTI_SLOTS_TITLES'])-1));

        return $dotEnvService->save($env) ?
            back()->with('success', __('Game successfully cloned.')) :
            back()->withErrors(__('There was an error while cloning this game.'));
    }

    public function delete(DotEnvService $dotEnvService, $index)
    {
        $env = $dotEnvService->load();

        foreach ([
                     'GAME_MULTI_SLOTS_TITLES',
                     'GAME_MULTI_SLOTS_MIN_BET',
                     'GAME_MULTI_SLOTS_MAX_BET',
                     'GAME_MULTI_SLOTS_BET_CHANGE_AMOUNT',
                     'GAME_MULTI_SLOTS_DEFAULT_BET',
                     'GAME_MULTI_SLOTS_DEFAULT_LINES',
                     'GAME_MULTI_SLOTS_SYMBOLS',
                     'GAME_MULTI_SLOTS_REELS',
                 ] as $param) {
            // decode string value into array
            $value = json_decode($env[$param], JSON_OBJECT_AS_ARRAY);
            if (is_string($value))
                $value = json_decode($value, JSON_OBJECT_AS_ARRAY);

            if ($index == count($value)-1) {
                unset($value[$index]);
            } else {
                $value[$index] = NULL;
            }

            $env[$param] = $value;
        }

        Storage::disk('public')->deleteDirectory('games/multi-slots/' . $index);

        return $dotEnvService->save($env) ?
            back()->with('success', __('Game successfully deleted.')) :
            back()->withErrors(__('There was an error while deleting this game.'));
    }
}
