<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;


Route::get('/', [UserController::class, 'home'])->name('home');


Route::get('/allproducts', function () {
    return view('allProducts'); })->name('allproducts');
Route::get('/faqs', function () {
    return view('faqs'); })->name('faqs');
Route::get('/returnpolicy', function () {
    return view('returnpolicy'); })->name('returnpolicy');

Route::middleware('guest')->group(function () {
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_check']);
});

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class)->except(['create', 'store']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/brands/admin', [BrandController::class, 'show_brands'] )->name('admin.brands');
    Route::resource('brand', BrandController::class);

    Route::get('/categories/admin', [CategoryController::class, 'show_categories'] )->name('admin.categories');
    Route::resource('category', CategoryController::class);

    Route::get('/sliders/admin', [SliderController::class, 'show_sliders'] )->name('admin.sliders');
    Route::resource('sliders', SliderController::class);
    
    
    Route::resource('product', ProductController::class);
    Route::get('/product/search', [ProductController::class, 'show_sliders'] )->name('product.search');

    
    Route::resource('wishlist', WishlistController::class)->except(['index']);
    Route::post('/wishlist/toggle', [WishlistController::class,'toggleWishlist'])->name('wishlist.toggle');
    Route::resource('cart', CartController::class);
    // Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('order/checkout',[OrderController::class,'checkout'])->name('order.checkout');
    Route::post('order/confirmation',[OrderController::class,'confirmation'])->name('order.confirmation');
    Route::resource('order', OrderController::class);
    
});


Route::middleware(['admin'])->controller(AdminController::class)->group(function () {
    Route::get('wishlist', [WishlistController::class,'index'])->name('wishlist.index');
    Route::get('/settings', 'open_settings' )->name('admin.settings');
    Route::get('/products', 'show_products' )->name('admin.products');
    Route::get('/orders', 'show_orders' )->name('admin.orders');
    Route::get('/services', 'services' )->name('admin.services');
    Route::get('/users', 'show_users' )->name('admin.users');
    Route::get('/pages', 'show_pages' )->name('admin.pages');
});

Route::resource('admin', AdminController::class)->middleware('admin');



