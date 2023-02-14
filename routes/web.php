<?php

use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\PurchaseController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\StockController;
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
        Route::get('/sales', ['uses' => 'index', 'as' => 'sales.index']);
        Route::get('/download', ['uses' => 'generatePDF', 'as' => 'sales.generatePDF']);
        Route::get('/create/sales', ['uses' => 'create', 'as' => 'sales.create']);
        Route::get('/edit/sales', ['uses' => 'edit', 'as' => 'sales.edit']);
        Route::post('/store/sales', ['uses' => 'store', 'as' => 'sales.store']);
        Route::post('/update', ['uses' => 'update', 'as' => 'sales.update']);
        Route::get('/delete/sales', ['uses' => 'delete', 'as' => 'sales.delete']);
        Route::get('/delete/multiple', ['uses' => 'deleteMultiple', 'as' => 'sales.delete.multiple']);
    });

    Route::controller(VendorController::class)->middleware('admin')->group(function () {
        Route::get('/vendors', ['uses' => 'index', 'as' => 'vendor.index']);
        Route::get('/create/vendor', ['uses' => 'create', 'as' => 'vendor.create']);
        Route::get('/edit/vendor', ['uses' => 'edit', 'as' => 'vendor.edit']);
        Route::post('/store/vendor', ['uses' => 'store', 'as' => 'vendor.store']);
        Route::post('/update/vendor', ['uses' => 'update', 'as' => 'vendor.update']);
        Route::get('/delete/vendor', ['uses' => 'delete', 'as' => 'vendor.delete']);
        Route::get('/delete/multiple/vendor', ['uses' => 'deleteMultiple', 'as' => 'vendor.delete.multiple']);
    });

    Route::controller(PurchaseController::class)->middleware('admin')->group(function () {
        Route::get('/purchase', ['uses' => 'index', 'as' => 'purchase.index']);
        Route::get('/download-purchase-report', ['uses' => 'generatePDF', 'as' => 'purchase.generatePDF']);
        Route::get('/create/purchase', ['uses' => 'create', 'as' => 'purchase.create']);
        Route::get('/edit/purchase', ['uses' => 'edit', 'as' => 'purchase.edit']);
        Route::post('/store/purchase', ['uses' => 'store', 'as' => 'purchase.store']);
        Route::post('/update/purchase', ['uses' => 'update', 'as' => 'purchase.update']);
        Route::get('/delete/purchase', ['uses' => 'delete', 'as' => 'purchase.delete']);
        Route::get('/delete/multiple/purchase', ['uses' => 'deleteMultiple', 'as' => 'purchase.delete.multiple']);
    });

    Route::controller(StockController::class)->prefix('/stocks')->name('stocks.')->group(function(){
        Route::post('/{stock}', 'store');
        Route::delete('/{stock}', 'destroy');
        Route::get('/', 'index')->name('status');
        Route::get('/logs/{item?}', 'logs')->name('logs');
        Route::get('/{stock}', 'form')->name('form');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

include __DIR__ . '/auth.php';
