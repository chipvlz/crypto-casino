<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('75 Ball Bingo')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-american-bingo" class="collapse">
        <div class="card-body">
            <div class="accordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo-options" aria-expanded="true">
                                {{ __('General') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-american-bingo-options" class="collapse ml-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Min bet') }}</label>
                                <input type="number" name="GAME_AMERICAN_BINGO_MIN_BET" class="form-control" value="{{ config('game-american-bingo.min_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Max bet') }}</label>
                                <input type="number" name="GAME_AMERICAN_BINGO_MAX_BET" class="form-control" value="{{ config('game-american-bingo.max_bet') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Bet increment / decrement amount') }}</label>
                                <input type="number" name="GAME_AMERICAN_BINGO_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-american-bingo.bet_change_amount') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Default bet amount') }}</label>
                                <input type="number" name="GAME_AMERICAN_BINGO_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-american-bingo.default_bet_amount') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-bingo-paytable" aria-expanded="true">
                                {{ __('Paytable') }}
                            </button>
                        </h5>
                    </div>
                    <div id="tab-game-american-bingo-paytable" class="collapse ml-3">
                        <div class="card-body">
                            @foreach(config('game-american-bingo.payouts') as $pattern => $payout)
                                <div class="form-group">
                                    <label>{{ __('app.american_bingo_pattern_' . $pattern) }} {{ __('pays') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('Bet') }} x </span>
                                        </div>
                                        <input type="number" name="GAME_AMERICAN_BINGO_PAYOUTS[{{ $pattern }}]" class="form-control" value="{{ $payout }}" step="1">
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