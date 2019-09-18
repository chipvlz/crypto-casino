<div class="form-group">
    <label>{{ __('Deck') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->deck }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Hand 1') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_hand }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Bet (hand 1)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Win (hand 1)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->win }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Score (hand 1)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_score }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Blackjack') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_blackjack ? __('yes') : __('no') }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Hand 2') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_hand2 }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Bet (hand 2)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->bet2 }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Win (hand 2)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->win2 }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Score (hand 2)') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->player_score2 }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Insurance bet') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->insurance_bet }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Insurance win') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->insurance_win }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Dealer hand') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->dealer_hand }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Dealer score') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->dealer_score }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Dealer blackjack') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->dealer_blackjack ? __('yes') : __('no') }}" readonly>
</div>
<div class="form-group">
    <label>{{ __('Result') }}</label>
    <input class="form-control text-muted" value="{{ $game->gameable->result }}" readonly>
</div>