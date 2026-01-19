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
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
  // Dashboard
       Route::get('/dashboard', function () {
    return redirect()->route('admin.products.index');
})->middleware(['auth'])->name('dashboard');
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

      

        // Users (protected by permissions inside controller)
        Route::resource('users', UserController::class);

        // Roles
        Route::resource('roles', RoleController::class);

        // Permissions
        Route::resource('permissions', PermissionController::class);

        // Products
        Route::resource('products', ProductController::class);
        //categories
        Route::resource('categories', CategoryController::class);
        Route::get('products-trashed', [ProductController::class, 'trashed'])
        ->name('products.trashed');

        Route::post('products/{id}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');
        Route::resource('categories', CategoryController::class);
            Route::delete( 'products/{product}/force-delete', [ProductController::class, 'forceDelete']
)->name('products.forceDelete');
       
    });
