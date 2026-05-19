<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo',[DemoController::class,'index']);
Route::get('/demo2',[DemoController::class,'index2']);
Route::get('/demo3',[DemoController::class,'index3']);
Route::get('/demo4/{id}',[DemoController::class,'index4']);
Route::get('/demo5/{id?}',[DemoController::class,'index5']);
Route::get('/demo6/{parram1}/{parram2}',[DemoController::class,'index6']);

// ================= CATEGORY =================
Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/category/create', [CategoryController::class, 'create']);
Route::post('/admin/category/store', [CategoryController::class, 'store']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);
Route::put('/admin/category/{id}', [CategoryController::class, 'update']);
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy']);


// ================= PRODUCT =================
Route::get('/admin/product', [ProductController::class, 'index']);
Route::get('/admin/product/create', [ProductController::class, 'create']);
Route::post('/admin/product/store', [ProductController::class, 'store']);
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit']);
Route::put('/admin/product/{id}', [ProductController::class, 'update']);
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy']);
// test
Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);


// ================= POST =================
Route::get('/admin/post', [PostController::class, 'index']);
Route::get('/admin/post/create', [PostController::class, 'create']);
Route::post('/admin/post/store', [PostController::class, 'store']);
Route::get('/admin/post/edit/{id}', [PostController::class, 'edit']);
Route::put('/admin/post/{id}', [PostController::class, 'update']);
Route::delete('/admin/post/{id}', [PostController::class, 'destroy']);


// ================= BRAND =================
Route::get('/admin/brand', [BrandController::class, 'index']);
Route::get('/admin/brand/create', [BrandController::class, 'create']);
Route::post('/admin/brand/store', [BrandController::class, 'store']);
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit']);
Route::put('/admin/brand/{id}', [BrandController::class, 'update']);
Route::delete('/admin/brand/{id}', [BrandController::class, 'destroy']);


// ================= USER =================
Route::get('/admin/user', [UserController::class, 'index']);
Route::get('/admin/user/create', [UserController::class, 'create']);
Route::post('/admin/user/store', [UserController::class, 'store']);
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
Route::put('/admin/user/{id}', [UserController::class, 'update']);
Route::delete('/admin/user/{id}', [UserController::class, 'destroy']);

// ================= DASHBOARD =================
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');