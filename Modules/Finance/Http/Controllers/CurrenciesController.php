<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Entities\Currency;
use Modules\Finance\Http\Requests\StoreCurrencyRequest;
use Modules\Finance\Services\CurrencyService;

class CurrenciesController extends Controller
{
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $currencies = Currency::all();
        return view('finance::currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('finance::currencies.create');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->validated());
        $this->currencyService->checkBaseCurrency($currency);
        return redirect()->route('currencies.index');
    }

    public function show(Currency $currency)
    {
        return view('finance::currencies.show', compact('currency'));
    }

    public function edit($id)
    {
        return view('finance::currencies.index');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
