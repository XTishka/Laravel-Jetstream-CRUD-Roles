<?php

namespace Modules\Finance\Repository;

use Modules\Finance\Entities\Currency;

interface CurrencyRepositoryInterface
{

    public function getBasicCurrencies(Currency $currencies);

}
