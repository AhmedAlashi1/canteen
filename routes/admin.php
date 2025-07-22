<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildrenController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\notificationsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


Route::prefix(LaravelLocalization::setLocale() . '/admin')->middleware(['web'])
    ->name('admin.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::middleware('auth:admin')->group(function () {
            // Dashboard
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            // Logout
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

            Route::resource('admins', AdminController::class);
            //users
            Route::get('users', [UsersController::class, 'index'])->name('users.index');
            Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
            Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

            //address
            Route::get('address/{id}', [AddressController::class, 'index'])->name('address.index');
//            Route::get('address/{id}/create', [AddressController::class, 'create'])->name('address.create');
//            Route::post('address/{id}', [AddressController::class, 'store'])->name('address.store');
//            Route::get('address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');
//            Route::put('address/{id}', [AddressController::class, 'update'])->name('address.update');
            Route::delete('address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');



            //children
            Route::get('children', [ChildrenController::class, 'index'])->name('children.index');
            Route::get('children/{id}/edit', [ChildrenController::class, 'edit'])->name('children.edit');
            Route::put('children/{id}', [ChildrenController::class, 'update'])->name('children.update');
            Route::delete('children/{id}', [ChildrenController::class, 'destroy'])->name('children.destroy');

            //orders
            Route::get('orders', [OrdersController::class, 'index'])->name('orders.index');
            Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
            Route::delete('orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
            //changeStatus
            Route::post('orders/{order}/change-status', [OrdersController::class, 'changeStatus'])->name('orders.changeStatus');




            //schools
            Route::resource('schools', SchoolController::class);
            Route::get('/get-regions', [SchoolController::class, 'getByCity'])->name('get.regions');

            //cities
            Route::resource('cities', CityController::class);

            //regions
            Route::get('regions/{id}', [RegionController::class, 'index'])->name('regions.index');
            Route::get('regions/{id}/create', [RegionController::class, 'create'])->name('regions.create');
            Route::post('regions/{id}', [RegionController::class, 'store'])->name('regions.store');
            Route::get('regions/{id}/edit', [RegionController::class, 'edit'])->name('regions.edit');
            Route::put('regions/{id}', [RegionController::class, 'update'])->name('regions.update');
            Route::delete('regions/{id}', [RegionController::class, 'destroy'])->name('regions.destroy');

            //ContactUs
            Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
            Route::delete('contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');

            //ads
            Route::resource('ads', AdsController::class);

            // Settings
            Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::post('settings/update', [SettingsController::class, 'update'])->name('settings.update');

            //PaymentMethod
            Route::resource('payment-methods', PaymentMethodController::class);

            //Suppliers
            Route::resource('suppliers', SupplierController::class);

            //coupons
            Route::resource('coupons', CouponsController::class);
            //categories
            Route::resource('categories', CategoryController::class);

             // Products resource
            Route::resource('products', ProductsController::class);
            Route::get('school/select', [SchoolController::class, 'select'])->name('schools.select');
            Route::get('supplier/select', [SupplierController::class, 'select'])->name('suppliers.select');

            //notifications
            Route::get('notifications', [notificationsController::class, 'index'])->name('notifications.index');
            Route::get('notifications/create', [notificationsController::class, 'create'])->name('notifications.create');
            Route::post('notifications', [notificationsController::class, 'store'])->name('notifications.store');


        });
    });

