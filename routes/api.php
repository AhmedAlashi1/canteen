<?php

use App\Http\Controllers\Api\PaymentWebhookController;
use App\Http\Controllers\Api\BasketController;
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
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


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
Route::post('/webhook/whatsapp', function (\Illuminate\Http\Request $request) {

    Log::info('Webhook Request:', $request->all());

    $messageText = $request->input('data.body');
    $from = $request->input('data.from');

    if (!$messageText || !$from) {
        Log::error('Missing message text or sender');
        return response()->json(['status' => 'missing data']);
    }

    // ChatGPT request
    $chatResponse = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o',
        'messages' => [
            ['role' => 'user', 'content' => $messageText],
        ],
        'temperature' => 0.7,
    ]);

    Log::info('ChatGPT response:', $chatResponse->json());

    $reply = $chatResponse['choices'][0]['message']['content'] ?? 'حدث خطأ في الرد.';

    // UltraMsg request
    $ultraResponse = Http::post("https://api.ultramsg.com/instance/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat", [
        'token' => env('ULTRAMSG_TOKEN'),
        'to' => $from,
        'body' => $reply,
    ]);

    Log::info('UltraMsg response:', $ultraResponse->json());

    return response()->json(['status' => 'done']);
});


Route::get('settings', SettingController::class);
Route::get('city', CityController::class);
Route::get('region/{city_id?}', RegionController::class);
Route::post('category', CategoryController::class);
Route::get('payment-method', PaymentMethodController::class);
Route::get('level', LevelController::class);


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login')->name('login');
    Route::post('activateAccount', [AuthController::class, 'activateAccount']);

});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('resendActivation', [AuthController::class, 'resendActivation']);
    //contact
    Route::post('contact-us' ,ContactUsController::class);
    //profile
    Route::get('show-profile/{user_id?}', [UserController::class, 'show']);
    Route::post('update-profile', [UserController::class, 'update']);
    //destroy
    Route::delete('destroy-users', [UserController::class, 'destroy']);

    //home
    Route::get('home', [HomeController::class, 'home']);

    //address resource api
    Route::apiResource('address', AddressController::class);

    //school SchoolController
    Route::get('school', [SchoolController::class, 'index']);
    Route::get('school/{id}', [SchoolController::class, 'show']);

    //product
    Route::post('product', [ProductController::class, 'index']);
    Route::post('product/{id}', [ProductController::class, 'show']);

    //favorite
    Route::get('favorite', [FavoriteController::class, 'index']);
    Route::post('favorite', [FavoriteController::class, 'store']);
    Route::delete('favorite/{id}', [FavoriteController::class, 'destroy']);


    //child
    Route::apiResource('child', ChildController::class);
//        "spatie/laravel-sitemap": "^6.2",

    // basket
    Route::post('cart', [BasketController::class, 'storeOrUpdate']);
    Route::get('cart', [BasketController::class, 'index']);
    Route::delete('cart/{id}', [BasketController::class, 'destroy']);
    Route::get('temp-basket/{child_id}/{type}', [BasketController::class, 'get']);

    //order
    Route::post('order/store-school', [OrderController::class, 'storeSchool']);
    Route::post('order/store', [OrderController::class, 'storeStore']);
    Route::get('orders/store', [OrderController::class, 'getStoreOrders']);
    Route::get('orders/school', [OrderController::class, 'getSchoolOrders']);
    Route::get('order/{id}', [OrderController::class, 'showDetails']);

    Route::post('apply-coupon', [CouponController::class, 'applyCoupon']);

    //notification switch
    Route::post('notification-switch', [UserController::class, 'notificationSwitch']);
    //notification
    Route::get('notification', [NotificationController::class, 'index']);





});
Route::get('callback/success', [OrderController::class, 'paymentSuccess'])->name('ordersSuccess');
Route::get('callback/error', [OrderController::class, 'paymentError'])->name('ordersError');
//Route::post('myfatoorah/webhook', [PaymentWebhookController::class, 'handle']);
