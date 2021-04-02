<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\RolesController;
use Modules\Auth\Http\Controllers\UsersController;
use Modules\Auth\Http\Controllers\PermissionsController;
use Modules\Tasks\Http\Controllers\TasksController;
use Modules\Finance\Http\Controllers\FinanceController;
use Modules\Finance\Http\Controllers\CurrenciesController;
use Modules\Finance\Http\Controllers\CounterpartyController;
use Modules\Finance\Http\Controllers\OperationsController;
use Illuminate\Support\Facades\Log;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    // TODO: Разнести роуты по модулям

    // Module Auth
    Route::resource('auth/users', UsersController::class);
    Route::resource('auth/roles', RolesController::class);
    Route::resource('auth/permissions', PermissionsController::class);

    // Module Finance
    Route::resource('finance/dashboard', FinanceController::class);
    Route::resource('finance/currencies', CurrenciesController::class);
    Route::resource('finance/counterparties', CounterpartyController::class);
    Route::resource('finance/operations', OperationsController::class);
    Route::resource('finance/vat', OperationsController::class);

    // Module :: Tasks
    Route::resource('tasks',TasksController::class);
});
