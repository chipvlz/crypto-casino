<?php $__env->startSection('title'); ?>
    <?php echo e(__('Account')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <table class="table table-hover table-stackable">
        <thead>
            <tr>
                <th>
                    <?php echo e(__('Balance')); ?>

                    <span data-balloon="<?php echo e(__('in credits')); ?>" data-balloon-pos="up">
                        <i class="far fa-question-circle"></i>
                    </span>
                </th>
                <th class="text-right"><?php echo e(__('Created')); ?></th>
                <th class="text-right"><?php echo e(__('Updated')); ?></th>
                <th class="text-right"><?php echo e(__('Actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-title="<?php echo e(__('Balance')); ?>"><?php echo e($account->_balance); ?></td>
                <td data-title="<?php echo e(__('Created')); ?>" class="text-right">
                    <?php echo e($account->created_at->diffForHumans()); ?>

                    <span data-balloon="<?php echo e($account->created_at); ?>" data-balloon-pos="up">
                        <i class="far fa-clock"></i>
                    </span>
                </td>
                <td data-title="<?php echo e(__('Updated')); ?>" class="text-right">
                    <?php echo e($account->updated_at->diffForHumans()); ?>

                    <span data-balloon="<?php echo e($account->updated_at); ?>" data-balloon-pos="up">
                        <i class="far fa-clock"></i>
                    </span>
                </td>
                <td class="text-right">
                    
                </td>
            </tr>
        </tbody>
    </table>
    <?php if(!$transactions->isEmpty()): ?>
        <h2><?php echo e(__('Transactions')); ?></h2>
        <table class="table table-hover table-stackable">
            <thead>
            <tr>
                <th><?php echo e(__('Type')); ?></th>
                <th><?php echo e(__('Reference')); ?></th>
                <th class="text-right">
                    <?php echo e(__('Amount')); ?>

                    <span data-balloon="<?php echo e(__('in credits')); ?>" data-balloon-pos="up">
                        <i class="far fa-question-circle"></i>
                    </span>
                </th>
                <th class="text-right">
                    <?php echo e(__('Running balance')); ?>

                    <span data-balloon="<?php echo e(__('in credits')); ?>" data-balloon-pos="up">
                        <i class="far fa-question-circle"></i>
                    </span>
                </th>
                <th class="text-right"><?php echo e(__('Created')); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-title="<?php echo e(__('Type')); ?>"><?php echo e(__('app.transaction_type_' . class_basename(get_class($transaction->transactionable)))); ?></td>
                    <td data-title="<?php echo e(__('Reference')); ?>">
                        <?php echo e($transaction->transactionable->id); ?>

                    </td>
                    <td data-title="<?php echo e(__('Amount')); ?>" class="text-right <?php echo e($transaction->amount > 0 ? 'text-success' : 'text-danger'); ?>">
                        <?php echo e($transaction->_amount); ?>

                    </td>
                    <td data-title="<?php echo e(__('Running balance')); ?>" class="text-right">
                        <?php echo e($transaction->_balance); ?>

                        <i class="fas fa-long-arrow-alt-<?php echo e($transaction->amount > 0 ? 'up text-success' : 'down text-danger'); ?>"></i>
                    </td>
                    <td data-title="<?php echo e(__('Created')); ?>" class="text-right">
                        <?php echo e($transaction->created_at->diffForHumans()); ?>

                        <span data-balloon="<?php echo e($transaction->created_at); ?>" data-balloon-pos="up">
                            <i class="far fa-clock"></i>
                        </span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?php echo e($transactions->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>