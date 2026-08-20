<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
        // Api Resources Routes
        Route::apiResource('products', \App\Http\Controllers\api\v1\ProductController::class);
        Route::apiResource('movements', \App\Http\Controllers\api\v1\MovementController::class);
        Route::apiResource('storages', \App\Http\Controllers\api\v1\StorageController::class);
    });
});
