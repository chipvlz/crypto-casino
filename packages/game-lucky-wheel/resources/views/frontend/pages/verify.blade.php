<div class="form-group">
    <label>{{ __('Adjusted wheel position') }}</label>
    <input type="text" class="form-control text-muted" value="{{ $game->gameable->position }}" readonly>
    <small>
        {{ __('The wheel is spinned N extra times, where N corresponds to the Shift value.') }}
    </small>
</div>
