<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ManageUserController as AdminManageUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest only)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| User Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CatalogController::class, 'index'])->name('user.dashboard');

    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');

    // Breeze default profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Authenticated + is_admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/export-pdf', [AdminOrderController::class, 'exportPdf'])->name('orders.exportPdf');

        Route::resource('/books', AdminBookController::class);

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-pdf', [AdminReportController::class, 'exportPdf'])->name('reports.exportPdf');

        Route::get('/users', [AdminManageUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/credentials', [AdminManageUserController::class, 'updateCredentials'])->name('users.updateCredentials');
        Route::delete('/users/{user}', [AdminManageUserController::class, 'destroy'])->name('users.destroy');
    });

require __DIR__.'/auth.php';
