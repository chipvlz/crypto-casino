<div class="card border-primary">
    <div class="card-header border-primary">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots" aria-expanded="true">
                {{ __('Game: :game', ['game' => __('Multi Slots')]) }}
            </button>
        </h5>
    </div>
    <div id="tab-game-multi-slots" class="collapse">
        <div class="card-body">
        
            <div class="accordion">
                @foreach(config('game-multi-slots.titles') as $index => $title)
                    @if($title)
                        <h5>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-container-{{ $index }}" aria-expanded="true">
                                {{ __($title) }}
                            </button>
                            <button class="btn btn-primary btn-sm" onclick="cloneGameSettings(event, {{ $index }})">{{ __('Clone') }}</button>
                            @if($index > 0)
                                <button class="btn btn-danger btn-sm" onclick="deleteGameSettings(event, {{ $index }})">{{ __('Delete') }}</button>
                            @endif
                        </h5>
                        <div id="tab-game-multi-slots-container-{{ $index }}" class="collapse ml-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-options-{{ $index }}" aria-expanded="true">
                                            {{ __('General') }}
                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-options-{{ $index }}" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>{{ __('Title') }}</label>
                                            <input type="text" name="GAME_MULTI_SLOTS_TITLES[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.titles')[$index] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Min bet') }}</label>
                                            <input type="text" name="GAME_MULTI_SLOTS_MIN_BET[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.min_bet')[$index] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Max bet') }}</label>
                                            <input type="text" name="GAME_MULTI_SLOTS_MAX_BET[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.max_bet')[$index] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Bet increment / decrement amount') }}</label>
                                            <input type="number" name="GAME_MULTI_SLOTS_BET_CHANGE_AMOUNT[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.bet_change_amount')[$index] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Default bet') }}</label>
                                            <input type="text" name="GAME_MULTI_SLOTS_DEFAULT_BET[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.default_bet')[$index] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Default lines count') }}</label>
                                            <input type="text" name="GAME_MULTI_SLOTS_DEFAULT_LINES[{{ $index }}]" class="form-control" value="{{ config('game-multi-slots.default_lines')[$index] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-symbols-{{ $index }}" aria-expanded="true">
                                            {{ __('Symbols') }}
                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-symbols-{{ $index }}" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">

                                            <div id="game_multi_slots_symbols_{{ $index }}" data-url="{{ route('backend.games.multi-slots.files', ['id' => $index]) }}" data-token="{{ csrf_token() }}" data-storage="{{ asset('storage') . '/games/multi-slots/' . $index . '/' }}" class="slots-symbols">
                                                <input id="game_multi_slots_symbols_input_{{ $index }}" type="hidden" name="GAME_MULTI_SLOTS_SYMBOLS[{{ $index }}]" value="{{ json_encode(config('game-multi-slots.symbols')[$index], JSON_FORCE_OBJECT) }}">
                                                <div id="game_multi_slots_symbols_items_{{ $index }}" class="items"></div>
                                                <div id="game_multi_slots_symbols_place_{{ $index }}" class="place-area">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                    <i class="fa fa-times-circle"></i>
                                                    <input type="file" multiple>
                                                    <div class="error text">{{ __('Only png can be used') }}</div>
                                                    {{ __('Drag and drop or upload a symbol image here') }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tab-game-multi-slots-reels-{{ $index }}" aria-expanded="true">
                                            {{ __('Reels') }}
                                        </button>
                                    </h5>
                                </div>
                                <div id="tab-game-multi-slots-reels-{{ $index }}" class="collapse ml-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <p>{{ __('Drag and drop availale symbols on the reels. You can also adjust the order of each symbol in the reel if necessary.') }}</p>
                                            <input id="game_multi_slots_reel_input_{{ $index }}" type="hidden" name="GAME_MULTI_SLOTS_REELS[{{ $index }}]" value="{{ json_encode(config('game-multi-slots.reels')[$index], JSON_FORCE_OBJECT) }}">
                                            <div id="game_multi_slots_reel_symbols_{{ $index }}" class="reel-symbols"></div>
                                            <div id="game_multi_slots_reels_{{ $index }}" class="reels">
                                                <div class="reel" data-idx="0"></div>
                                                <div class="reel" data-idx="1"></div>
                                                <div class="reel" data-idx="2"></div>
                                                <div class="reel" data-idx="3"></div>
                                                <div class="reel" data-idx="4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/games/slots/' . $settings->theme . '.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('js/games/multi-slots/admin.js') }}"></script>
    <script>
        @foreach(config('game-multi-slots.titles') as $index => $title)
            @if($title)
                window.addEventListener('DOMContentLoaded', function () {
                    window.game_multi_slots_config('{{ $index }}');
                });
            @endif
        @endforeach

        function createForm(url) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var element = document.createElement('input');
            element.type = 'hidden';
            element.name = '_token';
            element.value = '{{ @csrf_token() }}';
            form.appendChild(element);

            return form;
        }

        function cloneGameSettings(event, index) {
            event.preventDefault();
            var form = createForm('/admin/games/multi-slots/' + index + '/clone');
            document.body.appendChild(form);
            form.submit();
        }

        function deleteGameSettings(event, index) {
            event.preventDefault();
            var form = createForm('/admin/games/multi-slots/' + index + '/delete');
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endpush