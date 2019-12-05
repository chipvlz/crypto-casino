<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-baccarat" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Baccarat')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-baccarat" class="collapse">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Min bet') }}</label>
                <input type="number" name="GAME_BACCARAT_MIN_BET" class="form-control" value="{{ config('game-baccarat.min_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max bet') }}</label>
                <input type="number" name="GAME_BACCARAT_MAX_BET" class="form-control" value="{{ config('game-baccarat.max_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Bet increment / decrement amount') }}</label>
                <input type="number" name="GAME_BACCARAT_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-baccarat.bet_change_amount') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Default bet amount') }}</label>
                <input type="number" name="GAME_BACCARAT_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-baccarat.default_bet_amount') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label>{{ __('Player bet payout') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Bet') }} x</span>
                        </div>
                        <input type="number" step="0.01" name="GAME_BACCARAT_PAYOUT_PLAYER" class="form-control" value="{{ config('game-baccarat.payouts.player') }}">
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>{{ __('Banker bet payout') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Bet') }} x</span>
                        </div>
                        <input type="number" step="0.01" name="GAME_BACCARAT_PAYOUT_BANKER" class="form-control" value="{{ config('game-baccarat.payouts.banker') }}">
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>{{ __('Tie bet payout') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Bet') }} x</span>
                        </div>
                        <input type="number" step="0.01" name="GAME_BACCARAT_PAYOUT_TIE" class="form-control" value="{{ config('game-baccarat.payouts.tie') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
