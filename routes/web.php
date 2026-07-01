<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Shopper\DashboardController as ShopperDashboardController;
use App\Http\Controllers\Shopper\OrderController as ShopperOrderController;
use App\Http\Controllers\Shopper\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'shopper') {
        return redirect()->route('shopper.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'shopper') {
        return redirect()->route('shopper.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/dashboard', [CustomerOrderController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/orders', [CustomerOrderController::class, 'index'])
            ->name('orders.index');

        // If customer can create custom order manually
        Route::get('/orders/create', [CustomerOrderController::class, 'create'])
            ->name('orders.create');

        Route::post('/orders', [CustomerOrderController::class, 'store'])
            ->name('orders.store');

        Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])
            ->name('orders.show');

        // Customer order from available stock
        Route::get('/stocks', [CustomerOrderController::class, 'stocks'])
            ->name('stocks.index');

        Route::post('/stocks/{stock}/order', [CustomerOrderController::class, 'orderFromStock'])
            ->name('stocks.order');
    });

Route::middleware(['auth', 'role:shopper'])
    ->prefix('shopper')
    ->name('shopper.')
    ->group(function () {

        Route::get('/dashboard', [ShopperDashboardController::class, 'index'])
            ->name('dashboard');

        // Customer orders for shopper to view/manage
        Route::get('/orders', [ShopperOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [ShopperOrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{order}/update-status', [ShopperOrderController::class, 'updateStatus'])
            ->name('orders.update-status');

        // Stock management by shopper
        Route::resource('stocks', StockController::class);

        Route::post('stocks/import', [StockController::class, 'import'])
            ->name('stocks.import');

        Route::get('stocks/template/download', [StockController::class, 'downloadTemplate'])
            ->name('stocks.template.download');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
