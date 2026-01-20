<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Redirect root to login.
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | Redirect dashboard to products index.
    |
    */

    Route::get('/dashboard', function () {
        return redirect()->route('admin.products.index');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Users
            Route::resource('users', UserController::class);

            // Roles
            Route::resource('roles', RoleController::class);

            // Permissions
            Route::resource('permissions', PermissionController::class);

            // Categories
            Route::resource('categories', CategoryController::class);

            // Products
            Route::resource('products', ProductController::class);

            // Trashed products
            Route::get('products-trashed', [ProductController::class, 'trashed'])
                ->name('products.trashed');

            // Restore product
            Route::post('products/{id}/restore', [ProductController::class, 'restore'])
                ->name('products.restore');

            // Force delete product
            Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])
                ->name('products.forceDelete');
        });
});
