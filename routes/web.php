<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductByCategoryController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\StoreDetailController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/history' , [HistoryController::class , 'showPurchaseHistory'])->name('purchase.history');
    Route::get('/createProduct' , [ProductController::class , 'redirectCreateProduct'])->name('create.product');
    Route::post('/createProductProcess' , [ProductController::class , 'createProduct'])->name('new.product');
    Route::get('/manageProduct/{i}' , [ProductController::class , 'manageProductRedirect'])->name('manage.product');
    Route::post('/changeProduct' , [ProductController::class , 'changeProduct'])->name('change.product');
    Route::get('/deleteProduct/{product_id}' , [ProductController::class , 'deleteProduct'])->name('delete.product');
    Route::get('/products' , [ProductController::class , 'showProducts'])->name('product.list');
    Route::post('/becomeseller' , [SellerController::class , 'becomeSeller'])->name('become.seller');
    Route::post('/sellerregister' , [SellerController::class , 'createNewSeller'])->name('register.seller');
    Route::get('/topup', [ProfileController::class, 'showTopup'])->name('topup');
    Route::post('/processtopup', [ProfileController::class, 'processTopup'])->name('topup.process');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'showEditProfileForm'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/delete', [ProfileController::class, 'deleteProfile'])->name('profile.delete');
    Route::get('/category/{category}' , [ProductByCategoryController::class , 'showProductByCategory'])->name('product.category');
    Route::get('/product/{product}' , [ProductDetailController::class , 'showProductDetail'])->name('product.detail');
    Route::get('/store/{seller}' , [StoreDetailController::class , 'showStoreDetail'])->name('store.detail');
    Route::get('/purchase/{product}' , [PurchaseController::class , 'purchase'])->name('purchase');
    Route::post('/addtocart' , [PurchaseController::class , 'addToCart'])->name('add.to.cart');
    Route::get('/cart' , [PurchaseController::class , 'showCart'])->name('cart');
    Route::get('/removecart/{id}' , [PurchaseController::class , 'removeFromCart'])->name('cart.remove');
    Route::post('/buy' , [PurchaseController::class ,'buy'])->name('buy');
    Route::get('/changeamount/{id}' , [PurchaseController::class ,'showChangeAmount'])->name('change.amount');
    Route::post('/changeprocessamount' , [PurchaseController::class ,'processChangeAmount'])->name('change.amount.process');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
    Route::get('/search', [ProductController::class, 'searchProduct'])->name('products.search');
});

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});