<div class="form-group">
    <label>{{ __('Card') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->card) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Balls') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->balls) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>