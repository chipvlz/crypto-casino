<link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/' . $settings->theme . '.css')); ?>">
<?php echo $__env->yieldPushContent('styles'); ?>
<?php if(file_exists(public_path('css/style-udf.css'))): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style-udf.css')); ?>">
<?php endif; ?>