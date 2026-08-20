<?php

use App\Http\Controllers\web\ProductController;
use App\Http\Controllers\web\MovementController;
use App\Http\Controllers\web\StorageController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::group(['prefix' => '', 'middleware' => []], function () {
    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::get('{product}/show', [ProductController::class, 'show'])->name('show');
        Route::put('{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'movements', 'as' => 'movements.'], function() {
        Route::get('', [MovementController::class, 'index'])->name('index');
        Route::get('create', [MovementController::class, 'create'])->name('create');
        Route::post('', [MovementController::class, 'store'])->name('store');
        Route::get('{movement}/show', [MovementController::class, 'show'])->name('show');
        Route::put('{movement}', [MovementController::class, 'update'])->name('update');
        Route::delete('{movement}', [MovementController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'storages', 'as' => 'storages.'], function() {
        Route::get('', [StorageController::class, 'index'])->name('index');
        Route::get('create', [StorageController::class, 'create'])->name('create');
        Route::post('', [StorageController::class, 'store'])->name('store');
        Route::get('{storage}/show', [StorageController::class, 'show'])->name('show');
        Route::put('{storage}', [StorageController::class, 'update'])->name('update');
        Route::delete('{storage}', [StorageController::class, 'destroy'])->name('destroy');
    });
});
