@extends('frontend.layouts.main')

@section('title')
    {{ __('Raffles history') }}
@endsection

@section('content')
    @if($raffles->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('There are no completed raffles yet.') }}
        </div>
    @else
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Winner') }}</th>
                <th class="text-right">
                    {{ __('Win amount') }}
                    <span data-balloon="{{ __('in credits') }}" data-balloon-pos="up">
                        <i class="far fa-question-circle"></i>
                    </span>
                </th>
                <th class="text-right">{{ __('Tickets purchased') }}</th>
                <th class="text-right"><i class="fas fa-arrow-down"></i> {{ __('Completed') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($raffles as $raffle)
                <tr>
                    <td data-title="{{ __('ID') }}">{{ $raffle->id }}</td>
                    <td data-title="{{ __('Winner') }}">
                        <a href="{{ route('frontend.users.show', $raffle->winner) }}">{{ $raffle->winner->name }}</a>
                    </td>
                    <td data-title="{{ __('Win amount') }}" class="text-right">{{ $raffle->_win_amount }}</td>
                    <td data-title="{{ __('Win amount') }}" class="text-right">
                        {{ $raffle->tickets->count() }} / {{ $raffle->total_tickets }}
                    </td>
                    <td data-title="{{ __('Created') }}" class="text-right">
                        {{ $raffle->end_date->diffForHumans() }}
                        <span data-balloon="{{ $raffle->end_date }}" data-balloon-pos="up">
                            <i class="far fa-clock"></i>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $raffles->links() }}
        </div>
    @endif
    <div class="mt-3">
        <a href="{{ route('frontend.raffle.index') }}"><i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to current raffle') }}</a>
    </div>
@endsection
