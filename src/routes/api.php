<?php

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use Domain\Order\OrderController;
use Domain\Product\ProductController;
use Domain\Site\Basket\BasketController;
use Domain\Site\Order\OrderController as SiteOrderController;
use Domain\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(Admin::class)->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class)->names('products');
    Route::resource('orders', OrderController::class)
        ->names('orders')
        ->only(['index', 'update']);
});

Route::prefix('basket')->group(function () {
    Route::get('', [BasketController::class, 'index'])->name('basket.index');
    Route::post('change', [BasketController::class, 'change'])->name('basket.change');
    Route::delete('{basket}', [BasketController::class, 'destroy'])->name('basket.destroy');
});

// ****************************  Auth ****************************
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('me', [UserController::class, 'me'])->name('me');

    Route::resource('orders', SiteOrderController::class)
        ->names('orders')
        ->only(['index', 'store']);
});

Route::get('healthcheck', function (){
    return response()->json(['message' => 'OK']);
});
