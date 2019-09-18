<div class="form-group">
    <label>{{ __('Adjusted roulette wheel position') }}</label>
    <input type="text" class="form-control text-muted" value="{{ $game->gameable->position }}" readonly>
    <small>
        {{ __('Roulette wheel is spinned N extra times, where N corresponds to the Shift value.') }}
    </small>
</div>