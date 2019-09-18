@extends('frontend.layouts.main')

@section('title')
    {{ __('Slots') }}
@endsection

@section('title_extra')
	<button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
		{{ __('Provably fair') }}
	</button>
@endsection

@section('content')
	@include('frontend.includes.provably-fair-form')

    <div id="game_slots_container" class="game-slots-container">
		<div class="inner">
			<img class="bg" id="game_slots_bg">
			<canvas id="game_slots_drawable" width="1400" height="600"></canvas>
			<div class="int">
				<div class="win-line"><span id="game_slots_win_line"></span></div>
				<div id="game_slots_total_win_label" class="total-win-label"></div>
				
				<div id="game_slots_lines_btns" class="lines-btns">
					<div class="left">
						<button class="line" type="button" data-line="4"><span>4</span></button>
						<button class="line" type="button" data-line="2"><span>2</span></button>
						<button class="line" type="button" data-line="6"><span>6</span></button>
						<button class="line" type="button" data-line="9"><span>9</span></button>
						<button class="line" type="button" data-line="10"><span>10</span></button>
						<button class="line" type="button" data-line="1"><span>1</span></button>
						<button class="line" type="button" data-line="8"><span>8</span></button>
						<button class="line" type="button" data-line="7"><span>7</span></button>
						<button class="line" type="button" data-line="3"><span>3</span></button>
						<button class="line" type="button" data-line="5"><span>5</span></button>
					</div>
					<div class="right">
						<button class="line" type="button" data-line="11"><span>11</span></button>
						<button class="line" type="button" data-line="13"><span>13</span></button>
						<button class="line" type="button" data-line="16"><span>16</span></button>
						<button class="line" type="button" data-line="12"><span>12</span></button>
						<button class="line" type="button" data-line="15"><span>15</span></button>
						<button class="line" type="button" data-line="17"><span>17</span></button>
						<button class="line" type="button" data-line="19"><span>19</span></button>
						<button class="line" type="button" data-line="14"><span>14</span></button>
						<button class="line" type="button" data-line="18"><span>18</span></button>
						<button class="line" type="button" data-line="20"><span>20</span></button>
					</div>
				</div>
				<div class="balance">
					<span class="name">{{ __('Balance')}}:</span>
					<span id="game_slots_balance" class="value">100</span>
				</div>
				<div class="bet">
					<div class="label">{{ __('Choose bet') }}</div>
					<button id="game_slots_btn_bet_minus" class="bet minus" type="button"></button>
					<span id="game_slots_bet" class="value">999</span>
					<button id="game_slots_btn_bet_plus" class="bet plus" type="button"></button>
				</div>
				<button id="game_slots_btn_bet_max" class="bet-max" type="button"><span class="text-uppercase">{{ __('Max') }}</span></button>
				<button id="game_slots_btn_spin" class="spin" type="button"></button>
				<div class="lines">
					<div class="label">{{ __('Select lines') }}</div>
					<button id="game_slots_btn_lines_minus" class="lines minus" type="button"></button>
					<span id="game_slots_lines" class="value">19</span>
					<button id="game_slots_btn_lines_plus" class="lines plus" type="button"></button>
				</div>
				<button id="game_slots_btn_paytable" class="paytable" type="button"><span>{{ __('Paytable') }}</span></button>
				<button id="game_slots_btn_sound" class="sound" type="button"></button>
			</div>
		</div>
		<div id="game_slots_paytable_data" class="paytable">
			<i class="remove fa fa-times-circle"></i>
			<div class="paytable-inner">
				<div class="paytable-title">
					<div class="switcher active" data-section="paytable">{{ __("Paytable") }}</div>
					<div class="switcher" data-section="reels">{{ __("Reels") }}</div>
				</div>
				<div class="section-paytable show" data-section="paytable">
					@foreach ($symbols as $sym)
					    <div class="paytable-symbol">
							<div class="image"><img src="{{ asset('storage/games/slots/'.$sym['filename']) }}"></div>
							<div class="lines">
								@if($sym["wild"])
									<div class="wild-label">{{ __("Wild") }}</div>
								@endif
								@if($sym["scatter"])
									<div class="scatter-label">{{ __("Scatter") }}</div>
								@endif
								@for ( $i=1 ; $i < 6 ; $i++)
									@if($sym["w".$i])
										<div class="symbol-win-label">
											<span class="name">x{{$i}}</span>
											<span class="value">
												@if($sym["w".$i."t"]=="x")
													@if($sym["scatter"])
														{{ __('Total bet') }}x{{$sym["w".$i]}}
													@else
														{{ __('Bet') }}x{{$sym["w".$i]}}
													@endif
												@else
													{{$sym["w".$i]}}
												@endif
											</span>
										</div>
									@endif
								@endfor
							</div>
						</div>
					@endforeach
				</div>
				<div class="section-paytable" data-section="reels">
					<div class="reels">
						@foreach ($reels as $reel)
							<div class="reel">
								@foreach ($reel as $sym_idx)
									<div class="image"><img src="{{ asset('storage/games/slots/'.$symbols[$sym_idx]['filename']) }}"></div>
								@endforeach
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="preloader">
			<div>
				<img src="{{asset('images/games/slots/' . $settings->theme . '/loader.svg')}}" alt="">
				<span>{{ __('Loading...') }}<span class="value">0%</span></span>
			</div>
		</div>
	</div>
@endsection

@push('styles')
	<link rel="stylesheet" type="text/css" href="{{ mix('css/games/slots/' . $settings->theme . '.css') }}">
@endpush

@push('scripts')
	<script src="{{ asset('js/preloadjs.min.js') }}"></script>
	<script src="{{ asset('js/soundjs.min.js') }}"></script>
	<script src="{{ mix('js/games/slots/game.js') }}"></script>
	<script>
		window.addEventListener("DOMContentLoaded",function(){
			window.game_slots_proto({
				game_id					: {{ $game->id }},
				play					: "{{ route('games.slots.play') }}",
				token					: "{{ csrf_token() }}",
				syms					: {!! json_encode($syms) !!},
				paytable				: {!! json_encode($paytable) !!},
				min_bet					: {{ config('game-slots.min_bet') }},
				max_bet					: {{ config('game-slots.max_bet') }},
				max_bet					: {{ config('game-slots.max_bet') }},
				bet_change_amount		: {{ config('game-slots.bet_change_amount') }},
				default_bet				: {{ config('game-slots.default_bet') }},
				default_lines			: {{ config('game-slots.default_lines') }},
				balance					: {{ auth()->user()->account->balance }},
				reels					: {{ json_encode($reels) }},
				lines					: {{ json_encode(\Packages\GameSlots\Services\GameSlotsService::lines) }},
				animation_frames		: 14,
				animation_time			: 28,
				animation_size			: 200
			});
		});
	</script>
@endpush