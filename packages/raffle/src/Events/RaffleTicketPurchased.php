<?php

namespace Packages\Raffle\Events;

use App\Models\Account;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Packages\Raffle\Models\Raffle;

class RaffleTicketPurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $raffle;
    public $user;
    public $quantity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Raffle $raffle, User $user, int $quantity)
    {
        $this->raffle = $raffle;
        $this->user = $user;
        $this->quantity = $quantity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
