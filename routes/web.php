<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::match(['GET', 'POST'], '/', 'login')->name('login');
    });
});

Route::middleware('auth')->group(function() {
    Route::prefix('dashboard')->group(function() {
        Route::controller(IndexController::class)->group(function() {
            Route::get('/', 'index')->name('dashboard');
            Route::get('logout', 'logout')->name('logout');
        });
        Route::middleware('signInAs:admin')->group(function() {
            Route::prefix('user')->group(function() {
                Route::controller(UserController::class)->group(function() {
                    Route::match(['GET'], '/', 'index')->name('user.index');
                    Route::match(['GET', 'POST'], 'create', 'create')->name('user.create');
                    Route::match(['GET', 'POST'], 'update/{id}', 'update')->name('user.update');
                    Route::match(['GET'], 'delete/{id}', 'delete')->name('user.delete');
                });
            });
            Route::prefix('paket')->group(function() {
                Route::controller(PaketController::class)->group(function() {
                    Route::match(['GET'], '/', 'index')->name('paket.index');
                    Route::match(['GET', 'POST'], 'create', 'create')->name('paket.create');
                    Route::match(['GET', 'POST'], 'update/{id}', 'update')->name('paket.update');
                    Route::match(['GET'], 'delete/{id}', 'delete')->name('paket.delete');
                });
            });
        });
        Route::middleware('signInAs:sales')->group(function() {
            Route::prefix('sales')->group(function() {
                Route::controller(SalesController::class)->group(function() {
                    Route::match(['GET'], '/', 'index')->name('sales.index');
                    Route::match(['GET', 'POST'], 'create', 'create')->name('sales.create');
                    Route::match(['GET'], 'export', 'exportExcel')->name('sales.export');
                });
            });
        });
    });
});
