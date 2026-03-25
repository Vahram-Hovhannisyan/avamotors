<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; // Добавить импорт
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AnalogController;
use App\Http\Controllers\Admin\CarController;

// ── Public ────────────────────────────────────────────
Route::get('/about', fn() => view('about.about'))->name('about');

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['ru', 'hy'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
Route::get('/catalog',           [ProductController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{slug}',    [ProductController::class, 'catalog'])->name('catalog.category');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search',            [ProductController::class, 'catalog'])->name('search');
Route::get('/api/car-models',    [ProductController::class, 'carModelsByMake'])->name('api.car-models');

// ── Cart ──────────────────────────────────────────────

Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/',                 'index')->name('index');
    Route::post('/add',             'add')->name('add');
    Route::post('/update',          'update')->name('update'); // POST вместо PATCH для простоты
    Route::post('/remove',          'remove')->name('remove');
    Route::post('/clear',            'clear')->name('clear');
    Route::get('/count',            'count')->name('count'); // для AJAX
});



// ── Guest only ────────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('/login',                  [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login',                 [AuthController::class, 'login']);
    Route::get('/register',               [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register',              [AuthController::class, 'register']);
    Route::get('/forgot-password',        [AuthController::class, 'forgotForm'])->name('password.request');
    Route::post('/forgot-password',       [AuthController::class, 'forgotSend'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password',        [AuthController::class, 'resetPassword'])->name('password.update');
});

// ── Auth only ─────────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');
    Route::get('/account',          [AuthController::class, 'profile'])->name('account');
    Route::put('/account/profile',  [AuthController::class, 'updateProfile'])->name('account.profile');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('account.password');

    Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
        Route::get('/checkout',       'checkout')->name('checkout');
        Route::post('/store',         'store')->name('store');
        Route::get('/success',        'success')->name('success');
        Route::get('/',               'index')->name('index');
        Route::get('/{order}',        'show')->name('show');
    });

    Route::get('/email/verify', function () {
        return view('auth.emails.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home')->with('status', 'E-mail успешно подтверждён!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');
});

// ── Admin ─────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::get('/products',                    [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create',             [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products',                   [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit',     [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}',          [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}',       [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::patch('/products/{product}/toggle', [AdminProductController::class, 'toggle'])->name('products.toggle');
    Route::post('/products/{product}/clone',   [AdminProductController::class, 'clone'])->name('products.clone');

    // Categories
    Route::get('/categories',                 [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories',                [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}',      [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}',   [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Cars
    Route::get('/cars',                      [CarController::class, 'index'])->name('cars');
    Route::post('/cars/makes',               [CarController::class, 'storeMake'])->name('cars.makes.store');
    Route::delete('/cars/makes/{carMake}',   [CarController::class, 'destroyMake'])->name('cars.makes.destroy');
    Route::post('/cars/models',              [CarController::class, 'storeModel'])->name('cars.models.store');
    Route::delete('/cars/models/{carModel}', [CarController::class, 'destroyModel'])->name('cars.models.destroy');

    // Users
    Route::get('/users',                      [UserController::class, 'index'])->name('users');
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggle-role');
    Route::delete('/users/{user}',            [UserController::class, 'destroy'])->name('users.destroy');

    // Orders
    Route::get('/orders',                  [AdminOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}',          [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    // Analogs (справочник)
    Route::get('/analogs',               [AnalogController::class, 'index'])->name('analogs');
    Route::get('/analogs/create',        [AnalogController::class, 'create'])->name('analogs.create');
    Route::post('/analogs',              [AnalogController::class, 'store'])->name('analogs.store');
    Route::get('/analogs/{analog}/edit', [AnalogController::class, 'edit'])->name('analogs.edit');
    Route::put('/analogs/{analog}',      [AnalogController::class, 'update'])->name('analogs.update');
    Route::delete('/analogs/{analog}',   [AnalogController::class, 'destroy'])->name('analogs.destroy');

    // Analogs attach/detach to product
    Route::post('/products/{product}/analogs/{analog}',   [AnalogController::class, 'attach'])->name('products.analogs.attach');
    Route::delete('/products/{product}/analogs/{analog}', [AnalogController::class, 'detach'])->name('products.analogs.detach');

    Route::resource('pricing-tiers', \App\Http\Controllers\Admin\PricingTierController::class);
    Route::post('pricing-tiers/{pricingTier}/bulk-assign', [\App\Http\Controllers\Admin\PricingTierController::class, 'bulkAssign'])->name('pricing-tiers.bulk-assign');
    Route::delete('pricing-tiers/{pricingTier}/remove-users', [\App\Http\Controllers\Admin\PricingTierController::class, 'removeUsers'])->name('pricing-tiers.remove-users');
    Route::patch('pricing-tiers/{pricingTier}/toggle-status', [\App\Http\Controllers\Admin\PricingTierController::class, 'toggleStatus'])->name('pricing-tiers.toggle-status');


    Route::get('/orders/{order}/invoice/download', [InvoiceController::class, 'download'])
        ->name('orders.invoice.download');

    Route::get('/orders/{order}/invoice/preview', [InvoiceController::class, 'preview'])
        ->name('orders.invoice.preview');
});
