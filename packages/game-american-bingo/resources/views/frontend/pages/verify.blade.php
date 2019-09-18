<div class="form-group">
    <label>{{ __('Card') }}</label>
    <input type="text" class="form-control text-muted" value="{{ implode(',', $game->gameable->card) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Adjusted balls') }}</label>
    <input type="text" class="form-control text-muted" value="{{ implode(',', $game->gameable->balls) }}" readonly>
    <small>
        {{ __('Each initially generated number is increased by the Shift value.') }}
    </small>
</div>