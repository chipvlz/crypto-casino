<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-raffle" aria-expanded="true">
                {{ __('Raffle') }}
            </button>
        </h5>
    </div>
    <div id="tab-raffle" class="collapse">
        <div class="card-body text-body">
            <div class="form-group">
                <label>{{ __('Duration') }}</label>
                <select name="RAFFLE_DURATION" class="custom-select">
                    <option value="300" {{ config('raffle.duration')==300 ? 'selected' : '' }}>{{ __('5 minutes') }}</option>
                    <option value="600" {{ config('raffle.duration')==600 ? 'selected' : '' }}>{{ __('10 minutes') }}</option>
                    <option value="900" {{ config('raffle.duration')==900 ? 'selected' : '' }}>{{ __('15 minutes') }}</option>
                    <option value="1800" {{ config('raffle.duration')==1800 ? 'selected' : '' }}>{{ __('30 minutes') }}</option>
                    <option value="3600" {{ config('raffle.duration')==3600 ? 'selected' : '' }}>{{ __('1 hour') }}</option>
                    <option value="7200" {{ config('raffle.duration')==7200 ? 'selected' : '' }}>{{ __('2 hours') }}</option>
                    <option value="10800" {{ config('raffle.duration')==10800 ? 'selected' : '' }}>{{ __('3 hours') }}</option>
                    <option value="14400" {{ config('raffle.duration')==14400 ? 'selected' : '' }}>{{ __('4 hours') }}</option>
                    <option value="18000" {{ config('raffle.duration')==18000 ? 'selected' : '' }}>{{ __('5 hours') }}</option>
                    <option value="21600" {{ config('raffle.duration')==21600 ? 'selected' : '' }}>{{ __('6 hours') }}</option>
                    <option value="36000" {{ config('raffle.duration')==36000 ? 'selected' : '' }}>{{ __('10 hours') }}</option>
                    <option value="43200" {{ config('raffle.duration')==43200 ? 'selected' : '' }}>{{ __('12 hours') }}</option>
                    <option value="86400" {{ config('raffle.duration')==86400 ? 'selected' : '' }}>{{ __('1 day') }}</option>
                    <option value="172800" {{ config('raffle.duration')==172800 ? 'selected' : '' }}>{{ __('2 days') }}</option>
                    <option value="432000" {{ config('raffle.duration')==432000 ? 'selected' : '' }}>{{ __('5 days') }}</option>
                    <option value="604800" {{ config('raffle.duration')==604800 ? 'selected' : '' }}>{{ __('1 week') }}</option>
                    <option value="1209600" {{ config('raffle.duration')==1209600 ? 'selected' : '' }}>{{ __('2 weeks') }}</option>
                    <option value="1209600" {{ config('raffle.duration')==1209600 ? 'selected' : '' }}>{{ __('2 weeks') }}</option>
                    <option value="2592000" {{ config('raffle.duration')==2592000 ? 'selected' : '' }}>{{ __('1 month') }}</option>
                    <option value="5184000" {{ config('raffle.duration')==5184000 ? 'selected' : '' }}>{{ __('2 months') }}</option>
                    <option value="15552000" {{ config('raffle.duration')==15552000 ? 'selected' : '' }}>{{ __('6 months') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label>{{ __('Lag between raffles') }}</label>
                <select name="RAFFLE_LAG" class="custom-select">
                    <option value="0" {{ config('raffle.lag')==0 ? 'selected' : '' }}>{{ __('No lag') }}</option>
                    <option value="60" {{ config('raffle.lag')==60 ? 'selected' : '' }}>{{ __('1 minute') }}</option>
                    <option value="120" {{ config('raffle.lag')==120 ? 'selected' : '' }}>{{ __('2 minutes') }}</option>
                    <option value="300" {{ config('raffle.lag')==300 ? 'selected' : '' }}>{{ __('5 minutes') }}</option>
                    <option value="600" {{ config('raffle.lag')==600 ? 'selected' : '' }}>{{ __('10 minutes') }}</option>
                    <option value="900" {{ config('raffle.lag')==900 ? 'selected' : '' }}>{{ __('15 minutes') }}</option>
                    <option value="1800" {{ config('raffle.lag')==1800 ? 'selected' : '' }}>{{ __('30 minutes') }}</option>
                    <option value="3600" {{ config('raffle.lag')==3600 ? 'selected' : '' }}>{{ __('1 hour') }}</option>
                    <option value="7200" {{ config('raffle.lag')==7200 ? 'selected' : '' }}>{{ __('2 hours') }}</option>
                    <option value="10800" {{ config('raffle.lag')==10800 ? 'selected' : '' }}>{{ __('3 hours') }}</option>
                    <option value="14400" {{ config('raffle.lag')==14400 ? 'selected' : '' }}>{{ __('4 hours') }}</option>
                    <option value="18000" {{ config('raffle.lag')==18000 ? 'selected' : '' }}>{{ __('5 hours') }}</option>
                    <option value="21600" {{ config('raffle.lag')==21600 ? 'selected' : '' }}>{{ __('6 hours') }}</option>
                    <option value="36000" {{ config('raffle.lag')==36000 ? 'selected' : '' }}>{{ __('10 hours') }}</option>
                    <option value="43200" {{ config('raffle.lag')==43200 ? 'selected' : '' }}>{{ __('12 hours') }}</option>
                    <option value="86400" {{ config('raffle.lag')==86400 ? 'selected' : '' }}>{{ __('1 day') }}</option>
                    <option value="172800" {{ config('raffle.lag')==172800 ? 'selected' : '' }}>{{ __('2 days') }}</option>
                    <option value="432000" {{ config('raffle.lag')==432000 ? 'selected' : '' }}>{{ __('5 days') }}</option>
                    <option value="604800" {{ config('raffle.lag')==604800 ? 'selected' : '' }}>{{ __('1 week') }}</option>
                    <option value="1209600" {{ config('raffle.lag')==1209600 ? 'selected' : '' }}>{{ __('2 weeks') }}</option>
                    <option value="1209600" {{ config('raffle.lag')==1209600 ? 'selected' : '' }}>{{ __('2 weeks') }}</option>
                    <option value="2592000" {{ config('raffle.lag')==2592000 ? 'selected' : '' }}>{{ __('1 month') }}</option>
                </select>
                <small>{{ __('How long to wait since previous raffle completion before starting a new one.') }}</small>
            </div>
            <div class="form-group">
                <label>{{ __('Ticket price') }}</label>
                <div class="input-group">
                    <input type="number" name="RAFFLE_TICKET_PRICE" class="form-control" value="{{ config('raffle.ticket_price') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">{{ __('credits') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Max tickets per user') }}</label>
                <input type="number" name="RAFFLE_MAX_TICKETS_PER_USER" class="form-control" value="{{ config('raffle.max_tickets_per_user') }}">
                <small>{{ __('Input 0 to allow users purchasing unlimited number of tickets in each raffle.') }}</small>
            </div>
            <div class="form-group">
                <label>{{ __('Total number of tickets') }}</label>
                <input type="number" name="RAFFLE_TOTAL_TICKETS" class="form-control" value="{{ config('raffle.total_tickets') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Pot size') }}</label>
                <div class="input-group">
                    <input type="number" name="RAFFLE_POT_SIZE_PCT" class="form-control" value="{{ config('raffle.pot_size_pct') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <small>
                    {{ __('This value sets the raffle pot size as % amount of all purchased tickets value.') }}
                    {{ __('Suppose that this percentage value is 95, ticket price is 10.') }}
                    {{ __('If users purchase 120 tickets the actual pot size amount will be equal to 10 * 120 * 95 / 100 = 1140.') }}
                </small>
            </div>
        </div>
    </div>
</div>
