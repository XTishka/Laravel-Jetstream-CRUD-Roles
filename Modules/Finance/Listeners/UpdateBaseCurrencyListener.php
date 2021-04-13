<?php

namespace Modules\Finance\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Finance\Entities\Currency;
use Illuminate\Support\Facades\Log;

class UpdateBaseCurrencyListener
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
    public function handle($event)
    {
        $currencies = Currency::where('base_currency', 'on')->get();
        if ($event->currency_base == 'on') {
            foreach ($currencies as $currency) {
                if ($currency->id != $event->currency_id) {
                    $currency->base_currency = null;
                    $currency->save();
                    Log::channel('finance_currencies')
                        ->notice(
                            "Base currency changed from ($currency->code) to ($event->currency_code)",
                            ['base_currency_update', "from:$currency->id", "to:$event->currency_id"]
                        );
                }
            }
        }
    }
}
