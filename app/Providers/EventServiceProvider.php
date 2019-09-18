<?php

namespace App\Providers;

use App\Events\DepositCompleted;
use App\Events\GamePlayed;
use App\Events\ChatMessageSent;
use App\Listeners\CreateAccount;
use App\Listeners\ReferralDepositBonus;
use App\Listeners\ReferralGameBonus;
use App\Listeners\ReferralSignUpBonus;
use App\Listeners\BroadcastChatMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            CreateAccount::class,
            ReferralSignUpBonus::class
        ],
        GamePlayed::class => [
            ReferralGameBonus::class
        ],
        DepositCompleted::class => [
            ReferralDepositBonus::class
        ],
        ChatMessageSent::class => [
            BroadcastChatMessage::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // email verification is enabled add dynamic event listener for Registered event (to send verification link).
        if (config('settings.users.email_verification')) {
            Event::listen(Registered::class, SendEmailVerificationNotification::class);
        }
    }
}