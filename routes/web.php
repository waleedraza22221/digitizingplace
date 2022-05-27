<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceAddonController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuoteController as AdminQuoteController;
use App\Http\Controllers\ManageOrder;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ThankYouController;
use App\Http\Controllers\TopUpController;
use App\Http\Livewire\OrderList;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/getnotifications', [App\Http\Controllers\HomeController::class, 'getnotifications'])->name('getnotifications');
Route::get('/getnotifications', function () {
    $user = auth()->user()->unreadNotifications;
    //dd($user);
    return response()->json($user);
})->name('getnotifications');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::resource('topup', TopUpController::class)->middleware('auth');
Route::resource('order', OrderController::class)->middleware('auth');
Route::resource('payment', PaymentController::class)->middleware('auth');
Route::post('paybydp', [PaymentController::class, 'paybydp'])->middleware('auth')->name('paybydp');
Route::get('/processing', [PaymentController::class, 'processing'])->middleware('auth')->name('processing');
Route::resource('quote', QuoteController::class)->middleware('auth');
Route::get('awaitingpayments', [QuoteController::class, 'awaitingpayments'])->middleware('auth')->name('quote.awaitingpayments');
Route::get('getquote', [OrderController::class, 'quote'])->middleware('auth')->name('getquote');
Route::post('postquote', [OrderController::class, 'postquote'])->middleware('auth')->name('postquote');
Route::get('/thankyou', [ThankYouController::class, 'index'])->middleware('auth')->name('thankyou');
Route::get('login/{provider}', [SocialController::class, 'redirect']);
Route::get('login/{provider}/callback', [SocialController::class, 'Callback']);
Route::get('/createpassword', [SocialController::class, 'createpassword'])->name('createpassword');
Route::post('/setpassword', [SocialController::class, 'setpassword'])->name('setpassword');
Route::get('/fileupload', [App\Http\Controllers\HomeController::class, 'FileUpload'])->name('fileupload');
Route::get('/filedownload/{quoteid}/{filename}', [QuoteController::class, 'downloadfile'])->name('filedownload');
Route::get('/filesdownload/{quoteid}/{chatid}/{filename}', [QuoteController::class, 'downloadfiles'])->name('filesdownload');
Route::get('manageorder/{id}', [ManageOrder::class, 'index'])->middleware('auth')->name('manageorder');


Route::group(['prefix' => 'admin'], function () {
    Route::get('home', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('quote', [AdminQuoteController::class, 'index'])->name('admin.quote');
    Route::post('sendquote', [AdminQuoteController::class, 'sendquote'])->name('admin.sendquote');
    Route::get('quote/{id}', [AdminQuoteController::class, 'show'])->name('admin.show');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('servicesaddon', ServiceAddonController::class);
});
