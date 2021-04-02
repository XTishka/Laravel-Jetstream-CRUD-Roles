<?php

namespace Modules\Finance\Services;

use Modules\Finance\Entities\Currency;
use Modules\Finance\Repository\CurrencyRepository;

class CurrencyService {

    public function checkBaseCurrency($currency) {
        $currencies = CurrencyRepository::class;
    }
}
