@extends('frontend.layouts.main')

@section('title')
    {{ __('Provably fair') }}
@endsection

@section('content')
    <h2>{{ __('Slots') }}</h2>
    @include('game-slots::frontend.pages.verify-description')

    @installed('game-dice')
        <h2 class="mt-4">{{ __('Dice') }}</h2>
        @include('game-dice::frontend.pages.verify-description')
    @endinstalled

    @installed('game-video-poker')
        <h2 class="mt-4">{{ __('Card games') }}</h2>
        @include('game-video-poker::frontend.pages.verify-description')
    @endinstalled

    @installed('game-roulette')
        <h2 class="mt-4">{{ __('Roulette') }}</h2>
        @include('game-roulette::frontend.pages.verify-description')
    @endinstalled

    @installed('game-american-bingo')
        <h2 class="mt-4">{{ __('Bingo') }}</h2>
        @include('game-american-bingo::frontend.pages.verify-description')
    @endinstalled

    @installed('game-keno')
        <h2 class="mt-4">{{ __('Keno') }}</h2>
        @include('game-keno::frontend.pages.verify-description')
    @endinstalled
@endsection