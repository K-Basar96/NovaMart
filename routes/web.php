<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;

Route::get('/order/track', [OrderController::class, 'track'])->name('order.track');
Route::post('order/track', [OrderController::class,'tracking'])->name('order.tracking');

Route::middleware('guest')->group(function () {
    Route::resource('user', UserController::class)->only(['create', 'store']);

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_check']);

    Route::post('/forgot_password', [UserController::class, 'forgot_password'])->name('forgot_password');
    Route::get('/reset-password', function () { return view('user.reset_password'); })->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');
});

Route::middleware(['admin'])->group(function () {
    Route::resource('wishlist', WishlistController::class)->only(['show']);
    Route::get('/settings', [AdminController::class,'open_settings'])->name('admin.settings');
    Route::get('/products', [AdminController::class,'show_products'])->name('admin.products');
    Route::get('/orders', [AdminController::class,'show_orders'])->name('admin.orders');
    Route::get('users/{id}/orders', [OrderController::class,'show_orders'])->name('users.order');
    Route::get('/services', [AdminController::class,'services'])->name('admin.services');
    Route::get('/users', [AdminController::class,'show_users'])->name('admin.users');
    Route::get('/users/{id}/switch', [AdminController::class,'switch_users'])->name('admin.switch');
    Route::get('/pages', [AdminController::class,'show_pages'])->name('admin.pages');
    Route::resource('admin', AdminController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class)->except(['create', 'store']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/brands/admin', [BrandController::class, 'show_brands'])->name('admin.brands');
    Route::resource('brand', BrandController::class);

    Route::get('/categories/admin', [CategoryController::class, 'show_categories'])->name('admin.categories');
    Route::resource('category', CategoryController::class);

    Route::get('/sliders/admin', [SliderController::class, 'show_sliders'])->name('admin.sliders');
    Route::resource('sliders', SliderController::class);

    Route::resource('address', AddressController::class);
    Route::resource('product', ProductController::class)->except(['index', 'show']);

    Route::resource('wishlist', WishlistController::class)->except(['show']);
    Route::post('/wishlist/toggle', [WishlistController::class,'toggleWishlist'])->name('wishlist.toggle');
    Route::resource('cart', CartController::class);

    Route::get('order/checkout', [OrderController::class,'checkout'])->name('order.checkout');
    Route::post('order/confirmation', [OrderController::class,'confirmation'])->name('order.confirmation');
    Route::post('order/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::resource('order', OrderController::class);
});



Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/faqs', [UserController::class, 'faqs'])->name('faqs');
Route::get('/returnpolicy', [UserController::class, 'returnpolicy'])->name('returnpolicy');

Route::post('/product/search', [ProductController::class, 'search'])->name('product.search');
Route::post('/product/filter', [ProductController::class, 'filter'])->name('product.filter');
Route::get('/product/filter/brand/{id}', [ProductController::class, 'filterbyBrand'])->name('product.filter.brand');
Route::get('/product/filter/category/{id}', [ProductController::class, 'filterbyCategory'])->name('product.filter.category');
Route::get('/product/sortby/{sort}', [ProductController::class, 'sortby'])->name('product.sortby');
Route::resource('product', ProductController::class)->only(['index', 'show']);
