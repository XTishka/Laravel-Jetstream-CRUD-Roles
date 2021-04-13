<?php

namespace Modules\Finance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Modules\Finance\Entities\Currency;
use Modules\Finance\Http\Requests\StoreCurrencyRequest;
use Modules\Finance\Http\Requests\UpdateCurrencyRequest;
use Modules\Finance\Events\CurrencyChangedEvent;
use Modules\Finance\Events\CurrencyTrashEvent;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CurrenciesController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        abort_if(Gate::denies('finance_currencies'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currencies = Currency::paginate(10);
        return view('finance::currencies.index', compact('currencies'));
    }


    public function create()
    {
        abort_if(Gate::denies('finance_currencies'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('finance::currencies.create');
    }


    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->validated());
        event(new CurrencyChangedEvent('stored', $currency, Auth::user()));
        return redirect()
            ->route('finance.currencies')
            ->with('success', trans('finance::currencies.flash_created'));
    }


    public function show(int $id)
    {
        abort_if(Gate::denies('finance_currencies'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currency = Currency::findorFail($id);
        return view('finance::currencies.show', compact('currency'));
    }


    public function edit(int $id)
    {
        abort_if(Gate::denies('finance_currencies'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currency = Currency::findorFail($id);
        return view('finance::currencies.edit', compact('currency'));
    }


    public function update(UpdateCurrencyRequest $request, int $id)
    {
        $currency = Currency::findorFail($id);
        $currency->update($request->validated());
        event(new CurrencyChangedEvent('updated', $currency, Auth::user()));
        return redirect()
            ->route('finance.currencies')
            ->with('success', trans('finance::currencies.flash_updated'));
    }


    public function destroy(int $id)
    {
        $currency = Currency::findorFail($id);
        if ($currency->base_currency != 'on') {
            $currency->delete();
            event(new CurrencyTrashEvent('trashed', $id, Auth::user()));
            return redirect()->route('finance.currencies')->with('success', trans('finance::currencies.flash_trashed'));
        } else {
            return redirect()->route('finance.currencies')->with('warning', trans('finance::currencies.flash_cant_delete_base'));
        }
    }


    public function trash()
    {
        abort_if(Gate::denies('finance_currencies'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currencies = Currency::onlyTrashed()->paginate(10);
        return view('finance::currencies.trash', compact('currencies'));
    }


    public function restore(int $id)
    {
        Currency::withTrashed()->where('id', $id)->restore();
        event(new CurrencyTrashEvent('restored', $id, Auth::user()));
        return redirect()->route('finance.currencies.trash')->with('success', trans('finance::currencies.flash_restored'));
    }


    public function forceDelete(int $id)
    {
        Currency::withTrashed()->where('id', $id)->forceDelete();
        event(new CurrencyTrashEvent('completely_removed', $id, Auth::user()));
        return redirect()->route('finance.currencies.trash')->with('success', trans('finance::currencies.flash_deleted'));
    }
}
