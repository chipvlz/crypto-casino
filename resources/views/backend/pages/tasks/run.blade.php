@extends('backend.layouts.main')

@section('title')
    {{ __('Execute task') }}
@endsection

@section('content')
    <p>{{ $command['description'] }}</p>
    @if($command['comments'])
        <p>{{ $command['comments'] }}</p>
    @endif
    <form  class="ui form" method="POST" action="{{ route('backend.maintenance.task.run') }}">
        @csrf
        <input type="hidden" name="command" value="{{ $command['class'] }}">
        @foreach($command['arguments'] as $argument)
            <div class="form-group">
                <label>{{ $argument['title'] }}</label>
                <input type="text" name="{{ $argument['id'] }}" class="form-control" value="{{ $argument['default'] }}">
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">
            {{ __('Execute') }}
        </button>
    </form>
    <div class="mt-3">
        <a href="{{ route('backend.maintenance.index') }}"><i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to maintenance page') }}</a>
    </div>
@endsection