

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Video Poker')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title_extra'); ?>
	<button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
		<?php echo e(__('Provably fair')); ?>

	</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('frontend.includes.provably-fair-form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div id="game_video_poker_conteiner" class="gvp-conteiner game-video-poker <?php echo e(config('settings.theme')); ?>">
		<div class="inner">
			<img id="game_video_poker_bg" class="bg" src="/images/games/video-poker/<?php echo e(config('settings.theme')); ?>/bg.png">
			<div class="gvp-btns-group-settings">
				<button id="gvp_btn_mute" type="button" class="gvp-btn-mute">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path fill="#fff" stroke="#fff" d="M7.6 20.9l-.1-.1H.7v-9.5h6.8l.1-.2 7.9-7.9v25.6l-7.9-7.9zM28.8 16c0-5.6-3.7-10.4-8.8-12.1V1.3a15.3 15.3 0 0 1 0 29.4v-2.6c5-1.7 8.8-6.5 8.8-12.1zM20 9.8c2 1.3 3.4 3.6 3.4 6.2S22 20.9 20 22.2V9.8z"/>
							<path class="mute" fill="#fff" stroke="#fff" d="M0 0L32 32" stroke-width="4"></path>
						</svg>
					</object>
				</button>
				<button id="gvp_btn_fulls" type="button" class="gvp-btn-fullscreen">
					<object>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
							<path class="fullscreen-enter" fill="#fff" stroke="#fff" d="M6 29h6v2H1V20h2v7l1-1 8-7 1 1-7 8-1 1h1zm7-17l-1 1-8-7-1-1v7H1V1h11v2H5l1 1 7 8zm16 14v-6h2v11H20v-2h7l-1-1-7-8 1-1 8 7 1 1v-1zM28 6l-8 7-1-1 7-8 1-1h-7V1h11v11h-2V5l-1 1z"/>
							<path class="fullscreen-exit" fill="#fff" stroke="#fff" d="M8 21H2v-2h11v11h-2v-7l-1 1-8 7-1-1 7-8 1-1zM22 8l8-7 1 1-7 8-1 1h7v2H19V2h2v7zM8 10L1 2l1-1 8 7 1 1V2h2v11H2v-2h7zM21 24v6h-2V19h11v2h-7l1 1 7 8-1 1-8-7-1-1z"/>
						</svg>
					</object>
				</button>
			</div>
			<div id="gvp_text_message" class="gvp-game-message"><?php echo e(__('Select cards to hold them')); ?></div>
			<div id="gvp_paytable" class="gvp-paytable" data-amount="<?php echo e(config('game-video-poker.default_bet_amount')); ?>">
				<?php $__currentLoopData = array_reverse(array_slice($combinations, 1, NULL, TRUE), TRUE); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comb_id => $comb_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="gvp-paytable-line">
						<div class="gvp-paytable-name" data-combination="<?php echo e($comb_id); ?>"><?php echo e($comb_name); ?></div>
						<?php $__currentLoopData = json_decode(config('game-video-poker.paytable')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paytable_id => $paytable_bets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div data-id="<?php echo e($paytable_id + 1); ?>" class="gvp-paytable-bet"><span><?php echo e($paytable_bets[$comb_id]); ?></span></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<div id="gvp_game_body" class="gvp-game-body">
				<div id="gvp_card_01" class="gvp-card" data-id="0"><img id="gvp_card_img_01" ><span class="hold-text text-uppercase"><?php echo e(__('Hold')); ?></span></div>
				<div id="gvp_card_02" class="gvp-card" data-id="1"><img id="gvp_card_img_02" ><span class="hold-text text-uppercase"><?php echo e(__('Hold')); ?></span></div>
				<div id="gvp_card_03" class="gvp-card" data-id="2"><img id="gvp_card_img_03" ><span class="hold-text text-uppercase"><?php echo e(__('Hold')); ?></span></div>
				<div id="gvp_card_04" class="gvp-card" data-id="3"><img id="gvp_card_img_04" ><span class="hold-text text-uppercase"><?php echo e(__('Hold')); ?></span></div>
				<div id="gvp_card_05" class="gvp-card" data-id="4"><img id="gvp_card_img_05" ><span class="hold-text text-uppercase"><?php echo e(__('Hold')); ?></span></div>
			</div>
			<div class="gvp-game-panel">
				<button id="gvp_bet_btn_one" class="gvp-btn-bet-one" type="button"><span class="text-uppercase"><?php echo e(__('One')); ?></span></button>
				<div class="gvp-bet-size">
					<div class="label text-uppercase"><?php echo e(__('Bet size')); ?></div>
					<button id="gvp_bet_btn_minus" class="gvp-bet-btn minus" type="button"><span></span></button>
					<span id="gvp_bet_text" class="value"><?php echo e(config('game-video-poker.default_bet_coins')); ?></span>
					<button id="gvp_bet_btn_plus" class="gvp-bet-btn plus" type="button"><span></span></button>
				</div>
				<button id="gvp_bet_btn_max" class="gvp-btn-bet-max" type="button"><span class="text-uppercase"><?php echo e(__('Max')); ?></span></button>
				<button id="gvp_btn_deal" class="gvp-btn-deal" type="button"><span></span></button>
				<div class="gvp-text win">
					<span class="name"><?php echo e(__('Win')); ?></span>
					<span id="gvp_win_text" class="value">0</span>
				</div>
				<div class="gvp-text balance">
					<span class="name"><?php echo e(__('Balance')); ?></span>
					<span id="gvp_balance_text" class="value"><?php echo e(auth()->user()->account->balance); ?></span>
				</div>
				
			</div>
		</div>
		<div id="gvp_preloader" class="preloader">
			<div>
				<img src="<?php echo e(asset('images/games/video-poker/' . $settings->theme . '/loader.svg')); ?>" alt="">
				<span><?php echo e(__('Loading...')); ?><span id="gvp_preloader_text" class="value">0%</span></span>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/video-poker/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('js/preloadjs.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/soundjs.min.js')); ?>"></script>
    <script src="<?php echo e(mix('js/games/video-poker/game.js')); ?>"></script>
    <script>
		window.addEventListener("DOMContentLoaded",function(){
			window.game_video_poker_proto({
				game_id					: <?php echo e($game->id); ?>,
				draw					: "<?php echo e(route('games.video-poker.draw')); ?>",
				play					: "<?php echo e(route('games.video-poker.play')); ?>",
				token					: "<?php echo e(csrf_token()); ?>",
				min_bet					: <?php echo e(config('game-video-poker.min_bet')); ?>,
				max_bet					: <?php echo e(config('game-video-poker.max_bet')); ?>,
				bet_change_amount		: <?php echo e(config('game-video-poker.bet_change_amount')); ?>,
				default_bet_amount		: <?php echo e(config('game-video-poker.default_bet_amount')); ?>,
				default_bet_coins		: <?php echo e(config('game-video-poker.default_bet_coins')); ?>,
				balance					: <?php echo e(auth()->user()->account->balance); ?>,
				combinations			: <?php echo json_encode($combinations); ?>

			});
		});
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>