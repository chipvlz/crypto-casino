<?php if($errors->any()): ?>
    <message :messages="<?php echo e(json_encode($errors->all())); ?>" type="danger" heading="<?php echo e(__('Error')); ?>"></message>
<?php elseif(session('error')): ?>
    <message message="<?php echo e(session('error')); ?>" type="danger" heading="<?php echo e(__('Error')); ?>"></message>
<?php elseif(session('warning')): ?>
    <message message="<?php echo e(session('warning')); ?>" type="warning" heading="<?php echo e(__('Warning')); ?>"></message>
<?php elseif(session('success')): ?>
    <message message="<?php echo e(session('success')); ?>" type="success" heading="<?php echo e(__('Success')); ?>"></message>
<?php elseif(session('status')): ?>
    <message message="<?php echo e(session('status')); ?>" type="success" heading="<?php echo e(__('Success')); ?>"></message>
<?php elseif(session('info')): ?>
    <message message="<?php echo e(session('info')); ?>" type="info" heading="<?php echo e(__('Info')); ?>"></message>
<?php endif; ?>

<?php if(session('view')): ?>
    <?php echo $__env->make(session('view'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>