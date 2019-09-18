<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="<?php echo e(route('frontend.index')); ?>">
            <img src="<?php echo e(asset('images/logo.png')); ?>" class="d-inline-block align-top" alt="<?php echo e(__('Crypto Casino')); ?>">
            <?php echo e(__('Crypto Casino')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <div class="navbar-nav flex-grow-1">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Games')); ?>

                    </a>
                    <div id="menu-dropdown-games" class="dropdown-menu">
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-slots')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.slots.show')); ?>"><?php echo e(__('Slots')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-multi-slots')): ?>
                            <?php $__currentLoopData = config('game-multi-slots.titles'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($title): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('games.multi-slots.show', ['index' => $index])); ?>"><?php echo e(__($title)); ?></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-dice')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.dice.show')); ?>"><?php echo e(__('Dice')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-blackjack')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.blackjack.show')); ?>"><?php echo e(__('Blackjack')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-video-poker')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.video-poker.show')); ?>"><?php echo e(__('Video Poker')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-roulette')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.roulette.show')); ?>"><?php echo e(__('Roulette')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-american-bingo')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.american-bingo.show')); ?>"><?php echo e(__('75 Ball Bingo')); ?></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-keno')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('games.keno.show')); ?>"><?php echo e(__('Keno')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('History')); ?>

                    </a>
                    <div id="menu-dropdown-history" class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo e(route('frontend.history.recent')); ?>"><?php echo e(__('Recent games')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.history.top-wins')); ?>"><?php echo e(__('Top wins')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.history.top-losses')); ?>"><?php echo e(__('Top losses')); ?></a>
                        <?php if(auth()->guard()->check()): ?>
                            <a class="dropdown-item" href="<?php echo e(route('frontend.history.my')); ?>"><?php echo e(__('My games')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <a class="nav-item nav-link" href="<?php echo e(route('frontend.leaderboard')); ?>"><?php echo e(__('Leaderboard')); ?></a>
                <?php if(config('broadcasting.connections.pusher.key')): ?>
                    <a class="nav-item nav-link" href="<?php echo e(route('frontend.chat.index')); ?>"><?php echo e(__('Chat')); ?></a>
                <?php endif; ?>
            </div>
            <?php if(auth()->guard()->guest()): ?>
                <div class="navbar-nav">
                    <a href="<?php echo e(route('login')); ?>" class="btn text-white-50 mr-2"><?php echo e(__('Log in')); ?></a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-info text-white"><?php echo e(__('Sign up')); ?></a>
                </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <locale-select :locales="<?php echo e(json_encode($locale->locales())); ?>" :locale="<?php echo e(json_encode($locale->locale())); ?>"></locale-select>
                <div class="navbar-nav dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(auth()->user()->name); ?>

                    </a>
                    <div class="dropdown-menu">
                        <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('backend.dashboard.index')); ?>">
                                <i class="fas fa-cogs"></i>
                                <?php echo e(__('Backend')); ?>

                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.users.show', auth()->user())); ?>">
                            <i class="far fa-user"></i>
                            <?php echo e(__('Profile')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.account.show')); ?>">
                            <i class="fas fa-wallet"></i>
                            <?php echo e(__('Account')); ?>

                        </a>

                        

                        <a class="dropdown-item" href="<?php echo e(route('frontend.referrals.index')); ?>">
                            <i class="fas fa-retweet"></i>
                            <?php echo e(__('Referral program')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.security.index')); ?>">
                            <i class="fas fa-shield-alt"></i>
                            <?php echo e(__('Security')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('frontend.users.password.edit')); ?>">
                            <i class="fas fa-key"></i>
                            <?php echo e(__('Change password')); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="post" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <?php echo e(__('Log out')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</div>
