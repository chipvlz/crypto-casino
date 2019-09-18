<?php $__env->startSection('title'); ?>
    <?php echo e(__('Slots')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title_extra'); ?>
	<button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
		<?php echo e(__('Provably fair')); ?>

	</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('frontend.includes.provably-fair-form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
					<span class="name"><?php echo e(__('Balance')); ?>:</span>
					<span id="game_slots_balance" class="value">100</span>
				</div>
				<div class="bet">
					<div class="label"><?php echo e(__('Choose bet')); ?></div>
					<button id="game_slots_btn_bet_minus" class="bet minus" type="button"></button>
					<span id="game_slots_bet" class="value">999</span>
					<button id="game_slots_btn_bet_plus" class="bet plus" type="button"></button>
				</div>
				<button id="game_slots_btn_bet_max" class="bet-max" type="button"><span class="text-uppercase"><?php echo e(__('Max')); ?></span></button>
				<button id="game_slots_btn_spin" class="spin" type="button"></button>
				<div class="lines">
					<div class="label"><?php echo e(__('Select lines')); ?></div>
					<button id="game_slots_btn_lines_minus" class="lines minus" type="button"></button>
					<span id="game_slots_lines" class="value">19</span>
					<button id="game_slots_btn_lines_plus" class="lines plus" type="button"></button>
				</div>
				<button id="game_slots_btn_paytable" class="paytable" type="button"><span><?php echo e(__('Paytable')); ?></span></button>
				<button id="game_slots_btn_sound" class="sound" type="button"></button>
			</div>
		</div>
		<div id="game_slots_paytable_data" class="paytable">
			<i class="remove fa fa-times-circle"></i>
			<div class="paytable-inner">
				<div class="paytable-title">
					<div class="switcher active" data-section="paytable"><?php echo e(__("Paytable")); ?></div>
					<div class="switcher" data-section="reels"><?php echo e(__("Reels")); ?></div>
				</div>
				<div class="section-paytable show" data-section="paytable">
					<?php $__currentLoopData = $symbols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sym): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <div class="paytable-symbol">
							<div class="image"><img src="<?php echo e(asset('storage/games/slots/'.$sym['filename'])); ?>"></div>
							<div class="lines">
								<?php if($sym["wild"]): ?>
									<div class="wild-label"><?php echo e(__("Wild")); ?></div>
								<?php endif; ?>
								<?php if($sym["scatter"]): ?>
									<div class="scatter-label"><?php echo e(__("Scatter")); ?></div>
								<?php endif; ?>
								<?php for( $i=1 ; $i < 6 ; $i++): ?>
									<?php if($sym["w".$i]): ?>
										<div class="symbol-win-label">
											<span class="name">x<?php echo e($i); ?></span>
											<span class="value">
												<?php if($sym["w".$i."t"]=="x"): ?>
													<?php if($sym["scatter"]): ?>
														<?php echo e(__('Total bet')); ?>x<?php echo e($sym["w".$i]); ?>

													<?php else: ?>
														<?php echo e(__('Bet')); ?>x<?php echo e($sym["w".$i]); ?>

													<?php endif; ?>
												<?php else: ?>
													<?php echo e($sym["w".$i]); ?>

												<?php endif; ?>
											</span>
										</div>
									<?php endif; ?>
								<?php endfor; ?>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="section-paytable" data-section="reels">
					<div class="reels">
						<?php $__currentLoopData = $reels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="reel">
								<?php $__currentLoopData = $reel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sym_idx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="image"><img src="<?php echo e(asset('storage/games/slots/'.$symbols[$sym_idx]['filename'])); ?>"></div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="preloader">
			<div>
				<img src="<?php echo e(asset('images/games/slots/' . $settings->theme . '/loader.svg')); ?>" alt="">
				<span><?php echo e(__('Loading...')); ?><span class="value">0%</span></span>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/slots/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('js/preloadjs.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/soundjs.min.js')); ?>"></script>
	<script src="<?php echo e(mix('js/games/slots/game.js')); ?>"></script>
	<script>
		window.addEventListener("DOMContentLoaded",function(){
			window.game_slots_proto({
				game_id					: <?php echo e($game->id); ?>,
				play					: "<?php echo e(route('games.slots.play')); ?>",
				token					: "<?php echo e(csrf_token()); ?>",
				syms					: <?php echo json_encode($syms); ?>,
				paytable				: <?php echo json_encode($paytable); ?>,
				min_bet					: <?php echo e(config('game-slots.min_bet')); ?>,
				max_bet					: <?php echo e(config('game-slots.max_bet')); ?>,
				max_bet					: <?php echo e(config('game-slots.max_bet')); ?>,
				bet_change_amount		: <?php echo e(config('game-slots.bet_change_amount')); ?>,
				default_bet				: <?php echo e(config('game-slots.default_bet')); ?>,
				default_lines			: <?php echo e(config('game-slots.default_lines')); ?>,
				balance					: <?php echo e(auth()->user()->account->balance); ?>,
				reels					: <?php echo e(json_encode($reels)); ?>,
				lines					: <?php echo e(json_encode(\Packages\GameSlots\Services\GameSlotsService::lines)); ?>,
				animation_frames		: 14,
				animation_time			: 28,
				animation_size			: 200
			});
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>