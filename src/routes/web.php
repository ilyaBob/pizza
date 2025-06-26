<?php

use Domain\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/products', ProductController::class)->names('admin.products');
