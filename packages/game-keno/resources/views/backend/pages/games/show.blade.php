<div class="form-group">
    <label>{{ __('Bet numbers') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->bet_numbers) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Draw numbers') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->draw_numbers) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>