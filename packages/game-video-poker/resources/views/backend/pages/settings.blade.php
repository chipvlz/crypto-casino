<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Video Poker')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-video-poker" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker-options" aria-expanded="true">
                                {{ __('General') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-video-poker-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Min bet') }}</label>
                                <input type="number" name="GAME_VIDEO_POKER_MIN_BET" class="form-control" value="{{ config('game-video-poker.min_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Max bet') }}</label>
                                <input type="number" name="GAME_VIDEO_POKER_MAX_BET" class="form-control" value="{{ config('game-video-poker.max_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Bet increment / decrement amount') }}</label>
                                <input type="number" name="GAME_VIDEO_POKER_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-video-poker.bet_change_amount') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Default bet amount') }}</label>
                                <input type="number" name="GAME_VIDEO_POKER_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-video-poker.default_bet_amount') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Default bet coins') }}</label>
                                <select name="GAME_VIDEO_POKER_DEFAULT_BET_COINS" class="custom-select">
                                    <option value="1" {{ config('game-video-poker.default_bet_coins')==1?'selected':'' }}>1</option>
                                    <option value="2" {{ config('game-video-poker.default_bet_coins')==2?'selected':'' }}>2</option>
                                    <option value="3" {{ config('game-video-poker.default_bet_coins')==3?'selected':'' }}>3</option>
                                    <option value="4" {{ config('game-video-poker.default_bet_coins')==4?'selected':'' }}>4</option>
                                    <option value="5" {{ config('game-video-poker.default_bet_coins')==5?'selected':'' }}>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-video-poker-paytable" aria-expanded="true">
                                {{ __('Paytable') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-video-poker-paytable" class="collapse ml-3">
                        <input type="hidden" name="GAME_VIDEO_POKER_PAYTABLE" class="form-control" value="{{ config('game-video-poker.paytable') }}">
                        <div class="table-responsive">
                            <table class="game-video-poker-paytable table table-striped">
                                <tr>
                                    <td></td>
                                    @for($i=1;$i<6;$i++)
                                        <td class="text-center">{{ $i }}</td>
                                    @endfor
                                </tr>

                                @foreach(array_reverse(Packages\GameVideoPoker\Models\GameVideoPoker::combinations(), TRUE) as $comb_id => $comb_name)
                                    <tr data-combination="0">
                                        <td>{{ $comb_name }}</td>
                                        @for($j=0;$j<5;$j++)
                                            <td><input id="game_video_poker_paytable_input_{{ $comb_id }}_{{ $j }}" type="number" step="1" value="0" data-idx="{{ $comb_id }},{{ $j }}"></td>
                                        @endfor
                                    </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/games/video-poker/' . $settings->theme . '.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('js/games/video-poker/admin.js') }}"></script>
@endpush