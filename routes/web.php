<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// ─── Public Routes ────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])
    ->name('cart.update');

Route::post('/cart/remove', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::post('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout/place-order', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/order-success/{id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/track-order', [CheckoutController::class, 'track'])
    ->name('orders.track');

Route::post('/track-order', [CheckoutController::class, 'showTrack'])
    ->name('orders.showTrack');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])
        ->name('orders.show');
});

// ─── Admin Routes ──────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Products
    Route::get('/products', [AdminProductController::class, 'index'])
        ->name('admin.products.index');
    Route::get('/products/data', [AdminProductController::class, 'getData'])
        ->name('admin.products.data');
    Route::get('/products/create', [AdminProductController::class, 'create'])
        ->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])
        ->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])
        ->name('admin.products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])
        ->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])
        ->name('admin.products.destroy');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders.index');
    Route::get('/orders/data', [OrderController::class, 'getData'])
        ->name('admin.orders.data');
    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('admin.orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.status');

    // Order Items
    Route::get('/order-items', [OrderItemController::class, 'index'])
        ->name('admin.order-items.index');
    Route::get('/order-items/data', [OrderItemController::class, 'getData'])
        ->name('admin.order-items.data');

    // Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');
    Route::get('/users/data', [UserController::class, 'getData'])
        ->name('admin.users.data');
    Route::get('/users/{id}', [UserController::class, 'show'])
        ->name('admin.users.show');

    // Admins
    Route::get('/admins', [AdminController::class, 'index'])
        ->name('admin.admins.index');
    Route::get('/admins/data', [AdminController::class, 'getData'])
        ->name('admin.admins.data');
    Route::post('/admins', [AdminController::class, 'store'])
        ->name('admin.admins.store');

    // Contacts
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('admin.contacts.index');
    Route::get('/contacts/data', [AdminContactController::class, 'getData'])
        ->name('admin.contacts.data');
    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])
        ->name('admin.contacts.show');
    Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])
        ->name('admin.contacts.reply');
    Route::post('/contacts/{id}/read', [AdminContactController::class, 'markRead'])
        ->name('admin.contacts.read');
});

require __DIR__.'/auth.php';

