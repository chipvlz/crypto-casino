<?php $__env->startSection('content'); ?>
    <div id="masthead" class="mb-5" style="height: 100%">
        <div class="jumbotron jumbotron-fluid bg-transparent text-center">
            <div class="container">
                <h1 class="display-3 text-light"><?php echo e(__('BetPress Casino')); ?></h1>
                <p class="lead mt-4 mb-4 text-light">
                    <?php echo e(__('Fair online gaming platform')); ?>

                </p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>