@extends('frontend.layouts.home')

@section('content')
    <div id="masthead" class="mb-5">
        <div class="jumbotron jumbotron-fluid bg-transparent text-center">
            <div class="container">
                <h1 class="display-3 text-light">{{ __('Crypto Casino') }}</h1>
                <p class="lead mt-4 mb-4 text-light">
                    {{ __('Fair online gaming platform') }}
                </p>
                <div>
                    @auth
                        <a href="{{ route('frontend.users.show', auth()->user()) }}" class="btn btn-primary btn-lg">{{ __('My profile') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-info btn-lg mr-2">{{ __('Log in') }}</a>
                        <a href="{{ route('register') }}" class="btn btn-info btn-lg">{{ __('Sign up') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2>{{ __('Free trial') }}</h2>
                    <p>
                        {{ __('Sign up and get :x free credits to play and try our casino.', ['x' => config('settings.accounts.initial_balance')]) }}
                    </p>
                    @auth
                        <a href="{{ route('frontend.users.show', auth()->user()) }}" class="btn btn-primary">{{ __('My profile') }}</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign up') }}</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2>{{ __('Deposit crypto') }}</h2>
                    <p>
                        {{ __('When you are ready to play for real deposit some coins and convert them into credits.') }}
                    </p>
                    @auth
                        <a href="{{ route('frontend.users.show', auth()->user()) }}" class="btn btn-primary">{{ __('My profile') }}</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign up') }}</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2>{{ __('Win, win, win') }}</h2>
                    <p>
                        {{ __('Place your bets, win games and climb up the leaderboard.') }}
                    </p>
                    @auth
                        <a href="{{ route('frontend.users.show', auth()->user()) }}" class="btn btn-primary">{{ __('My profile') }}</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign up') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @installed('game-slots')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col"><img src="{{ asset('storage/games/slots/cherry.png') }}" class="img-fluid"></div>
                    <div class="col"><img src="{{ asset('storage/games/slots/seven.png') }}" class="img-fluid"></div>
                    <div class="col"><img src="{{ asset('storage/games/slots/lemon.png') }}" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Try our slot machine') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Great payouts') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Bet 1 to 20 lines') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Your favorite fruit symbols') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Wilds and scatters') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Enjoy the sound of spinning reels!') }}</li>
                    </ul>
                    <a href="{{ route('games.slots.show') }}" class="btn btn-primary">{{ __('Play Slots') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-roulette')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play Roulette') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Red / black') }}, {{ __('Odd / Even') }}, {{ __('Low / High') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Dozen') }}, {{ __('Column') }}, {{ __('Street') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Split') }}, {{ __('Six line') }}, {{ __('Corner') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Top line') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Straight') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.roulette.show') }}" class="btn btn-primary">{{ __('Play Roulette') }}</a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="{{ asset('images/front/roulette.png') }}" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-blackjack')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col"><img src="{{ asset('images/front/blackjack.png') }}" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play Blackjack') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Blackjack pays 3 to 2') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Regular win pays 2 to 1') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Insurance pays 2 to 1') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Dealer draws to 16 and stands on 17') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Ability to double the initial bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Ability to split the hand') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.blackjack.show') }}" class="btn btn-primary">{{ __('Play Blackjack') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-video-poker')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play Video Poker') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Great payouts') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose any of 5 pay lines') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Cards are shuffled before each game') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.video-poker.show') }}" class="btn btn-primary">{{ __('Play Video Poker') }}</a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="{{ asset('images/front/poker-hand.png') }}" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-dice')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="{{ asset('images/front/dice.png') }}" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play Dice') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('House edge only :n%', ['n' => config('game-dice.house_edge')]) }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose payout') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose win chance') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.dice.show') }}" class="btn btn-primary">{{ __('Play Dice') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-american-bingo')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play 75 Ball Bingo') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Complete row, column, diagonal or 2 diagonals') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Receive money for each completed pattern') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.american-bingo.show') }}" class="btn btn-primary">{{ __('Play 75 Ball Bingo') }}</a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="{{ asset('images/front/american-bingo.png') }}" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    @installed('game-keno')
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="{{ asset('images/front/keno.png') }}" class="img-fluid w-75"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Play Keno') }}</h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Choose how much to bet') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Payouts start from :n hits', ['n' => key(array_filter(config('game-keno.payouts'), function($payout) { return intval($payout) > 0; }))]) }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Win as much as bet x :n credits', ['n' => config('game-keno.payouts')[10]]) }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Turn sound on / off') }}</li>
                        <li><i class="fas fa-thumbs-up p-2"></i> {{ __('Play in full screen mode') }}</li>
                    </ul>
                    <a href="{{ route('games.keno.show') }}" class="btn btn-primary">{{ __('Play Keno') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endinstalled

    <div class="jumbotron jumbotron-fluid bg-secondary text-info">
        <div class="container text-center text-lg-left">
            <h2 class="display-4">
                <i class="fas fa-shield-alt"></i>
                {{ __('Provably fair') }}
            </h2>
            <p class="lead">
                {{ __('Our casino uses provably fair technology, which allows you to verify that each roll or card draw is completely random and you are not being cheated!') }}
            </p>
            <div class="mt-5">
                <a href="{{ url('page/provably-fair') }}" class="btn btn-info btn-lg">{{ __('Learn more') }}</a>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2>{{ __('Recent games') }}</h2>
                    @if(!$games->isEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($games as $game)
                                <li class="list-group-item d-md-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>{{ $game->title }}</h5>
                                        <p class="card-text mb-1">{{ $game->gameable->result }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ __('Played by') }}
                                                <a href="{{ route('frontend.users.show', $game->account->user) }}">{{ $game->account->user->name }}</a>
                                                {{ $game->created_at->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="mt-2 mt-md-0">
                                        <span class="badge badge-primary badge-pill p-2">
                                            {{ __('Bet :x', ['x' => $game->_bet]) }}
                                        </span>
                                        <span class="badge badge-primary badge-pill p-2">
                                            {{ __('Win :x', ['x' => $game->_win]) }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div>
                            {{ __('No games were played yet.') }}
                        </div>
                    @endif
                    <div class="mt-3">
                        <a href="{{ route('frontend.history.recent') }}" class="btn btn-primary">{{ __('More recent games') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="{{ asset('images/front/mac-slots.png') }}" class="img-fluid">
            </div>
        </div>
    </div>

    @if($top_game)
        <div class="container pt-3 pb-3">
            <hr class="bg-primary">
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col col-lg-6 offset-lg-3 mb-5 text-center">
                    <div class="card text-center border border-primary">
                        <div class="card-header border-bottom border-primary bg-primary">
                            <h2 class="m-0">
                                <i class="fas fa-trophy"></i>
                                {{ __('Biggest win') }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $top_game->title }}</h5>
                            <p class="card-text">
                                <a href="{{ route('frontend.users.show', $top_game->account->user) }}">{{ $top_game->account->user->name }}</a>
                                {{ __('won :x credits', ['x' => $top_game->_win]) }}
                            </p>
                            <a href="{{ route('frontend.leaderboard') }}" class="btn btn-primary">{{ __('View leaderboard') }}</a>
                        </div>
                        <div class="card-footer text-muted border-top border-primary">
                            {{ $top_game->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col mb-5"></div>
@endsection