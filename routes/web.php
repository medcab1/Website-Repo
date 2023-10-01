<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\autheMiddleware;
use App\Http\Controllers\HomeController;
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
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\FacilitiesController;
use App\View\Components\footer;



// Sitemap routes
Route::get('/sitemap.xml', [HomeController::class,'sitemap'])->name('SiteMap');

// Home page route
Route::get('/', [HomeController::class,'index'])->name('Home');

// About us  page route
Route::get('/about', function () {
    return view('about_us');
})->name('AboutUs');

Route::get('/search',function () {
    return view("home");
})->name("home_page");

// No access page route
route::get('/no-access',function(){
    return view('auth_error_pages/noAccess');

});


// Ambulances Page Route
Route::get('/Ambulances',function(){
    return view('ambulance');
})->name('Ambulances');

Route::get('/ourservices', function() {
    return view('our_services');
})->name('OurServices');

// Join_us Page Route
Route::get('/joinUs',function(){
    return view('joinUs');
})->name('JoinUs');

// term & condition route
Route::get('/terms-conditions',function(){
    return view('term&con');
})->name('Term&Condition');

// Privacy & Policy route
Route::get('/privacy-policy',function(){
    return view('privacy&policy');
})->name('Privacy&Policy');

//Customer Privacy & Policy route
Route::get('/customer-privacy-policy',function(){
    return view('customer_privacy&policy');
})->name('Customer.Privacy&Policy');

//Partner Privacy & Policy route
Route::get('/partner-privacy-policy',function(){
    return view('partner_privacy&policy');
})->name('Partner.Privacy&Policy');

//Driver Privacy & Policy route
Route::get('/driver-privacy-policy',function(){
    return view('driver_privacy&policy');
})->name('Driver.Privacy&Policy');

//Customer Cancelation & Refund route
Route::get('/customer/cancelation-and-refund-policy',function(){
    return view('customer_cancel&refund_policy');
})->name('Customer.Cancel&Refund');

//Driver Cancelation & Refund route
Route::get('/Driver/cancelation-and-refund-policy',function(){
    return view('driver_cancel&refund_policy');
})->name('Driver.Cancel&Refund');

