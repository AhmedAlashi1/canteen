<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ProductStoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('settings', SettingController::class);
Route::get('city', CityController::class);
Route::get('region/{city_id?}', RegionController::class);
Route::post('category', CategoryController::class);
Route::get('payment-method', PaymentMethodController::class);
//payment-method








Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login')->name('login');

});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('activateAccount', [AuthController::class, 'activateAccount']);
    Route::post('resendActivation', [AuthController::class, 'resendActivation']);
    //contact
    Route::post('contact-us' ,ContactUsController::class);
    //profile
    Route::get('show-profile/{user_id?}', [UserController::class, 'show']);
    Route::post('update-profile', [UserController::class, 'update']);

    //home
    Route::get('home', [HomeController::class, 'home']);

    //address resource api
    Route::apiResource('address', AddressController::class);

    //school SchoolController
    Route::get('school', [SchoolController::class, 'index']);
    Route::get('school/{id}', [SchoolController::class, 'show']);

    //prodect canteen
    Route::post('product', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'show']);

    //product store
    Route::post('product-store', [ProductStoreController::class, 'index']);


    //child
    Route::apiResource('child', ChildController::class);


});
