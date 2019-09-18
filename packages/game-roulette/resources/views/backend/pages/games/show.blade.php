<div class="form-group">
    <label>{{ __('Roulette position') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->position }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Bet details') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>