//Service Level Agreement Route
Route::get('/service-level-agreement',function(){ 
    return  View('sla');
 })->name('Service_Level_Agreement');


    //................................ Routes Start For Websites.................................//

    //Blogs Route
    Route::get('/blog',[BlogController::class, 'blogs_View'])->name('Blogs');
    Route::get('/blog-detail/{title}',[BlogController::class, 'blog_detail'])->name('Blog-Detail');
    Route::any('/blog/blog-filter/{search_key}',[BlogController::class, 'blog_filter'])->name('Blog-Filter');

    // City Page Route
    Route::any('/city/{title}',[BlogController::class, 'city_content'])->name('CityContent');

    // Contact Us Route
    Route::get('/contact-us',[ContactController::class, 'contactUsView'])->name('ContactUs');
    Route::post('/contact_us/save',[ContactController::class, 'contactUs'])->name('ContactUs.Save');

    Route::controller(HospitalController::class)->group(function () {
        Route::get('hospital-services','CheckHospitalData')->name('check-hospital-service');
        Route::get('hospital-services/{category_name}','HospitalServicesCategory')->name('services-category');
        Route::post('hospital-services/{category_name}/{city}','HospitalServiceCity')->name('services-category-city');
        Route::get('search-city','CitySearch')->name('search-city');
      // Hospitals Page Route
         Route::get('/hospitals', 'hospital_services')->name('Hospitals');


    });
    // Includes page data show saurabh .....//
    Route::controller(FacilitiesController::class)->group(function () {
        Route::get('hospital-availability','GetHospitalAvailableData')->name('get-hospital-data');
        Route::post('ambulance-services','AmbulanceData')->name('get-ambulance');
        Route::get('ambulance-services-data','AmbulanceDataPages')->name('show-ambulance');

    });

    //  Check Hospital availability
    Route::any('/hospital/check-available-Service-in-hospital',[HomeController::class,'checkHospitalAvailabilityView'])->name('Check-Service-Availability-View');
    Route::any('/hospital-facility/filter-available-hospital-facility/{facility_search?}',[HomeController::class,'filterAvailableFacility'])->name('Filter-Available-Facility');
    Route::any('/hospital/check-hospital-availability/{city?}/{ser_id?}',[HomeController::class,'checkHospitalAvailability'])->name('Check-Hospital-Availability');
    Route::any('/hospital/get-city-list/',[HomeController::class,'searchHospitalCity'])->name('Get-City-List');

    route::get('/logout_page',[logoutController::class,'logout'])->name('logout_page');
    Route::post('/search', [HomeController::class,'ambu_price_detail'])->name('search_get');
    Route::any('/booking/selectCategory', [HomeController::class,'selectCategory'])->name('Select_Category');
    Route::post('/booking_category_availability_check', [HomeController::class,'getAvailableCategory'])->name('Get_Available_Category');
    Route::post('/login_varification',[RegistraionController::class,"login_varification"])->name("login_varification");
    Route::any('/login/resend_otp/{mob?}',[RegistraionController::class,"resend_otp"])->name('login_verification.Resendotp');
    Route::post('/otp_match',[RegistraionController::class,"otp_match"])->name("otp_match");
    Route::post('/consumer/register_user',[RegistraionController::class,"register_consumer"])->name("register_consumer");
    Route::any('/consumer/ambu_detail/{ambu_type?}/{ambu_price?}',[RegistraionController::class,"save_ambu_detail"])->name("ambu_detail_save");
    Route::any('/medcab/booking/login',[RegistraionController::class,'booking_login']);   
    Route::any('/medcab/booking/registration',[RegistraionController::class,'booking_register']);    

    // test notifications
    Route::any('/driver/test/notifiy',[DriverController::class,'test'])->name('Driver.Test');
    Route::middleware([autheMiddleware::class])->group(function () {
    
    // bulk booking controller
    Route::post('session_save',[Booking2Controller::class,"session_save"])->name("Addons_Session_Save");
    Route::post('remove_addon',[Booking2Controller::class,"remove_addon"])->name("Remove_Addon");

    Route::get('/booking', [Booking2Controller::class,'booking_view'])->name('booking_page') ;
    Route::get('/check_login', [Booking2Controller::class,'booking_view'])->name('check_login') ;

    //booking process
    Route::post('/bookingProcess',[Booking2Controller::class,'booking_proccess'])->name('Booking_Process') ;

    // Razorpay payment gateway
    Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay') ;
    Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment') ;
    Route::any('/session_print', [BookingPaymentController::class, 'sessionPrint'])->name('Session_All') ;

    //CCevenue payment gateway
    Route::post('/booking/CCpayment/request', [PaymentMethodController::class,'CCPaymentRequest'])->name('CCpayment.PayRequest');
    Route::post('/booking/payment/response', [PaymentMethodController::class,'CCPaymentResponse'])->name('CCpayment.PayResponse');

    //Payment Routes    
    Route::post('/orderid-generate', [BookingPaymentController::class, 'orderIdGenerate']) ;
    Route::get('/payment/{razorpay_payment_id}/{razorpay_order_id}/{razorpay_signature}', [BookingPaymentController::class, 'storePayment']) ;
    Route::get('/payment_done/{booking_id?}', function(){
        return view('payment_done');
    })->name('PaymentDone') ;
    Route::any('/bulk_booking/save_bulk_booking_details',[BookingPaymentController::class, 'saveBulkBookingDetails'])->name('BulkBooking.SaveBulkBookingDetails') ;
    Route::any('/bulk_booking/save_bulk',[BookingPaymentController::class, 'saveBulk'])->name('BulkBooking.SaveBulk') ;

    //Driver Waiting Page
    Route::any('/driver/waiting-for-driver/{booking_id?}',[DriverController::class,'waitingView'])->name('Driver.waitingDriver');
    Route::get('/driver/driver-assigned/{booking_id?}',[DriverController::class, "driver_assigned"])->name('Driver.AssignedDriver') ;
    Route::any('/driver/search-driver/{data?}',[DriverController::class,'searchDriver'])->name('Driver.SearchDriver');
    Route::any('/driver/get-driver-live-location',[DriverController::class,'getDriverLiveLocation'])->name('Driver.DriverLiveLocation');
    Route::any('/driver/consumer-rating',[DriverController::class,'consumerRating'])->name('Driver.ConsumerRating');
    Route::any('/consumer/get-invoice/{booking_id?}',[DriverController::class,'getInvoice'])->name('consumer.GetInvoice');

    //Booking Cancellation
    Route::any('/booking/cancel_send_notification/{data?}',[SendNotificationController::class,'send_notification'])->name('Cancellation');
    Route::any('/booking/cancel-booking',[DriverController::class,'cancel_booking'])->name('Booking.Cancellation');

    // Booking History and Upcoming bookings
    Route::any('/booking/history',[BookingHistoryController::class, 'booking_history'])->name('Booking.History');
    Route::any('/booking/booking-refreshing',[BookingHistoryController::class, 'booking_refreshing'])->name('Booking.Refreshing');
    Route::any('bulk_booking/driver/driver-assigned/{booking_id?}',[DriverController::class, 'driver_assigned'])->name('BulkBooking.DriverAssigned');
    // INVOICE DOWNLOAD
    Route::get('/download-invoice-pdf', [BookingHistoryController::class, 'downloadInvoicePDF'])->name('download.invoice.pdf');
});

