<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Dashboard\AuthController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            Route::resource('schools', SchoolController::class);
            Route::get('/get-regions', [SchoolController::class, 'getByCity'])->name('get.regions');

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






        });
    });

