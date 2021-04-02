<?php

namespace Modules\Finance\Repository;

use Modules\Finance\Repository\CurrencyRepositoryInterface;
use Modules\Finance\Entities\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface {

    public function getBasicCurrencies($currencies) {
        dd($currencies);
    }
}
