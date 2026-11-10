<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\InformationController;
use App\Http\Controllers\Store\MenuController;
use App\Http\Controllers\Store\OrderController;
use App\Http\Controllers\Store\ProductController;
use App\Http\Middleware\SetLocale;

Route::get('/', fn () => redirect('/fr'))->name('store.root');

Route::prefix('{locale}')
    ->where(['locale' => 'en|fr|ar'])
    ->middleware(SetLocale::class)
    ->group(function () {
        Route::get('/', HomeController::class)->name('store.home');
        Route::get('/menu', MenuController::class)->name('store.menu');
        Route::get('/products/{product}', ProductController::class)->name('store.product');
        Route::view('/cart', 'store.cart')->name('store.cart');
        Route::view('/checkout', 'store.checkout')->name('store.checkout');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('store.confirmation');
        Route::get('/about', [InformationController::class, 'about'])->name('store.about');
        Route::get('/contact', [InformationController::class, 'contact'])->name('store.contact');
    });
