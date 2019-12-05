<div class="form-group">
    <label>{{ __('Deck') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->deck) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Bet type') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet_type_title }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Player hand') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->player_hand) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Player score') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_total }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Banker hand') }}</label>
    <input class="form-control text-muted" value="{{ implode(',', $game->gameable->banker_hand) }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Banker score') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->banker_total }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>
