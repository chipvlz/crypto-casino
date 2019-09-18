<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Keno')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-keno" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno-options" aria-expanded="true">
                                {{ __('General') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-keno-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Min bet') }}</label>
                                <input type="number" name="GAME_KENO_MIN_BET" class="form-control" value="{{ config('game-keno.min_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Max bet') }}</label>
                                <input type="number" name="GAME_KENO_MAX_BET" class="form-control" value="{{ config('game-keno.max_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Bet increment / decrement amount') }}</label>
                                <input type="number" name="GAME_KENO_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-keno.bet_change_amount') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Default bet amount') }}</label>
                                <input type="number" name="GAME_KENO_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-keno.default_bet_amount') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Draw count') }}</label>
                                <input type="number" name="GAME_KENO_DRAW_COUNT" class="form-control" value="{{ config('game-keno.draw_count') }}">
                                <small>
                                    {{ __('How many random numbers will be drawn in each game.') }}
                                    {{ __('The higher this number is the more likely a user to win.') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-keno-paytable" aria-expanded="true">
                                {{ __('Paytable') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-keno-paytable" class="collapse ml-3">
                        <div class="card-body">
                            @foreach(config('game-keno.payouts') as $hits => $payout)
                                <div class="form-group">
                                    <label>{{ trans_choice('1 hit|:n hits', $hits, ['n' => $hits]) }} {{ __('pays') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('Bet') }} x </span>
                                        </div>
                                        <input type="number" name="GAME_KENO_PAYOUTS[{{ $hits }}]" class="form-control" value="{{ $payout }}" step="1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('credits') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>