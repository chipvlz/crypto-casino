<div class="collapse" id="provably-fair-form">
    <div class="form-row">
        <div class="col-lg-8 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><?php echo e(__('Server hash')); ?></div>
                </div>
                <input type="text" class="form-control text-muted" id="server-hash-input" value="<?php echo e($game->server_hash); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><?php echo e(__('Client seed')); ?></div>
                </div>
                <input type="text" class="form-control" id="client-seed-input" value="" maxlength="32" placeholder="<?php echo e(__('Any random characters')); ?>">
            </div>
        </div>
    </div>
</div>