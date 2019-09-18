@extends('backend.layouts.main')

@section('title')
    {{ __('Settings') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('backend.settings.update') }}">
        @csrf
        <div class="accordion">
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-main" aria-expanded="true">
                            {{ __('Main') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-main" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label>{{ __('Theme') }}</label>
                            <select name="THEME" class="custom-select">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme }}" {{ $theme==config('settings.theme') ? 'selected' : '' }}>{{ __('app.theme_' . $theme) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Language') }}</label>
                            <select name="LOCALE" class="custom-select">
                                @foreach($locales as $code => $locale)
                                    <option value="{{ $code }}" {{ $code==config('app.locale') ? 'selected' : '' }}>{{ $locale->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-users" aria-expanded="true">
                            {{ __('Users') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-users" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="hidden" name="USERS_EMAIL_VERIFICATION" value="false">
                                <input type="checkbox" name="USERS_EMAIL_VERIFICATION" value="true" class="form-check-input" {{ config('settings.users.email_verification') ? 'checked="checked"' : '' }}>
                                <label class="form-check-label">
                                    {{ __('Require email verification') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Session lifetime') }}</label>
                            <select name="SESSION_LIFETIME" class="custom-select">
                                <option value="120" {{ config('session.lifetime')==120 ? 'selected' : '' }}>{{ __('2 hours') }}</option>
                                <option value="720" {{ config('session.lifetime')==720 ? 'selected' : '' }}>{{ __('12 hours') }}</option>
                                <option value="1440" {{ config('session.lifetime')==1440 ? 'selected' : '' }}>{{ __('24 hours') }}</option>
                                <option value="10080" {{ config('session.lifetime')==10080 ? 'selected' : '' }}>{{ __('1 week') }}</option>
                                <option value="10080" {{ config('session.lifetime')==10080 ? 'selected' : '' }}>{{ __('1 week') }}</option>
                                <option value="43200" {{ config('session.lifetime')==43200 ? 'selected' : '' }}>{{ __('1 month') }}</option>
                                <option value="525600" {{ config('session.lifetime')==525600 ? 'selected' : '' }}>{{ __('1 year') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-accounts" aria-expanded="true">
                            {{ __('Accounts') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-accounts" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label>{{ __('Initial account balance') }}</label>
                            <input type="text" name="ACCOUNTS_INITIAL_BALANCE" class="form-control" value="{{ config('settings.accounts.initial_balance') }}">
                            <small>{{ __('Number of credits assigned to user on sign up.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-referral-program" aria-expanded="true">
                            {{ __('Referral program') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-referral-program" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label>{{ __('Referee sign up bonus') }}</label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFEREE_SIGN_UP_CREDITS" class="form-control" value="{{ config('settings.referral.referee_sign_up_credits') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ __('credits') }}</span>
                                </div>
                            </div>
                            <small>{{ __('How much will the referred user get when signing up using a referral link.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Referrer sign up bonus') }}</label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_SIGN_UP_CREDITS" class="form-control" value="{{ config('settings.referral.referrer_sign_up_credits') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ __('credits') }}</span>
                                </div>
                            </div>
                            <small>{{ __('How much will the referrer user get when anyone signs up using their referral link.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Referrer game bonus') }}</label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_GAME_BET_PCT" class="form-control" value="{{ config('settings.referral.referrer_game_bet_pct') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small>{{ __('How much (% from the bet amount) will the referrer user get when any of the referred users plays a game.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Referrer deposit bonus') }}</label>
                            <div class="input-group">
                                <input type="text" name="REFERRAL_REFERRER_DEPOSIT_PCT" class="form-control" value="{{ config('settings.referral.referrer_deposit_pct') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small>{{ __('How much (% from the deposit amount) will the referrer user get when any of the referred users completes a deposit.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-bots" aria-expanded="true">
                            {{ __('Bots') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-bots" class="collapse">
                    <div class="card-body text-body">
                        <p>
                            {{ __('Bots can be automatically generated on the Users page.') }}
                            {{ __('Periodically (depending on the frequency setting) a random number of bots will be selected (according to min and max bots settings).') }}
                            {{ __('Then every selected bot will play exactly one game with random parameters.') }}
                        </p>
                        <div class="form-group">
                            <label>{{ __('Frequency') }}</label>
                            <select name="BOTS_PLAY_FREQUENCY" class="custom-select">
                                <option value="1" {{ config('settings.bots.play_frequency')==1 ? 'selected' : '' }}>{{ __('Every minute') }}</option>
                                <option value="5" {{ config('settings.bots.play_frequency')==5 ? 'selected' : '' }}>{{ __('Every 5 minutes') }}</option>
                                <option value="10" {{ config('settings.bots.play_frequency')==10 ? 'selected' : '' }}>{{ __('Every 10 minutes') }}</option>
                                <option value="15" {{ config('settings.bots.play_frequency')==15 ? 'selected' : '' }}>{{ __('Every 15 minutes') }}</option>
                                <option value="30" {{ config('settings.bots.play_frequency')==30 ? 'selected' : '' }}>{{ __('Every 30 minutes') }}</option>
                            </select>
                            <small>{{ __('Choose how often bots will play games.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Min bots') }}</label>
                            <input type="text" name="BOTS_SELECT_COUNT_MIN" class="form-control" value="{{ config('settings.bots.select_count_min') }}">
                            <small>{{ __('Minimum number of bots to play a game during each cycle.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Max bots') }}</label>
                            <input type="text" name="BOTS_SELECT_COUNT_MAX" class="form-control" value="{{ config('settings.bots.select_count_max') }}">
                            <small>{{ __('Maximum number of bots to play a game during each cycle.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-numbers" aria-expanded="true">
                            {{ __('Number formatting') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-numbers" class="collapse">
                    <div class="card-body text-body">
                        <div class="form-group">
                            <label>{{ __('Decimal point') }}</label>
                            <select name="FORMAT_NUMBER_DECIMAL_POINT" class="custom-select">
                                @foreach($separators as $code => $separator)
                                    <option value="{{ $code }}" {{ $code==config('settings.format.number.decimal_point') ? 'selected' : '' }}>{{ $separator }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Thousands separator') }}</label>
                            <select name="FORMAT_NUMBER_THOUSANDS_SEPARATOR" class="custom-select">
                                @foreach($separators as $code => $separator)
                                    <option value="{{ $code }}" {{ $code==config('settings.format.number.thousands_separator') ? 'selected' : '' }}>{{ $separator }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-mail" aria-expanded="true">
                            {{ __('Mail') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-mail" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Mail driver') }}</label>
                            <select name="MAIL_DRIVER" class="custom-select">
                                <option value="sendmail" {{ config('mail.driver')=='sendmail' ? 'selected' : '' }}>{{ __('SendMail') }}</option>
                                <option value="smtp" {{ config('mail.driver')=='smtp' ? 'selected' : '' }}>{{ __('SMTP') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP host') }}</label>
                            <input type="text" name="MAIL_HOST" class="form-control" value="{{ config('mail.host') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP port') }}</label>
                            <input type="text" name="MAIL_PORT" class="form-control" value="{{ config('mail.port') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP email from address') }}</label>
                            <input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="{{ config('mail.from.address') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP email from name') }}</label>
                            <input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{ config('mail.from.name') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP user') }}</label>
                            <input type="text" name="MAIL_USERNAME" class="form-control" value="{{ config('mail.username') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('SMTP password') }}</label>
                            <input type="password" name="MAIL_PASSWORD" class="form-control" value="{{ config('mail.password') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Mail encryption') }}</label>
                            <select name="MAIL_ENCRYPTION" class="custom-select">
                                <option value="" {{ !config('mail.encryption') ? 'selected' : '' }}>{{ __('None') }}</option>
                                <option value="tls" {{ config('mail.encryption')=='tls' ? 'selected' : '' }}>{{ __('TLS') }}</option>
                                <option value="ssl" {{ config('mail.encryption')=='ssl' ? 'selected' : '' }}>{{ __('SSL') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-integration" aria-expanded="true">
                            {{ __('Integration') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-integration" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Google Tag Manager container ID') }}</label>
                            <input type="text" name="GTM_CONTAINER_ID" class="form-control" value="{{ config('settings.gtm_container_id') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('reCaptcha public key') }}</label>
                            <input type="text" name="RECAPTCHA_PUBLIC_KEY" class="form-control" value="{{ config('settings.recaptcha.public_key') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('reCaptcha private key') }}</label>
                            <input type="text" name="RECAPTCHA_SECRET_KEY" class="form-control" value="{{ config('settings.recaptcha.secret_key') }}">
                            <small>
                                {{ __('Leave empty if you do not want to use reCaptcha validation. Public and private keys can be obtained at :url', ['url' => 'https://www.google.com/recaptcha']) }}
                            </small>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="BROADCAST_DRIVER" value="pusher">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pusher App ID') }}</label>
                            <input type="text" name="PUSHER_APP_ID" class="form-control" value="{{ config('broadcasting.connections.pusher.app_id') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pusher App key') }}</label>
                            <input type="text" name="PUSHER_APP_KEY" class="form-control" value="{{ config('broadcasting.connections.pusher.key') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pusher App secret') }}</label>
                            <input type="text" name="PUSHER_APP_SECRET" class="form-control" value="{{ config('broadcasting.connections.pusher.secret') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pusher cluster') }}</label>
                            <input type="text" name="PUSHER_APP_CLUSTER" class="form-control" value="{{ config('broadcasting.connections.pusher.options.cluster') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header border-primary">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-developer" aria-expanded="true">
                            {{ __('Developer') }}
                        </button>
                    </h5>
                </div>
                <div id="tab-developer" class="collapse">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="hidden" name="APP_DEBUG" value="false">
                                <input type="checkbox" name="APP_DEBUG" value="true" class="form-check-input" {{ config('app.debug') ? 'checked="checked"' : '' }}>
                                <label class="form-check-label">
                                    {{ __('Debug mode') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Log level') }}</label>
                            <select name="APP_LOG_LEVEL" class="custom-select">
                                @foreach($log_levels as $log_level)
                                    <option value="{{ $log_level }}" {{ $log_level==env('APP_LOG_LEVEL', 'emergency') ? 'selected' : '' }}>{{ __(ucfirst($log_level)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @packageview('backend.pages.settings')

        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection