<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{parram1}/{parram2}', [DemoController::class, 'index6']);

// ================= CATEGORIES =================
// Route::prefix('admin')->group(function () {
//     Route::resource('categories', CategoryController::class);
// });
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::post('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


// ================= PRODUCT =================
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}/images/{image}', [ProductController::class, 'deleteImage'])->name('admin.products.images.destroy');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
// test
// Route::get('/test1', [ProductController::class, 'test1']);
// Route::get('/test2', [ProductController::class, 'test2']);


// ================= POST =================
Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');
Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts/store', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('/admin/posts/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
Route::post('/admin/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');


// ================= BRAND =================
Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin.brands.index');
Route::get('/admin/brand/create', [BrandController::class, 'create'])->name('admin.brands.create');
Route::post('/admin/brand/store', [BrandController::class, 'store'])->name('admin.brands.store');
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
Route::post('/admin/brand/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
Route::delete('/admin/brand/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');


// ================= USER =================
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('/admin/user/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// ================= DASHBOARD =================
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.home');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// ================= AUTHENTICATION =================
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])
        ->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])
        ->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postforgotPassword'])
        ->name('forgotpass.post');

    // middleware auth
    Route::middleware(['auth', 'roles:1'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/change-password', [AuthController::class, 'showChangePassword'])
            ->name('change.password');

        Route::post('/change-password', [AuthController::class, 'changePassword'])
            ->name('change.password.post');

        Route::get('register', [AuthController::class, 'showAdminRegister'])
            ->name('register');
        Route::post('register', [AuthController::class, 'adminRegister'])
            ->name('register.store');

        Route::get('trash/categories', [CategoryController::class, 'trash'])
            ->name('categories.trash');
        Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
            ->name('categories.restore');
        Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete'])
            ->name('categories.forceDelete');
        Route::resource('categories', CategoryController::class);

        Route::get('trash/brands', [BrandController::class, 'trash'])
            ->name('brands.trash');
        Route::patch('brands/{id}/restore', [BrandController::class, 'restore'])
            ->name('brands.restore');
        Route::delete('brands/{id}/forcedelete', [BrandController::class, 'forceDelete'])
            ->name('brands.forceDelete');
        Route::resource('brands', BrandController::class);

        Route::get('trash/users', [UserController::class, 'trash'])
            ->name('users.trash');
        Route::patch('users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');
        Route::delete('users/{id}/forcedelete', [UserController::class, 'forceDelete'])
            ->name('users.forceDelete');
        Route::resource('users', UserController::class);

        Route::get('trash/products', [ProductController::class, 'trash'])
            ->name('products.trash');
        Route::patch('products/{id}/restore', [ProductController::class, 'restore'])
            ->name('products.restore');
        Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])
            ->name('products.forceDelete');
        Route::resource('products', ProductController::class);

        Route::get('trash/posts', [PostController::class, 'trash'])
            ->name('posts.trash');
        Route::patch('posts/{id}/restore', [PostController::class, 'restore'])
            ->name('posts.restore');
        Route::delete('posts/{id}/forcedelete', [PostController::class, 'forceDelete'])
            ->name('posts.forceDelete');
        Route::resource('posts', PostController::class);
        Route::resource('orders', OrderController::class);
    });
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/test500', function () {
    abort(500);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{slug}', [ClientProductController::class, 'show'])->name('products.show');
Route::get('/product', [ClientProductController::class, 'index'])->name('products.index');
Route::get('/brand/{slug}', [ClientProductController::class, 'brand'])->name('products.brand');
Route::get('/category/{slug}', [ClientProductController::class, 'category'])->name('products.category');
Route::get('/search', [ClientProductController::class, 'search'])->name('search');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::prefix('cart')->controller(CartController::class)->name('cart.')->group(function () {
    Route::get('/show', 'show')->name('show');
    Route::post('/add/{id}', 'addToCart')->name('add');
    Route::delete('/remove/{id}', 'removeCart')->name('remove');

    Route::post('/checkout', 'checkout')->middleware('auth')->name('checkout');
});

// Client auth - register (handled by Admin\AuthController)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
