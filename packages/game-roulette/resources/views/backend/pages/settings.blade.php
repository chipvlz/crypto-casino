<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-roulette" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Roulette')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-roulette" class="collapse">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Min bet') }}</label>
                <input type="number" name="GAME_ROULETTE_MIN_BET" class="form-control" value="{{ config('game-roulette.min_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max bet') }}</label>
                <input type="number" name="GAME_ROULETTE_MAX_BET" class="form-control" value="{{ config('game-roulette.max_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Bet increment / decrement amount') }}</label>
                <input type="number" name="GAME_ROULETTE_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-roulette.bet_change_amount') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Default bet amount') }}</label>
                <input type="number" name="GAME_ROULETTE_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-roulette.default_bet_amount') }}">
            </div>
        </div>
    </div>
</div>