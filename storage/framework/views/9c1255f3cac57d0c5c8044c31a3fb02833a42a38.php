<?php $__env->startSection('title'); ?>
    <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title_extra'); ?>
    <?php if(auth()->guard()->check()): ?>
        <?php if($user->id == auth()->user()->id): ?>
            <a href="<?php echo e(route('frontend.users.edit')); ?>" class="btn btn-primary">
                <i class="fas fa-pen"></i>
                <?php echo e(__('Edit')); ?>

            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12 col-lg-4 mt-3">
            <div class="card border-primary text-center">
                <div class="card-body text-primary">
                    <h4 class="card-title"><?php echo e(__('Played :x games', ['x' => $total_played])); ?></h4>
                    <p class="card-text"><small class="text-muted"><?php echo e(__('Last played :t', ['t' => $last_played ? $last_played->diffForHumans() : __('never')])); ?></small></p>
                </div>
            </div>
            <?php if($total_played>0): ?>
                <h3 class="text-center mt-4"><?php echo e(__('Games by result')); ?></h3>
                <pie-chart :data="<?php echo e(json_encode($games_by_result)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
                <h3 class="text-center mt-4"><?php echo e(__('Games by type')); ?></h3>
                <pie-chart :data="<?php echo e(json_encode($games_by_type)); ?>" theme="<?php echo e($settings->theme); ?>" class="pie-chart"></pie-chart>
                <h3 class="text-center mt-4"><?php echo e(__('Max win by game')); ?></h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo e(__('Game')); ?></th>
                        <th class="text-right"><?php echo e(__('Max win')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $games_by_type->sortByDesc('max_win'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($game['category']); ?></td>
                            <td class="text-right"><?php echo e($game['_max_win']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-lg-8 mt-3">
            <h3><?php echo e(__('Recent games')); ?></h3>
            <?php if(!$recent_games->isEmpty()): ?>
                <ul class="list-group list-group-flush">
                    <?php $__currentLoopData = $recent_games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-md-flex justify-content-between align-items-center">
                            <div>
                                <h5><?php echo e($game->title); ?></h5>
                                <p class="card-text mb-1"><?php echo e($game->gameable->result); ?></p>
                                <p class="card-text"><small class="text-muted"><?php echo e(__('Played :t', ['t' => $game->updated_at->diffForHumans()])); ?></small></p>
                            </div>
                            <div class="mt-2 mt-md-0">
                                <span class="badge badge-primary badge-pill p-2">
                                    <?php echo e(__('Bet :x', ['x' => $game->_bet])); ?>

                                </span>
                                <span class="badge badge-primary badge-pill p-2">
                                    <?php echo e(__('Win :x', ['x' => $game->_win])); ?>

                                </span>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__('No games were played yet.')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>