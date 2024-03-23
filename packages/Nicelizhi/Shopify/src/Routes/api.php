<?php

use Illuminate\Support\Facades\Route;

use Nicelizhi\Shopify\Http\Controllers\WebhooksController;


Route::group(['middleware' => ['api'], 'prefix' => 'shopify'], function () {

    Route::prefix('v1')->group(function () {

        Route::controller(WebhooksController::class)->prefix('webhooks')->group(function () {
            Route::post('.', 'v1')->name('shopify.webhook.v1');
            // orders
            Route::post('orders/updated', 'orders_updated')->name('shopify.webhook.v1.orders.updated');
            Route::post('orders/create', 'orders_create')->name('shopify.webhook.v1.orders.create');
            Route::post('orders/fulfilled', 'orders_fulfilled')->name('shopify.webhook.v1.orders.fulfilled');
            Route::post('orders/edited', 'orders_edited')->name('shopify.webhook.v1.orders.edited');
            Route::post('orders/paid', 'orders_paid')->name('shopify.webhook.v1.orders.paid');
            Route::post('order_transactions/create', 'order_transactions_create')->name('shopify.webhook.v1.order_transactions.create');
            //products
            

            // cuustomers
            Route::post('customers/create', 'customers_create')->name('shopify.webhook.v1.customers.create');
            Route::post('customers/update', 'customers_update')->name('shopify.webhook.v1.customers_update');
        });

    });
});