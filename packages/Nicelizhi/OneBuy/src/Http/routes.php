<?php

use Illuminate\Support\Facades\Route;
use Nicelizhi\OneBuy\Http\Controllers\ProductController;
use Nicelizhi\OneBuy\Http\Controllers\ProductV2Controller;
use Nicelizhi\OneBuy\Http\Controllers\ProductV3Controller;

// default
Route::group(['middleware' => ['locale', 'theme', 'currency','web']], function () {

    Route::get('onebuy/{slug}', [ProductController::class, 'detail'])
        ->name('onebuy.product.page')
        ->middleware('cacheResponse');
    
    Route::any("onebuy/order/add/sync", [ProductController::class, "order_add_sync"])
        ->name("onebuy.order.add.sync");
    
    Route::any('onebuy/order/addr/after', [ProductController::class, "order_addr_after"])
        ->name("onebuy.order.addr.after");

    Route::any('onebuy/order/status', [ProductController::class, "order_status"])
        ->name("onebuy.order.status");


    Route::get('onebuy/checkout/success', [ProductController::class, "checkout_success"])->name('onebuy.checkout.success');

    Route::get('onebuy/order/query', [ProductController::class, "order_query"])->name('onebuy.order.query');
    Route::get('onebuy/recommended/query', [ProductController::class, "recommended_query"])->name('onebuy.recommended.query');

    Route::get('onebuy/order/log', [ProductController::class, "order_log"])->name('onebuy.order.log');
    Route::get('onebuy/order/confirm', [ProductController::class, "confirm"])->name('onebuy.order.confirm');

    Route::get('onebuy/page/{slug}', [ProductController::class, "cms"])->name('onebuy.cms.page');

});

// v2

Route::group(['middleware' => ['locale', 'theme', 'currency','web']], function () {

    Route::get('onebuy/v2/{slug}', [ProductV2Controller::class, 'detail'])
        ->name('onebuy.v2.product.page')
        ->middleware('cacheResponse');


});

// v3

Route::group(['middleware' => ['locale', 'theme', 'currency','web']], function () {

    Route::get('onebuy/v3/{slug}', [ProductV3Controller::class, 'detail'])
        ->name('onebuy.v3.product.page')
        ->middleware('cacheResponse');


});
