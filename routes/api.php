<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::apiResource('people', 'PeopleController');
    Route::resource('makes', 'MakeController');
    Route::resource('colors', 'ColorController');
    Route::resource('groups', 'GroupController');
    Route::resource('series', 'SerieController');
    Route::resource('presentations', 'PresentationController');
    Route::resource('categories', 'CategoryController');
    Route::resource('unit_measures', 'UnitMeasureController');
    Route::resource('products', 'ProductController');
    Route::post('products/{product}/quick-orders', 'ProductQuickOrderController@store');
    Route::resource('commerces', 'CommerceController');
    Route::resource('customers', 'CustomerController');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('invoice-details', 'InvoiceDetailController');
    Route::post('invoice/{invoice}/gift-cards', 'InvoiceGiftCardController@store');
    Route::delete('invoice/{invoice}/gift-cards', 'InvoiceGiftCardController@destroy');
    Route::resource('cash-register', 'CashRegisterController');
    Route::resource('cash-register-deposits', 'CashRegisterDepositController');
    Route::apiResource('cash-register-expenses', 'CashRegisterExpenseController');
    Route::resource('gift-cards', 'GiftCardController');
    Route::resource('stock', 'StockController');
    Route::put('invoices/{invoice}/payments', 'InvoicePaymentController@update');
    Route::put('invoices/{invoice}/credit-payments', 'CreditInvoicePaymentController@update');
    Route::put('invoices/{invoice}/reverts', 'InvoiceRevertController@update');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
        Route::apiResource('warehouses', 'WarehouseController');
        Route::apiResource('audits', 'AuditController');
        Route::apiResource('audit-details', 'AuditDetailController');
        Route::apiResource('users', 'UserController');
        Route::group(['namespace' => 'Reports', 'prefix' => 'reports'], function() {
            Route::get('products', 'ProductReportController@index');
            Route::get('product-orders', 'ProductOrderReportController@index');
        });
    });

    Route::group(['namespace' => 'Transfer', 'prefix' => 'transfer'], function() {
        Route::apiResource('transfers', 'TransferController');
    });



});


/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
}); */
