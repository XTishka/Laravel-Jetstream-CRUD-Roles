<?php

namespace Modules\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Finance\Entities\Currency;
use Modules\Auth\Entities\User;

class CurrencyChangedEvent
{
    use SerializesModels;

    public $action;
    public $user_id;
    public $user_name;
    public $currency_id;
    public $currency_name;
    public $currency_code;
    public $currency_base;
    public $currency_object;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, Currency $currency, User $user)
    {
        $this->action = $action;
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->currency_id = $currency->id;
        $this->currency_name = $currency->title;
        $this->currency_code = $currency->code;
        $this->currency_base = $currency->base_currency;
        $this->currency_object = $currency;
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
