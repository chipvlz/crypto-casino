<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-lucky-wheel" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Lucky Wheel')]) }}
            </button>
        </h5>
    </div>
    <div id="lucky-wheel-settings" data-options="{{ json_encode(['game_base_url' => url('/games/lucky-wheel'), 'variations' => config('game-lucky-wheel.variations'), JSON_NUMERIC_CHECK]) }}"></div>
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/games/lucky-wheel/' . $settings->theme . '.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('js/games/lucky-wheel/admin.js') }}"></script>
@endpush
