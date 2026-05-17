<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\SitemapController;
use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\WebCartController;
use App\Http\Controllers\Web\WebOrderController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// SEO: Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Shop
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{id}', [ShopController::class, 'show'])->name('show');
});

// Auth
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);
Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [WebAuthController::class, 'register']);
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [WebAuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [WebAuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [WebAuthController::class, 'changePassword'])->name('profile.password');

    // Cart
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [WebCartController::class, 'index'])->name('index');
        Route::post('/add', [WebCartController::class, 'add'])->name('add');
        Route::put('/{productId}', [WebCartController::class, 'update'])->name('update');
        Route::delete('/{productId}', [WebCartController::class, 'remove'])->name('remove');
        Route::delete('/', [WebCartController::class, 'clear'])->name('clear');
    });

    // Orders
    Route::get('/checkout', [WebOrderController::class, 'checkout'])->name('checkout');
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [WebOrderController::class, 'index'])->name('index');
        Route::post('/', [WebOrderController::class, 'store'])->name('store');
        Route::get('/{id}', [WebOrderController::class, 'show'])->name('show');
        Route::post('/{id}/cancel', [WebOrderController::class, 'cancel'])->name('cancel');
    });
});

// SSLCommerz Callback Routes (must be web routes, not API)
Route::prefix('payment')->group(function () {
    Route::post('/success', [App\Http\Controllers\Api\PaymentController::class, 'success'])->name('payment.success');
    Route::post('/fail', [App\Http\Controllers\Api\PaymentController::class, 'fail'])->name('payment.fail');
    Route::post('/cancel', [App\Http\Controllers\Api\PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::post('/ipn', [App\Http\Controllers\Api\PaymentController::class, 'ipn'])->name('payment.ipn');
});
