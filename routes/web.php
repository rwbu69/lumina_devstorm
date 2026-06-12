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

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');
Route::get('/kontak', function () {
    return view('contact');
})->name('kontak');

/*
|--------------------------------------------------------------------------
| User Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');
    Route::get('/dashboard', [CatalogController::class, 'index'])->name('user.dashboard');

    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/search-preview', [CatalogController::class, 'searchPreview'])->name('catalog.searchPreview');
    Route::get('/catalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('throttle:checkout');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/payment', [OrderController::class, 'uploadPayment'])->name('orders.uploadPayment');
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');

    Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');
    Route::get('/collection/{book}/download', [CollectionController::class, 'download'])->name('collection.download');
    Route::get('/collection/{book}/read', [CollectionController::class, 'read'])->name('collection.read');

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
    ->middleware(['auth', 'role:admin,superadmin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}/verify', [AdminOrderController::class, 'verify'])->name('orders.verify');
        Route::patch('/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');
        Route::get('/orders/export-pdf', [AdminOrderController::class, 'exportPdf'])->name('orders.exportPdf');

        Route::resource('/books', AdminBookController::class);

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-pdf', [AdminReportController::class, 'exportPdf'])->name('reports.exportPdf');

        Route::get('/users', [AdminManageUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminManageUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminManageUserController::class, 'show'])->name('users.show');
        Route::patch('/users/{user}', [AdminManageUserController::class, 'update'])->name('users.update');
        Route::post('/users/{user}/access', [AdminManageUserController::class, 'addAccess'])->name('users.addAccess');
        Route::patch('/users/{user}/credentials', [AdminManageUserController::class, 'updateCredentials'])->name('users.updateCredentials');
        Route::delete('/users/{user}', [AdminManageUserController::class, 'destroy'])->name('users.destroy');

        // Superadmin Routes
        Route::middleware(['is_superadmin'])->group(function () {
            Route::get('/admins', [\App\Http\Controllers\Admin\ManageAdminController::class, 'index'])->name('admins.index');
            Route::post('/admins', [\App\Http\Controllers\Admin\ManageAdminController::class, 'store'])->name('admins.store');
            Route::delete('/admins/{admin}', [\App\Http\Controllers\Admin\ManageAdminController::class, 'destroy'])->name('admins.destroy');
            Route::get('/admins/logs', [\App\Http\Controllers\Admin\ManageAdminController::class, 'logs'])->name('admins.logs');
        });
    });

require __DIR__.'/auth.php';
