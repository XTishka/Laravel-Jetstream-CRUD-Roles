<?php

namespace Modules\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Finance\Entities\Currency;
use Modules\Auth\Entities\User;

class CurrencyTrashEvent
{
    use SerializesModels;

    public $action;
    public $user_id;
    public $user_name;
    public $currency_id;
    public $currency_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $currency_id, User $user)
    {
        $this->action = $action;
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->currency_id = $currency_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
