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

// ================= CATEGORIES =================
// Route::prefix('admin')->group(function () {
//     Route::resource('categories', CategoryController::class);
// });
Route::get('/admin/categories', [CategoryController::class, 'index']) ->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create']) ->name('admin.categories.create');
Route::post('/admin/categories/store', [CategoryController::class, 'store']) ->name('admin.categories.store');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit']) ->name('admin.categories.edit');
Route::post('/admin/categories/{id}', [CategoryController::class, 'update']) ->name('admin.categories.update');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']) ->name('admin.categories.destroy');


// ================= PRODUCT =================
Route::get('/admin/products', [ProductController::class, 'index']) ->name('admin.products.index');
Route::get('/admin/products/create', [ProductController::class, 'create']) ->name('admin.products.create');
Route::post('/admin/products/store', [ProductController::class, 'store']) ->name('admin.products.store');
Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit']) ->name('admin.products.edit');
Route::post('/admin/products/{id}', [ProductController::class, 'update']) ->name('admin.products.update');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']) ->name('admin.products.destroy');
// test
Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);


// ================= POST =================
Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');
Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts/store', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('/admin/posts/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
Route::post('/admin/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');


// ================= BRAND =================
Route::get('/admin/brand', [BrandController::class, 'index']) ->name('admin.brands.index');
Route::get('/admin/brand/create', [BrandController::class, 'create']) ->name('admin.brands.create');
Route::post('/admin/brand/store', [BrandController::class, 'store'])->name('admin.brands.store');
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit']) ->name('admin.brands.edit');
Route::post('/admin/brand/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
Route::delete('/admin/brand/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');


// ================= USER =================
Route::get('/admin/user', [UserController::class, 'index']) ->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create']) ->name('admin.users.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']) ->name('admin.users.edit');
Route::post('/admin/user/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// ================= DASHBOARD =================
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.home');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.home');
});