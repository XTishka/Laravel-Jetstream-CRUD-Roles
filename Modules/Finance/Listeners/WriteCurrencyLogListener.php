<?php

namespace Modules\Finance\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Finance\Events\CurrencyChangedEvent;
use Illuminate\Support\Facades\Log;

class WriteCurrencyLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CurrencyChangedEvent $event)
    {
        Log::channel('finance_currencies')
            ->info("$event->user_name $event->action a currency ($event->currency_code)", 
            [$event->action, "user_id:$event->user_id", "currency_id:$event->currency_id", $event->currency_object]);
    }
}
