<?php

use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\PurchaseController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\admin\StockItemController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/test', 'api\v1\TestController@test');
Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');
    Route::get('/search', ['uses' => 'admin\SearchController@searchQuestion', 'as' => 'question.search']);

    Route::controller(CustomerController::class)->middleware('admin')->group(function () {
        Route::get('/customers', ['uses' => 'index', 'as' => 'customers.index']);
        Route::get('/create/customers', ['uses' => 'create', 'as' => 'customers.create']);
        Route::get('/edit/customers', ['uses' => 'edit', 'as' => 'customers.edit']);
        Route::post('/store/customers', ['uses' => 'store', 'as' => 'customers.store']);
        Route::post('/update/customers', ['uses' => 'update', 'as' => 'customers.update']);
        Route::get('/delete/customer', ['uses' => 'delete', 'as' => 'customers.delete']);
    });

    Route::controller(SalesController::class)->middleware('admin')->group(function () {
        Route::get('/sales', 'index')->name('sales.index');
        Route::get('/download', 'generatePDF')->name('sales.generatePDF');
        Route::get('/create/sales', 'create')->name('sales.create');
        Route::get('/edit/sales', 'edit')->name('sales.edit');
        Route::post('/store/sales', 'store')->name('sales.store');
        Route::post('/update', 'update')->name('sales.update');
        Route::get('/delete/sales', 'delete')->name('sales.delete');
        Route::get('/delete/multiple', 'deleteMultiple')->name('sales.delete.multiple');
    });

    Route::name('vendor.')->controller(VendorController::class)->group(function () {
        Route::get('/vendors', 'index')->name('index');
        Route::get('/vendors/{id}', 'form')->name('form');
        Route::post('/vendors/{id?}', 'store')->name('store');
        Route::delete('/vendors/{id}', 'delete')->name('delete');
    });

    Route::name('purchase.')->controller(PurchaseController::class)->middleware('admin')->group(function () {
        Route::get('/purchase', 'index')->name('index');
        Route::get('/download-purchase-report', 'generatePDF')->name('generatePDF');
        Route::get('/create/purchase', 'create')->name('create');
        Route::get('/edit/purchase', 'edit')->name('edit');
        Route::post('/store/purchase', 'store')->name('store');
        Route::post('/update/purchase', 'update')->name('update');
        Route::get('/delete/purchase', 'delete')->name('delete');
        Route::get('/delete/multiple/purchase', 'deleteMultiple')->name('delete.multiple');
    });

    Route::prefix('/stocks')->name('stocks.')->group(function () {

        Route::controller(StockItemController::class)->group(function () {
            Route::post('/update', 'store')->name('update');
            Route::get('/', 'index')->name('status');
            Route::get('/items_api', 'items_api')->name('status_api');
        });

        Route::controller(StockController::class)->group(function () {
            Route::post('/{stock}', 'store');
            Route::delete('/{stock}', 'destroy');
            Route::get('/logs/{item?}', 'logs')->name('logs');
            Route::get('/logs_api/{item?}', 'logs_api')->name('logs_api');
            Route::get('/{stock}', 'form')->name('form');
        });

    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

include __DIR__ . '/auth.php';