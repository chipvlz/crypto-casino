<?php $__env->startSection('content'); ?>
    <div id="masthead" class="mb-5">
        <div class="jumbotron jumbotron-fluid bg-transparent text-center">
            <div class="container">
                <h1 class="display-3 text-light"><?php echo e(__('Crypto Casino')); ?></h1>
                <p class="lead mt-4 mb-4 text-light">
                    <?php echo e(__('Fair online gaming platform')); ?>

                </p>
                <div>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="btn btn-primary btn-lg"><?php echo e(__('My profile')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-info btn-lg mr-2"><?php echo e(__('Log in')); ?></a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-info btn-lg"><?php echo e(__('Sign up')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2><?php echo e(__('Free trial')); ?></h2>
                    <p>
                        <?php echo e(__('Sign up and get :x free credits to play and try our casino.', ['x' => config('settings.accounts.initial_balance')])); ?>

                    </p>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="btn btn-primary"><?php echo e(__('My profile')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary"><?php echo e(__('Sign up')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2><?php echo e(__('Deposit crypto')); ?></h2>
                    <p>
                        <?php echo e(__('When you are ready to play for real deposit some coins and convert them into credits.')); ?>

                    </p>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="btn btn-primary"><?php echo e(__('My profile')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary"><?php echo e(__('Sign up')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 mt-3 mb-5">
                <div class="bg-secondary shadow p-3">
                    <h2><?php echo e(__('Win, win, win')); ?></h2>
                    <p>
                        <?php echo e(__('Place your bets, win games and climb up the leaderboard.')); ?>

                    </p>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="btn btn-primary"><?php echo e(__('My profile')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary"><?php echo e(__('Sign up')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-slots')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col"><img src="<?php echo e(asset('storage/games/slots/cherry.png')); ?>" class="img-fluid"></div>
                    <div class="col"><img src="<?php echo e(asset('storage/games/slots/seven.png')); ?>" class="img-fluid"></div>
                    <div class="col"><img src="<?php echo e(asset('storage/games/slots/lemon.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Try our slot machine')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Great payouts')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Bet 1 to 20 lines')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Your favorite fruit symbols')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Wilds and scatters')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Enjoy the sound of spinning reels!')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.slots.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Slots')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-roulette')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play Roulette')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Red / black')); ?>, <?php echo e(__('Odd / Even')); ?>, <?php echo e(__('Low / High')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Dozen')); ?>, <?php echo e(__('Column')); ?>, <?php echo e(__('Street')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Split')); ?>, <?php echo e(__('Six line')); ?>, <?php echo e(__('Corner')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Top line')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Straight')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.roulette.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Roulette')); ?></a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="<?php echo e(asset('images/front/roulette.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-blackjack')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col"><img src="<?php echo e(asset('images/front/blackjack.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play Blackjack')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Blackjack pays 3 to 2')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Regular win pays 2 to 1')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Insurance pays 2 to 1')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Dealer draws to 16 and stands on 17')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Ability to double the initial bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Ability to split the hand')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.blackjack.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Blackjack')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-video-poker')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play Video Poker')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Great payouts')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose any of 5 pay lines')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Cards are shuffled before each game')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.video-poker.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Video Poker')); ?></a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="<?php echo e(asset('images/front/poker-hand.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-dice')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="<?php echo e(asset('images/front/dice.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play Dice')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('House edge only :n%', ['n' => config('game-dice.house_edge')])); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose payout')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose win chance')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.dice.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Dice')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-american-bingo')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play 75 Ball Bingo')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Complete row, column, diagonal or 2 diagonals')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Receive money for each completed pattern')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.american-bingo.show')); ?>" class="btn btn-primary"><?php echo e(__('Play 75 Ball Bingo')); ?></a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="<?php echo e(asset('images/front/american-bingo.png')); ?>" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('installed', 'game-keno')): ?>
    <div class="container pt-3 pb-3">
        <hr class="bg-primary">
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 mt-5 order-lg-0 mt-lg-0">
                <div class="row">
                    <div class="col text-center"><img src="<?php echo e(asset('images/front/keno.png')); ?>" class="img-fluid w-75"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Play Keno')); ?></h2>
                    <ul class="list-inline">
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Choose how much to bet')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Payouts start from :n hits', ['n' => key(array_filter(config('game-keno.payouts'), function($payout) { return intval($payout) > 0; }))])); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Win as much as bet x :n credits', ['n' => config('game-keno.payouts')[10]])); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Turn sound on / off')); ?></li>
                        <li><i class="fas fa-thumbs-up p-2"></i> <?php echo e(__('Play in full screen mode')); ?></li>
                    </ul>
                    <a href="<?php echo e(route('games.keno.show')); ?>" class="btn btn-primary"><?php echo e(__('Play Keno')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="jumbotron jumbotron-fluid bg-secondary text-info">
        <div class="container text-center text-lg-left">
            <h2 class="display-4">
                <i class="fas fa-shield-alt"></i>
                <?php echo e(__('Provably fair')); ?>

            </h2>
            <p class="lead">
                <?php echo e(__('Our casino uses provably fair technology, which allows you to verify that each roll or card draw is completely random and you are not being cheated!')); ?>

            </p>
            <div class="mt-5">
                <a href="<?php echo e(url('page/provably-fair')); ?>" class="btn btn-info btn-lg"><?php echo e(__('Learn more')); ?></a>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-secondary p-4">
                    <h2><?php echo e(__('Recent games')); ?></h2>
                    <?php if(!$games->isEmpty()): ?>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-md-flex justify-content-between align-items-center">
                                    <div>
                                        <h5><?php echo e($game->title); ?></h5>
                                        <p class="card-text mb-1"><?php echo e($game->gameable->result); ?></p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <?php echo e(__('Played by')); ?>

                                                <a href="<?php echo e(route('frontend.users.show', $game->account->user)); ?>"><?php echo e($game->account->user->name); ?></a>
                                                <?php echo e($game->created_at->diffForHumans()); ?>

                                            </small>
                                        </p>
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
                        <div>
                            <?php echo e(__('No games were played yet.')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="mt-3">
                        <a href="<?php echo e(route('frontend.history.recent')); ?>" class="btn btn-primary"><?php echo e(__('More recent games')); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="<?php echo e(asset('images/front/mac-slots.png')); ?>" class="img-fluid">
            </div>
        </div>
    </div>

    <?php if($top_game): ?>
        <div class="container pt-3 pb-3">
            <hr class="bg-primary">
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col col-lg-6 offset-lg-3 mb-5 text-center">
                    <div class="card text-center border border-primary">
                        <div class="card-header border-bottom border-primary bg-primary">
                            <h2 class="m-0">
                                <i class="fas fa-trophy"></i>
                                <?php echo e(__('Biggest win')); ?>

                            </h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($top_game->title); ?></h5>
                            <p class="card-text">
                                <a href="<?php echo e(route('frontend.users.show', $top_game->account->user)); ?>"><?php echo e($top_game->account->user->name); ?></a>
                                <?php echo e(__('won :x credits', ['x' => $top_game->_win])); ?>

                            </p>
                            <a href="<?php echo e(route('frontend.leaderboard')); ?>" class="btn btn-primary"><?php echo e(__('View leaderboard')); ?></a>
                        </div>
                        <div class="card-footer text-muted border-top border-primary">
                            <?php echo e($top_game->created_at->diffForHumans()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col mb-5"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>