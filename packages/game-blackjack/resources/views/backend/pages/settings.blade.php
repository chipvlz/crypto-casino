<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-blackjack" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Blackjack')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-blackjack" class="collapse">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Min bet') }}</label>
                <input type="number" name="GAME_BLACKJACK_MIN_BET" class="form-control" value="{{ config('game-blackjack.min_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max bet') }}</label>
                <input type="number" name="GAME_BLACKJACK_MAX_BET" class="form-control" value="{{ config('game-blackjack.max_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Bet increment / decrement amount') }}</label>
                <input type="number" name="GAME_BLACKJACK_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-blackjack.bet_change_amount') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Default bet amount') }}</label>
                <input type="number" name="GAME_BLACKJACK_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-blackjack.default_bet_amount') }}">
            </div>
        </div>
    </div>
</div>