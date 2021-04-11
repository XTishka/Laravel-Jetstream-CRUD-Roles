<?php

namespace Modules\Finance\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Finance\Entities\Currency;
use Modules\Finance\Repository\CurrencyRepository;

class CurrencyService
{

    public function updateBaseCurrency($newCurrency)
    {
        $currencies = Currency::where('base_currency', 'on')->get();
        if ($newCurrency->base_currency == 'on') {
            foreach ($currencies as $currency) {
                if ($currency->id != $newCurrency->id) {
                    $currency->base_currency = null;
                    $currency->save();
                }
            }
        }
    }

    public function writeLog($object, $action, $id, $data)
    {
        $channel = [
            'currency' => 'finance_currencies',
        ];
        $user = Auth::user()->id;
        Log::channel($channel[$object])->info("[user_$user] | [$action] | [$object" . "_" . "$id] | ", [$data]);
    }
}
