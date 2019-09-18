<footer class="footer border-top border-primary">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 text-center text-lg-left">
                <span class="text-muted">
                    &copy;
                    <a href="<?php echo e(route('frontend.index')); ?>" class="text-muted"><?php echo e(__('Crypto Casino')); ?></a>
                    <?php echo e(__('v.')); ?><?php echo e(config('app.version')); ?>

                </span>
            </div>
            <div class="col-12 col-lg-6 text-center text-lg-right">
                <i class="fas fa-shield-alt text-muted"></i>
                <a href="<?php echo e(url('page/provably-fair')); ?>" class="text-muted"><?php echo e(__('Provably fair')); ?></a>
                <span class="text-muted ml-2 mr-2">|</span>
                <a href="<?php echo e(url('page/privacy-policy')); ?>" class="text-muted"><?php echo e(__('Privacy policy')); ?></a>
                <span class="text-muted ml-2 mr-2">|</span>
                <a href="<?php echo e(url('page/terms-of-use')); ?>" class="text-muted"><?php echo e(__('Terms of use')); ?></a>
            </div>
        </div>
    </div>
</footer>