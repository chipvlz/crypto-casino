<div class="form-group">
    <label>{{ __('Cut deck') }}</label>
    <input type="text" class="form-control text-muted" value="{{ implode(',', $game->gameable->deck) }}" readonly>
    <small>
        {{ __('The first N cards are removed from the top of the deck and placed under the remaining cards. N is the remainder of dividing the Shift value by 52.') }}
    </small>
</div>
