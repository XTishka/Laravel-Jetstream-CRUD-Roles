<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Finance\Entities\Currency;
use Modules\Finance\Http\Requests\StoreCurrencyRequest;
use Modules\Finance\Http\Requests\UpdateCurrencyRequest;
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
        $this->currencyService->updateBaseCurrency($currency);
        $this->currencyService->writeLog('currency', 'store', $currency->id, $request->all());
        return redirect()
            ->route('finance.currencies')
            ->with('success', 'Currency ' . $currency->title . ' created successfully!');;
    }

    public function show(int $id)
    {
        $currency = Currency::findorFail($id);
        return view('finance::currencies.show', compact('currency'));
    }

    public function edit($id)
    {
        $currency = Currency::findorFail($id);
        return view('finance::currencies.edit', compact('currency'));
    }

    public function update(UpdateCurrencyRequest $request, $id)
    {
        $currency = Currency::findorFail($id);
        $currency->update($request->validated());
        if ($request->base_currency == 'on') $this->currencyService->updateBaseCurrency($currency);
        $this->currencyService->writeLog('currency', 'update', $currency->id, $request->all());
        return redirect()
            ->route('finance.currencies')
            ->with('success', trans('Currency ' . $currency->title . ' updated successfully!'));
    }

    public function destroy($id)
    {
        $currency = Currency::findorFail($id);
        if ($currency->base_currency != 'on') {
            $currency->delete();
            $this->currencyService->writeLog('currency', 'trash', $currency->id, null);
            return redirect()->route('finance.currencies')->with('success', trans('Currency ' . $currency->title . ' deleted'));
        } else {
            return redirect()->route('finance.currencies')->with('warning', trans('You can\'t delete base currency.'));
        }

    }

    public function trash()
    {
        $currencies = Currency::onlyTrashed()->get();
        return view('finance::currencies.trash', compact('currencies'));
    }

    public function restore($id)
    {
        Currency::withTrashed()->where('id', $id)->restore();
        $this->currencyService->writeLog('currency', 'restore', $id, null);
        return redirect()->route('finance.currencies.trash')->with('success', trans('Currency restored'));
    }

    public function forceDelete($id)
    {
        Currency::withTrashed()->where('id', $id)->forceDelete();
        $this->currencyService->writeLog('currency', 'delete', $id, null);
        return redirect()->route('finance.currencies.trash')->with('success', trans('Currency complete deleted'));
    }
}
