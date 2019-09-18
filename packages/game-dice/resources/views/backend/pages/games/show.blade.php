<div class="form-group">
    <label>{{ __('Win chance') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->win_chance }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>