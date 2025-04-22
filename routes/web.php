<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\ClientSatisfcationsController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\ProcessController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\ServicesDetailsController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\TermController;
use App\Http\Controllers\Dashboard\WorkController;
use App\Http\Controllers\Dashboard\SolutionServicesController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin/',
        'middleware' => ['web','guest']
    ], function(){

    if (!Auth::guard('web')->check()) {
        // Login Routes
        Route::get('login',  [AuthController::class, 'showLoginForm'])->name('show.login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    }

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect','localeViewPath' ]
    ], function(){
    Route::get('/', [HomeController::class,'index'])->name('front.index');
    Route::post('/customer-store', [HomeController::class,'store'])->name('front.customer.store');
    Route::get('about', [AboutController::class,'index'])->name('front.about');
    Route::get('blogs', [BlogController::class,'index'])->name('front.blogs');
    Route::get('blog/{id}/{key?}', [BlogController::class,'show'])->name('front.blog');
    Route::get('contact', [ContactController::class,'index'])->name('front.contact');
//    Route::get('services/{id?}', [ServicesController::class,'index'])->name('front.services');
    Route::get('service/{id}/{name}', [ServicesController::class,'show'])->name('front.service.show');
    Route::get('/services/{id}/works', [ServicesController::class, 'getWorksByService'])->name('services.works');
    Route::get('terms', [TermsController::class,'index'])->name('front.terms');

});
//==============Dashboard================
Route::group(
    [
        'prefix' =>LaravelLocalization::setLocale().'/admin/',
//            'middleware' => ['web']
        'middleware' => [ 'web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

    ], function(){

    Route::group(['middleware' => ['auth:web']], function(){

        Route::post('/logout', [AuthController::class,'logout'])->name('Admin.logout');

        // Dashboard Routes
        Route::get('index', [DashboardController::class,'index'])->name('dashboard');
        Route::resource('admins',AdminController::class);
        Route::resource('services',ServiceController::class);

        Route::get('service-details/{id}',[ServicesDetailsController::class,'index'])->name('ServiceDetails.index');
        Route::get('service-details/create/{id}',[ServicesDetailsController::class,'create'])->name('ServiceDetails.create');
        Route::post('service-details/store',[ServicesDetailsController::class,'store'])->name('ServiceDetails.store');
        Route::get('service-details/edit/{id}',[ServicesDetailsController::class,'edit'])->name('ServiceDetails.edit');
        Route::put('service-details/update/{id}',[ServicesDetailsController::class,'update'])->name('ServiceDetails.update');
        Route::delete('service-details/destroy/{id}',[ServicesDetailsController::class,'destroy'])->name('ServiceDetails.destroy');


        Route::get('software-solution-services/{id}',[SolutionServicesController::class,'index'])->name('SolutionServices.index');
        Route::get('software-solution-services/create/{id}',[SolutionServicesController::class,'create'])->name('SolutionServices.create');
        Route::post('software-solution-services/store',[SolutionServicesController::class,'store'])->name('SolutionServices.store');
        Route::get('software-solution-services/edit/{id}',[SolutionServicesController::class,'edit'])->name('SolutionServices.edit');
        Route::put('software-solution-services/update/{id}',[SolutionServicesController::class,'update'])->name('SolutionServices.update');
        Route::delete('software-solution-services/destroy/{id}',[SolutionServicesController::class,'destroy'])->name('SolutionServices.destroy');


        Route::resource('client_satisfactions',ClientSatisfcationsController::class);
        Route::resource('company',CompanyController::class);
        Route::get('customer',[CustomerController::class,'index'])->name('customer.index');
        Route::delete('customer/{customer}',[CustomerController::class,'destroy'])->name('customer.destroy');
        Route::resource('work',WorkController::class);
        Route::get('/work/update-status/{id}', [WorkController::class, 'updateStatus'])->name('update-work-status');
        Route::get('/work/update-contact-us/{id}', [WorkController::class, 'updateContactUs'])->name('update-work-contactUs');
        Route::post('/work/new-images/{id}', [WorkController::class, 'AddNewImage'])->name('work.new-image');
        Route::delete('work/images/{image}',[WorkController::class,'deleteImage'])->name('work.image.delete');
        Route::resource('member',MemberController::class);
        Route::resource('question',QuestionController::class);
        Route::resource('term',TermController::class);
        Route::resource('process',ProcessController::class);
        Route::resource('blog',\App\Http\Controllers\Dashboard\BlogController::class);
        Route::post('/blog/upload-image', [\App\Http\Controllers\Dashboard\BlogController::class, 'uploadCkeditorImage'])->name('blog.ckeditor.upload');
        Route::get('/blog/update-default/{id}', [\App\Http\Controllers\Dashboard\BlogController::class, 'updateDefault'])->name('update-blog-default');

        // settings
        Route::get('settings/',[SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');

    });

});

// ====================== SEO ===================

//return test

Route::get('/sitemap.xml', function () {
//    return 'a';
    $sitemap = Sitemap::create();

    // احصل على جميع اللغات المدعومة
    $locales = LaravelLocalization::getSupportedLocales();

    // أضف الروابط الثابتة بجميع اللغات
    foreach ($locales as $locale => $details) {
        $sitemap->add(Url::create(LaravelLocalization::localizeURL(route('front.index', [], false), $locale)));
        $sitemap->add(Url::create(LaravelLocalization::localizeURL(route('front.about', [], false), $locale)));
        $sitemap->add(Url::create(LaravelLocalization::localizeURL(route('front.contact', [], false), $locale)));
        $sitemap->add(Url::create(LaravelLocalization::localizeURL(route('front.terms', [], false), $locale)));
    }

    // أضف الروابط الديناميكية للمدونات بجميع اللغات
    $blogs = \App\Models\Blog::all();
    foreach ($blogs as $blog) {
        foreach ($locales as $locale => $details) {
            $sitemap->add(
                Url::create(LaravelLocalization::localizeURL(route('front.blog', [$blog->id], false), $locale))
                    ->setLastModificationDate($blog->updated_at)
            );
        }
    }

    // أضف الروابط الديناميكية للخدمات بجميع اللغات
    $services = \App\Models\Service::all();
    foreach ($services as $service) {
        foreach ($locales as $locale => $details) {
            $sitemap->add(
                Url::create(LaravelLocalization::localizeURL(route('front.service.show', [$service->id, $service->name_en], false), $locale))
                    ->setLastModificationDate($service->updated_at)
            );
            $sitemap->add(
                Url::create(LaravelLocalization::localizeURL(route('services.works', ['id' => $service->id], false), $locale))
            );
        }
    }

    return $sitemap->writeToFile(public_path('sitemap.xml'));
});




