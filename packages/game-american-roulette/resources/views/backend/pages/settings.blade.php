<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-american-roulette" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('American Roulette')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-american-roulette" class="collapse">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Min bet') }}</label>
                <input type="number" name="GAME_AMERICAN_ROULETTE_MIN_BET" class="form-control" value="{{ config('game-american-roulette.min_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max bet') }}</label>
                <input type="number" name="GAME_AMERICAN_ROULETTE_MAX_BET" class="form-control" value="{{ config('game-american-roulette.max_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max total bet') }}</label>
                <input type="number" name="GAME_AMERICAN_ROULETTE_MAX_TOTAL_BET" class="form-control" value="{{ config('game-american-roulette.max_total_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Bet increment / decrement amount') }}</label>
                <input type="number" name="GAME_AMERICAN_ROULETTE_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-american-roulette.bet_change_amount') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Default bet amount') }}</label>
                <input type="number" name="GAME_AMERICAN_ROULETTE_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-american-roulette.default_bet_amount') }}">
            </div>
        </div>
    </div>
</div>
