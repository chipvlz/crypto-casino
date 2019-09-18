<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-dice" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Dice')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-dice" class="collapse">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Min bet') }}</label>
                <input type="number" name="GAME_DICE_MIN_BET" class="form-control" value="{{ config('game-dice.min_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Max bet') }}</label>
                <input type="number" name="GAME_DICE_MAX_BET" class="form-control" value="{{ config('game-dice.max_bet') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Bet increment / decrement amount') }}</label>
                <input type="number" name="GAME_DICE_BET_CHANGE_AMOUNT" class="form-control" value="{{ config('game-dice.bet_change_amount') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Min win chance') }}</label>
                <div class="input-group">
                    <input type="number" name="GAME_DICE_MIN_WIN_CHANCE" class="form-control" value="{{ config('game-dice.min_win_chance') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Max win chance') }}</label>
                <div class="input-group">
                    <input type="number" name="GAME_DICE_MAX_WIN_CHANCE" class="form-control" value="{{ config('game-dice.max_win_chance') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('House edge') }}</label>
                <div class="input-group">
                    <input type="number" name="GAME_DICE_HOUSE_EDGE" class="form-control" value="{{ config('game-dice.house_edge') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Default bet amount') }}</label>
                <input type="number" name="GAME_DICE_DEFAULT_BET_AMOUNT" class="form-control" value="{{ config('game-dice.default_bet_amount') }}">
            </div>
        </div>
    </div>
</div>