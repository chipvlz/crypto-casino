@extends('frontend.layouts.main')

@section('title')
    {{ __('Referral program') }}
@endsection

@section('content')
    <p>
        {{ __('Refer your friends to our casino and get bonus credits.') }}
        {{ __('Please copy the link below and share with your friends.') }}
    </p>
    <div class="input-group mb-3">
        <input id="referral-link-input" type="text" class="form-control text-muted" value="{{ $referral_url }}" readonly>
        <div class="input-group-append">
            <button type="button" class="btn btn-primary" onclick="copyToClipboard(document.getElementById('referral-link-input'))"><i class="far fa-copy"></i> {{ __('Copy') }}</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="mailto:?subject={{ urlencode($share_subject) }}&body={{ urlencode($share_body) }}">
                    {{ __('Send by email') }}
                </a>
                <a class="dropdown-item" href="https://web.whatsapp.com/send?text={{ urlencode($share_subject) . ':' . urlencode($referral_url) }}">
                    {{ __('Send by WhatsApp') }}
                </a>
                <a class="dropdown-item" href="https://www.facebook.com/sharer.php?u={{ urlencode($referral_url) }}">
                    {{ __('Share on Facebook') }}
                </a>
                <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode($referral_url) }}&text={{ urlencode($share_subject) }}">
                    {{ __('Share on Twitter') }}
                </a>
            </div>
        </div>
    </div>
    <p>
        {{ __('You will get the following bonuses for referred users.') }}
    </p>
    <ul>
        @if($referral_bonuses['referrer_sign_up_credits'])
            <li>
                {{ __('User signs up - :n credits', ['n' => $referral_bonuses['referrer_sign_up_credits']]) }}
                @if(config('settings.referral.referee_sign_up_credits'))
                    ({{ __('referred user will also get :n bonus credits', ['n' => $referral_bonuses['referee_sign_up_credits']]) }})
                @endif
            </li>
        @endif
        @if($referral_bonuses['referrer_game_bet_pct'])
            <li>
                {{ __('User plays a game - :n% of bet amount in credits', ['n' => $referral_bonuses['referrer_game_bet_pct']]) }}
            </li>
        @endif
        @if($referral_bonuses['referrer_deposit_pct'])
            <li>
                {{ __('User completes a deposit - :n% of deposit amount in credits', ['n' => $referral_bonuses['referrer_deposit_pct']]) }}
            </li>
        @endif
    </ul>
    <p>
        {{ __('You referred :n users and earned :total credits so far.', ['n' => $referred_users_count, 'total' => $referral_total_bonus]) }}
    </p>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/referrals.js') }}"></script>
@endpush