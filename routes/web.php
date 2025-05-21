<?php


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Laravel\Telescope\Telescope;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/firebase-test', function () {
    $fakeToken = 'cT-0_kooShSPwAi-g_0vdy:APA91bEM8bzKX4UoTqiLYRvLKTOnZwHYzqHl0BKgUfsWnofnGYta0cKUHexemjn3RdfM3vGjaO7P2zPXzIRLVxWtcNwt_nZrynB39FwDgOTZuVELJ4ekhYA';
    $title = 'Purchased Succesfully';
    $body = 'Your Order no. #' . str_pad(20, 6, '0', STR_PAD_LEFT) . ' Purchased Successfully';
    $data = [
        'type' => 'order',
        'order_id' => 20,
    ];
    $firebase = new \App\Services\FirebaseService();
    $response = $firebase->sendNotificationToToken(
        $fakeToken,
        $title,
        $body,
        $data
    );
    return $response;

    return $response ? '✅ Notification sent' : '❌ Failed to send notification (check logs)';
});
Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize']], // يمكن أن يكون middleware مختلف حسب إعداداتك
    function () {
        Route::get('/', function () {
            if (!Auth::guard('school')->check() && !Auth::guard('admin')->check()) {
                return redirect()->route('school.login');
            } elseif (Auth::guard('school')->check()) {
                return redirect()->route('school.dashboard');
            } elseif (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login');
            }
        });
    }
);


