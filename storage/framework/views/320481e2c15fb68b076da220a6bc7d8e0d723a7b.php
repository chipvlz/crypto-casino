<script>
    (function() {
        <?php ($req = \Illuminate\Http\Request::createFromGlobals()); ?>
        const reference = '<?php echo $req->header('CASINO-REFERRAL-LINK'); ?>';
        const proxied = window.XMLHttpRequest.prototype.open;
        window.XMLHttpRequest.prototype.open = function() {
            if (arguments && arguments[1]) {
                if (arguments[1].startsWith('/')) {
                    arguments[1] = reference+arguments[1];
                } else if (arguments[1].startsWith("http") && arguments[1].includes("://casino")) {
                    arguments[1] = reference+arguments[1].substr('http'.length+'://casino'.length);
                }
            }

            console.log( arguments[1] );
            return proxied.apply(this, [].slice.call(arguments));
        };
    })();
</script>
<script type="text/javascript" src="<?php echo e(asset('js/variables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/locale.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/manifest.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/vendor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
