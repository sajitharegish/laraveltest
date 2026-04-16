<?php

use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/insertion', [UserController::class, 'insert']);
Route::get('/listing', [UserController::class, 'listing']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::post('/update/{id}', [UserController::class, 'update']);
Route::get('/delete/{id}', [UserController::class, 'delete']);
Route::get('/create', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store']);


// category subcategory product routes
Route::get('/create_product', [ProductController::class, 'create']);
Route::get('/get-subcategory/{id}', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'store']);
Route::get('/product_list', [ProductController::class, 'listProducts']);
Route::get('/product/delete/{id}', [ProductController::class, 'delete']);
Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
Route::post('/product/update/{id}', [ProductController::class, 'update']);

