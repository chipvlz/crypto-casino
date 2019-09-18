<div class="form-group">
    <label>{{ __('Bet coins') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet_coins }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Bet amount') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet_amount }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Deck') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->deck }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Hold') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->hold }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Combination') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>