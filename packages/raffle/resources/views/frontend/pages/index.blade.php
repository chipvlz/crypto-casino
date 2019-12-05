@extends('frontend.layouts.main')

@section('title')
    {{ __('Raffle') }}
@endsection

@section('content')
    @if(!$raffle)
        <div class="alert alert-info" role="alert">
            {{ __('There are no raffles yet.') }}
        </div>
    @else
        @if($raffle->is_completed)
            <div class="card text-center border-primary">
                <div class="card-header bg-primary">
                    {{ __('Raffle is completed') }}
                </div>
                <div class="card-body">
                    @if($raffle->win_amount > 0)
                        <h4 class="card-title pt-3">
                            <a href="{{ route('frontend.users.show', $raffle->winner) }}">{{ $raffle->winner->name }}</a>
                            {{ __('won :x credits', ['x' => $raffle->_win_amount]) }}
                        </h4>
                    @else
                        <p class="card-text py-3">
                            {{ __('This raffle has no winner.') }}
                        </p>
                    @endif
                </div>
                <div class="card-footer border-primary text-muted">
                    @if($raffle->next_start_date->gt(\Illuminate\Support\Carbon::now()))
                        {{ __('Next raffle will start in :time', ['time' => $raffle->next_start_date->diffForHumans()]) }}
                    @else
                        {{ __('Next raffle should start soon') }}
                    @endif
                </div>
            </div>
        @else
            <div class="card text-center border-primary">
                <div class="card-header bg-primary">
                    {{ __('Raffle is in progress') }}
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ __('Win up to :n credits', ['n' => $raffle->_max_win_amount]) }}</h4>
                    <ul class="list-group list-group-horizontal-lg justify-content-center py-3">
                        <li class="list-group-item border-light">
                            {{ __('Tickets left') }}
                            <span class="badge badge-primary ml-1 p-2">{{ $raffle->total_tickets - $raffle->tickets->count() }}</span>
                        </li>
                        <li class="list-group-item border-light">
                            {{ __('Ticket price') }}
                            <span class="badge badge-primary ml-1 p-2">{{ $raffle->ticket_price }}</span>
                        </li>
                        <li class="list-group-item border-light">
                            {{ __('You purchased') }}
                            <span class="badge badge-primary ml-1 p-2">
                                {{ $tickets->where('account_id', auth()->user()->account->id)->count() }}
                                @if($raffle->max_tickets_per_user)
                                    / {{ $raffle->max_tickets_per_user }}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item border-light">
                            {{ __('Pot size') }}
                            <span class="badge badge-primary ml-1 p-2">{{ $raffle->_pot_size }}</span>
                        </li>
                    </ul>
                    @if($raffle->is_end_date_passed || $raffle->getMaxTicketsUserCanPurchase(auth()->user()) == 0)
                        <p class="card-text py-3">
                            {{ __('You can not purchase tickets at this time.') }}
                        </p>
                    @else
                        <p class="card-text py-3">
                            {{ __('Purchase raffle tickets.') }}
                            {{ __('A random ticket will be drawn at the end of the raffle.') }}
                            {{ __('The ticket owner will win the pot, which equals :pct% of all purchased tickets value.', ['pct' => $raffle->pot_size_pct]) }}
                            {{ __('The more tickets you purchase, the more chances you have to win.') }}
                        </p>
                        <form method="POST" action="{{ route('frontend.raffle.ticket', $raffle) }}">
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col-lg-4 offset-lg-4">
                                    <div class="input-group input-group">
                                        <input type="text" name="quantity" class="form-control text-center" placeholder="{{ __('Quantity') }}" value="{{ old('quantity') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">{{ __('Buy tickets') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="card-footer border-primary text-muted">
                    @if($raffle->is_end_date_passed)
                        {{ __('Raffle should finish soon') }}
                    @else
                        {{ __('Time remaining') }}
                        <countdown-timer end-date="{{ $raffle->end_date->timestamp }}"></countdown-timer>
                    @endif
                </div>
            </div>
        @endif
        @if($participants->count())
            <h2 class="mt-4">{{ __('Participants') }}</h2>
            <table class="table table-hover table-stackable">
                <thead>
                <tr>
                    <th>{{ __('User') }}</th>
                    <th class="text-right">{{ __('Tickets') }}</th>
                    <th class="text-right">{{ __('Last purchased') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td data-title="{{ __('User') }}">
                            <a href="{{ route('frontend.users.show', $participant->user) }}">{{ $participant->user->name }}</a>
                            @if($raffle->is_completed && $raffle->winner->id == $participant->user->id)
                                <span class="badge badge-info text-light">{{ __('winner') }}</span>
                            @endif
                        </td>
                        <td data-title="{{ __('Tickets purchased') }}" class="text-right">{{ $participant->tickets_count }}</td>
                        <td data-title="{{ __('Last purchased') }}" class="text-right">
                            {{ $participant->last_purchased->diffForHumans() }}
                            <span data-balloon="{{ $participant->last_purchased }}" data-balloon-pos="up">
                            <i class="far fa-clock"></i>
                        </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="col text-center mt-4">
            <a href="{{ route('frontend.raffle.history') }}" class="btn btn-primary">
                {{ __('View past raffles') }}
            </a>
        </div>
    @endif
@endsection
