<?php $__env->startSection('title'); ?>
    <?php echo e(__('75 Ball Bingo')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title_extra'); ?>
    <button class="btn btn-sm btn-primary float-right mt-2" type="button" data-toggle="collapse" data-target="#provably-fair-form" aria-expanded="false" aria-controls="provably-fair-form">
        <?php echo e(__('Provably fair')); ?>

    </button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="game-container" data-options="<?php echo e(json_encode($options, JSON_NUMERIC_CHECK)); ?>"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/games/american-bingo/' . $settings->theme . '.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(mix('js/games/american-bingo/game.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>