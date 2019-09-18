<div class="form-group">
    <label>{{ __('Adjusted roll') }}</label>
    <input type="text" class="form-control text-muted" value="{{ $game->gameable->roll }}" readonly>
    <small>
        {{ __('The initial roll is increased by the Shift value.') }}
    </small>
</div>