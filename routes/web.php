<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

Route::get('/charts', [ChartController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});


Route::get('logistic/products/report', [ProductController::class, 'stockReport'])->name('logistic.products.report');
// Admin CRUD
Route::resource('logistic/products', ProductController::class)->names('logistic.products');
Route::resource('logistic/suppliers', SupplierController::class)->names('logistic.suppliers');
