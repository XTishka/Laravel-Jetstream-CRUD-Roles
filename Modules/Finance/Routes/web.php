<?php

use Modules\Finance\Http\Controllers\FinanceController;
use Modules\Finance\Http\Controllers\CurrenciesController;
use Modules\Finance\Http\Controllers\CounterpartyController;
use Modules\Finance\Http\Controllers\OperationsController;
use Modules\Finance\Http\Controllers\VatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'auth'], function () {
    Route::prefix('finance')->group(function() {

        // Dashboards
        Route::get('/finance', [FinanceController::class, 'index'])->name('finance');

        // Currencies
        Route::get('/currencies', [CurrenciesController::class, 'index'])->name('finance.currencies');
        Route::get('/currencies/create', [CurrenciesController::class, 'create'])->name('finance.currencies.create');
        Route::get('/currencies/show/{id}', [CurrenciesController::class, 'show'])->name('finance.currencies.show');
        Route::get('/currencies/edit/{id}', [CurrenciesController::class, 'edit'])->name('finance.currencies.edit');
        Route::get('/currencies/trash', [CurrenciesController::class, 'trash'])->name('finance.currencies.trash');

        Route::post('/currencies/create', [CurrenciesController::class, 'create'])->name('finance.currencies.create');
        Route::post('/currencies/store', [CurrenciesController::class, 'store'])->name('finance.currencies.store');
        Route::post('/currencies/edit/{id}', [CurrenciesController::class, 'edit'])->name('finance.currencies.edit');

        Route::put('/currencies/update/{id}', [CurrenciesController::class, 'update'])->name('finance.currencies.update');
        Route::put('/currencies/restore/{id}', [CurrenciesController::class, 'restore'])->name('finance.currencies.restore');

        Route::delete('/currencies/destroy/{id}', [CurrenciesController::class, 'destroy'])->name('finance.currencies.destroy');
        Route::delete('/currencies/forcedelete/{id}', [CurrenciesController::class, 'forceDelete'])->name('finance.currencies.forcedelete');

        // Counterparties
        Route::get('/finance.counterparties', [CounterpartyController::class, 'index'])->name('finance.counterparties');

        // Operations
        Route::get('/finance.operations', [OperationsController::class, 'index'])->name('finance.operations');

        // VAT
        Route::get('/finance.vat', [VatController::class, 'index'])->name('finance.vat');
    });
});


