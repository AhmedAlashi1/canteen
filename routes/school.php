<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\School\AuthController as SchoolAuthController;
use App\Http\Controllers\School\DashboardController ;
use App\Http\Controllers\School\UsersController ;
use App\Http\Controllers\School\ChildrenController ;
use App\Http\Controllers\School\ProductsController ;
use App\Http\Controllers\School\SchoolProductsController ;


Route::prefix('school')->name('school.')->group(function () {
    Route::get('login', [SchoolAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SchoolAuthController::class, 'login']);
    Route::post('logout', [SchoolAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:school')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //users
        Route::get('users', [UsersController::class, 'index'])->name('users.index');

        //children
        Route::get('children', [ChildrenController::class, 'index'])->name('children.index');
        Route::get('children/{id}/edit', [ChildrenController::class, 'edit'])->name('children.edit');
        Route::put('children/{id}', [ChildrenController::class, 'update'])->name('children.update');
        Route::delete('children/{id}', [ChildrenController::class, 'destroy'])->name('children.destroy');

        Route::resource('products', ProductsController::class);

        //SchoolProduct
        Route::resource('school-products', SchoolProductsController::class);
        //products select
        Route::get('product/select', [ProductsController::class, 'select'])->name('products.select');


//        Route::get('school/select', [SchoolController::class, 'select'])->name('schools.select');
//        Route::get('supplier/select', [SupplierController::class, 'select'])->name('suppliers.select');
    });
});
