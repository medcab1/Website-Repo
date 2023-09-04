<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\autheMiddleware;
use App\Http\Controllers\teamController;
use App\Http\Controllers\RegistraionController;
use App\Http\Controllers\SendNotificationController;
use App\Http\Controllers\DriverNotificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Booking2Controller;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\BookingPaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\View\Components\footer;
use App\Http\Controllers\app_data\consumer_app\ConsumerLanguageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/consumer/payment/booking_payment',[PaymentMethodController::class,'CCavenuPayment']); 
Route::post('/consumer/payment/booking_pending_payment',[PaymentMethodController::class,'CCavenuPendingPayment']); 
Route::post('consumer/driver_send_notification',[DriverNotificationController::class,'booking_send_notification'])->name('Booking_notification');
Route::get('app_data/consumer_app/registration/language_list',[ConsumerLanguageController::class,'language_list']);   
Route::any('bulk_notification',[BookingPaymentController::class,'saveBulkBookingDetails']); 
Route::any('/medcab/booking/login',[RegistraionController::class,'booking_login']);   
Route::any('/medcab/booking/registration',[RegistraionController::class,'booking_register']);    
Route::post('/blog/upload_blog_image',[BlogController::class,'file_uploading']); 
Route::post('/blogs/save_blog',[BlogController::class,'saveBlog'])->name('Blogs.SaveBlog'); 
Route::post('/blogs/updated_blog/{id?}',[BlogController::class,'updateBlog'])->name('Blogs.UpdateBlog');  


