<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
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

    /**
     * Display a listing of the currencies.
     * @return Renderable
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('finance::currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new currency.
     * @return Renderable
     */
    public function create()
    {
        return view('finance::currencies.create');
    }

    /**
     * Store a newly created currency in storage.
     * @param StoreCurrencyRequest $request
     * @return Redirect
     */
    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->validated());
        $this->currencyService->updateBaseCurrency($currency);
        $this->currencyService->writeLog('currency', 'store', $currency->id, $request->all());
        return redirect()
            ->route('finance.currencies')
            ->with('success', trans('finance::currencies.flash_created'));
    }

    /**
     * Show the specified currency.
     * @param int $id
     * @return Renderable
     */
    public function show(int $id)
    {
        $currency = Currency::findorFail($id);
        return view('finance::currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified currency.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $currency = Currency::findorFail($id);
        return view('finance::currencies.edit', compact('currency'));
    }

    /**
     * Update the specified currency in storage.
     * @param UpdateCurrencyRequest $request
     * @param int $id
     * @return Redirect
     */
    public function update(UpdateCurrencyRequest $request, int $id)
    {
        $currency = Currency::findorFail($id);
        $currency->update($request->validated());
        if ($request->base_currency == 'on') $this->currencyService->updateBaseCurrency($currency);
        $this->currencyService->writeLog('currency', 'update', $currency->id, $request->all());
        return redirect()
            ->route('finance.currencies')
            ->with('success', trans('finance::currencies.flash_updated'));
    }

    /**
     * Remove the currency from storage.
     * @param int $id
     * @return Redirect
     */
    public function destroy(int $id)
    {
        $currency = Currency::findorFail($id);
        if ($currency->base_currency != 'on') {
            $currency->delete();
            $this->currencyService->writeLog('currency', 'trash', $currency->id, $currency);
            return redirect()->route('finance.currencies')->with('success', trans('finance::currencies.flash_trashed'));
        } else {
            return redirect()->route('finance.currencies')->with('warning', trans('finance::currencies.flash_cant_delete_base'));
        }
    }

    /**
     * Display a listing of the trashed currencies.
     * @return Renderable
     */
    public function trash()
    {
        $currencies = Currency::onlyTrashed()->get();
        return view('finance::currencies.trash', compact('currencies'));
    }

    /**
     * Restore the currency from trash.
     * @param int $id
     * @return Redirect
     */
    public function restore(int $id)
    {
        $currency = Currency::withTrashed()->where('id', $id)->restore();
        $this->currencyService->writeLog('currency', 'restore', $id, $currency);
        return redirect()->route('finance.currencies.trash')->with('success', trans('finance::currencies.flash_restored'));
    }

    /**
     * Complete remove the currency from trash.
     * @param int $id
     * @return Redirect
     */
    public function forceDelete(int $id)
    {
        $currency = Currency::withTrashed()->where('id', $id)->forceDelete();
        $this->currencyService->writeLog('currency', 'delete', $id, $currency);
        return redirect()->route('finance.currencies.trash')->with('success', trans('finance::currencies.flash_deleted'));
    }
}
