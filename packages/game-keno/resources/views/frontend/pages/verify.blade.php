<div class="form-group">
    <label>{{ __('Bet numbers') }}</label>
    <input type="text" class="form-control text-muted" value="{{ implode(',', $game->gameable->bet_numbers) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Draw numbers') }}</label>
    <input type="text" class="form-control text-muted" value="{{ implode(',', $game->gameable->draw_numbers) }}" readonly>
    <small>
        {{ __('Each initially generated number is increased by the Shift value.') }}
    </small>
</div>