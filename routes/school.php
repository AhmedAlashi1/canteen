<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\School\AuthController as SchoolAuthController;
use App\Http\Controllers\School\DashboardController ;
use App\Http\Controllers\School\UsersController ;
use App\Http\Controllers\School\ChildrenController ;
use App\Http\Controllers\School\ProductsController ;
use App\Http\Controllers\School\OrdersController ;
use App\Http\Controllers\School\SchoolProductsController ;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale() . '/school')->middleware(['web'])
    ->name('school.')
    ->group(function () {
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

        //orders
        Route::get('orders', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::delete('orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');

//        Route::get('/student-search', [StudentController::class, 'search'])->name('student.search');
        //canteen
        Route::get('search', [ChildrenController::class, 'search'])->name('search');



//        Route::get('school/select', [SchoolController::class, 'select'])->name('schools.select');
//        Route::get('supplier/select', [SupplierController::class, 'select'])->name('suppliers.select');
    });
});
