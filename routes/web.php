<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

Route::get('/charts', [ChartController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});

// Admin CRUD
Route::resource('admin/products', ProductController::class)->names('admin.products');
Route::resource('admin/suppliers', SupplierController::class)->names('admin.suppliers');
