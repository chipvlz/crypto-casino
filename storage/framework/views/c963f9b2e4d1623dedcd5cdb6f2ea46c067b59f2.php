<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('frontend.includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="<?php echo e(str_replace('.','-',Route::currentRouteName())); ?> theme-<?php echo e(config('settings.theme')); ?>">
    <?php echo $__env->renderWhen(config('settings.gtm_container_id'), 'frontend.includes.gtm-body', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path'))); ?>

    <div id="app">

        <div class="container-fluid bg-primary">
            <?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="container">

            <div class="mt-2">
                <?php $__env->startComponent('components.session.messages'); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div id="content" class="bg-secondary mt-3">
                <div class="row">
                    <div class="col">
                        <h1 class="mb-3">
                            <?php echo $__env->yieldContent('title'); ?>
                            <?php echo $__env->yieldContent('title_extra'); ?>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>

        </div>

        <?php echo $__env->first(['frontend.includes.footer-udf', 'frontend.includes.footer'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>

    <?php echo $__env->make('frontend.includes.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>