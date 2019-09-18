@extends('frontend.layouts.main')

@section('title')
    {{ __('Blackjack') }}
@endsection

@section('title_extra')
    <button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
        {{ __('Provably fair') }}
    </button>
@endsection

@section('content')
    @include('frontend.includes.provably-fair-form')
    
	<div id="game_blackjack_container" class="gbj-container {{ config('settings.theme') }}">
		<div class="inner">
			<img id="game_blackjack_bg" class="bg" src="/images/games/blackjack/{{ config('settings.theme') }}/bg.png">
			<div class="gbj-btns-group-settings">
				<button id="gbj_btn_mute" type="button" class="gbj-btn-control gbj-btn-mute">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path fill="#fff" stroke="#fff" d="M7.6 20.9l-.1-.1H.7v-9.5h6.8l.1-.2 7.9-7.9v25.6l-7.9-7.9zM28.8 16c0-5.6-3.7-10.4-8.8-12.1V1.3a15.3 15.3 0 0 1 0 29.4v-2.6c5-1.7 8.8-6.5 8.8-12.1zM20 9.8c2 1.3 3.4 3.6 3.4 6.2S22 20.9 20 22.2V9.8z"/>
							<path class="mute" fill="#fff" stroke="#fff" d="M0 0L32 32" stroke-width="4"></path>
						</svg>
					</object>
				</button>
				<button id="gbj_btn_fulls" type="button" class="gbj-btn-control gbj-btn-fullscreen">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path class="fullscreen-enter" fill="#fff" stroke="#fff" d="M6 29h6v2H1V20h2v7l1-1 8-7 1 1-7 8-1 1h1zm7-17l-1 1-8-7-1-1v7H1V1h11v2H5l1 1 7 8zm16 14v-6h2v11H20v-2h7l-1-1-7-8 1-1 8 7 1 1v-1zM28 6l-8 7-1-1 7-8 1-1h-7V1h11v11h-2V5l-1 1z"/>
							<path class="fullscreen-exit" fill="#fff" stroke="#fff" d="M8 21H2v-2h11v11h-2v-7l-1 1-8 7-1-1 7-8 1-1zM22 8l8-7 1 1-7 8-1 1h7v2H19V2h2v7zM8 10L1 2l1-1 8 7 1 1V2h2v11H2v-2h7zM21 24v6h-2V19h11v2h-7l1 1 7 8-1 1-8-7-1-1z"/>
						</svg>
					</object>
				</button>
			</div>
            
			<div id="gbj_text_message" class="gbj-game-message">{{ __('Select cards to hold them') }}</div>
            
            <div id="gbj_deck" class="deck"></div>
            
            
            <div id="gbj_boss_cards" class="boss-cards"><span id="gbj_boss_cards_score" class="score"></span></div>
            
            <div id="gbj_my_cards" class="my-cards"><span id="gbj_hand1_score" class="score hand-1"></span><span id="gbj_hand2_score" class="score hand-2"></span></div>
            
			<div class="gbj-game-panel">
				<div class="gbj-bet-size">
					<div class="label text-uppercase">{{ __('Bet size') }}</div>
					<button id="gbj_bet_btn_minus" class="gbj-bet-btn minus" type="button"><span></span></button>
					<span id="gbj_bet_text" class="value">{{ config('game-blackjack.default_bet_amount') }}</span>
					<button id="gbj_bet_btn_plus" class="gbj-bet-btn plus" type="button"><span></span></button>
				</div>
				<button id="gbj_btn_hit" class="gbj-btn-hit gbj-btn-simple" type="button"><span class="text-uppercase">{{ __('Hit') }}</span></button>
				<button id="gbj_btn_stand" class="gbj-btn-stand gbj-btn-simple" type="button"><span class="text-uppercase">{{ __('Stand') }}</span></button>
				<button id="gbj_btn_deal" class="gbj-btn-deal" type="button"><span></span></button>
				<button id="gbj_btn_double" class="gbj-btn-double gbj-btn-simple" type="button"><span class="text-uppercase">{{ __('Double') }}</span></button>
				<button id="gbj_btn_split" class="gbj-btn-split gbj-btn-simple" type="button"><span class="text-uppercase">{{ __('Split') }}</span></button>
				<button id="gbj_btn_insurance" class="gbj-btn-insurance" type="button"><span class="text-uppercase">{{ __('Insurance') }}</span></button>
				<span class="insurance-shadow"></span>
				<div class="gbj-text balance">
					<span class="name">{{ __('Balance')}}</span>
					<span id="gbj_balance_text" class="value">{{ $game->account->balance }}</span>
				</div>
				
			</div>
		</div>
		<div id="gbj_preloader" class="preloader">
			<div>
				<img src="{{asset('images/games/blackjack/' . $settings->theme . '/loader.svg')}}" alt="">
				<span>{{ __('Loading...') }}<span id="gbj_preloader_text" class="value">0%</span></span>
			</div>
		</div>
	</div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/games/blackjack/' . $settings->theme . '.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/preloadjs.min.js') }}"></script>
    <script src="{{ asset('js/soundjs.min.js') }}"></script>
    <script src="{{ mix('js/games/blackjack/game.js') }}"></script>
    <script>
        new CGameBlackjack({
            game_id: {{ $game->id }},
            min_bet: {{ config('game-blackjack.min_bet') }},
            max_bet: {{ config('game-blackjack.max_bet') }},
			bet_change_amount: {{ config('game-blackjack.bet_change_amount') }},
            default_bet_amount: {{ config('game-blackjack.default_bet_amount') }},
            balance: {{ $game->account->balance }},
            routes: {
                deal: '{{ route('games.blackjack.deal') }}',
                insurance: '{{ route('games.blackjack.insurance') }}',
                hit: '{{ route('games.blackjack.hit') }}',
                double: '{{ route('games.blackjack.double') }}',
                stand: '{{ route('games.blackjack.stand') }}',
                split: '{{ route('games.blackjack.split') }}',
                splitHit: '{{ route('games.blackjack.split-hit') }}',
                splitStand: '{{ route('games.blackjack.split-stand') }}'
            },
            statuses: {
                completed: {{ \App\Models\Game::STATUS_COMPLETED }}
            },
            game_theme: '{{ config('settings.theme') }}'
        })
    </script>
@endpush