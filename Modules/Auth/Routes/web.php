<?php

use Modules\Auth\Http\Controllers\UsersController;

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

// Route::group(['middleware' => 'auth'], function () {
//        Route::get('/', 'AuthController@index');
//     Route::prefix('/auth')->group(function () {

//         Users
//         Route::get('/users', [CurrenciesController::class, 'index'])->name('auth.currencies');
//         Route::get('/users/create', [CurrenciesController::class, 'create'])->name('auth.users.create');
//         Route::get('/users/show/{id}', [CurrenciesController::class, 'show'])->name('auth.users.show');
//         Route::get('/users/edit/{id}', [CurrenciesController::class, 'edit'])->name('auth.currencies.edit');
//         Route::get('/users/trash', [CurrenciesController::class, 'trash'])->name('auth.users.trash');

//         Route::post('/users/create', [CurrenciesController::class, 'create'])->name('auth.users.create');
//         Route::post('/users/store', [CurrenciesController::class, 'store'])->name('auth.users.store');
//         Route::post('/users/edit/{id}', [CurrenciesController::class, 'edit'])->name('auth.users.edit');

//         Route::put('/users/update/{id}', [CurrenciesController::class, 'update'])->name('auth.users.update');
//         Route::put('/users/restore/{id}', [CurrenciesController::class, 'restore'])->name('auth.users.restore');

//         Route::delete('/users/destroy/{id}', [CurrenciesController::class, 'destroy'])->name('auth.users.destroy');
//         Route::delete('/users/forcedelete/{id}', [CurrenciesController::class, 'forceDelete'])->name('auth.users.forcedelete');
//     });
// });
