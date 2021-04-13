<?php

namespace Modules\Finance\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Finance\Events\CurrencyChangedEvent;
use Modules\Finance\Events\CurrencyTrashEvent;
use Modules\Finance\Listeners\WriteCurrencyLogListener;
use Modules\Finance\Listeners\WriteCurrencyTrashLogListener;
use Modules\Finance\Listeners\UpdateBaseCurrencyListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CurrencyChangedEvent::class => [
            WriteCurrencyLogListener::class,
            UpdateBaseCurrencyListener::class,
        ],
        CurrencyTrashEvent::class => [
            WriteCurrencyTrashLogListener::class,
        ]
    ];
}