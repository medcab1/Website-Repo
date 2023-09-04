
@extends('layouts.adminlayout')
@section('title','Join Us - MedCab
')
@section('description',"Join us in our mission to save lives by providing prompt and round the clock Ambulance Service
in India and become our partner in serving humanity.")
@section('keywords',"MedCab, MedCab Join Us, Partner With Us, MedCab Partner")
@section('main')

<!-- Section Join Us top Banner Section -->
<section class="join-us pb-5">
    <div class="join-us-container">
        <div class="container">
            <div class="row gy-4 d-flex-center">
                <div class="col-lg-6 col-md-12">
                    <div class="join-top-left">
                        <h1 class="title-text">
                        Join Our Community of Service Providers
                        </h1>
                        <p>
                        Be a Part of Saving Lives Every Minute
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="join-top-right">
                        <div class="join-top-right-img">
                            <img src="{{url('/assets/image/join-us.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-around align-items-center py-5 gy-3 join-as-row">
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{url('/assets/image/driver_icon.png')}}" alt="" class="w-100">
                        </div>
                        <div class="join-info-detail">
                            <h3 class="p-text">Join as 
                            <br/>Ambulance Driver</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{url('/assets/image/partner_icon.png')}}" alt="">
                        </div>
                        <div class="join-info-detail">
                            <h3 class="p-text">Join as 
                            <BR/>Ambulance Service Provider (Partner)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{url('/assets/image/hospital_icon.png')}}" alt="">
                        </div>
                        <div class="join-info-detail">
                            <h3 class="p-text">Join as 
                            <br/>Hospital</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section Join Us top Banner Section -->

<!-- Join Us:As Driver -->
<section class="join-ambulance">
    <div class="join-ambu-container container">
        <div class="join-ambu-top">
            <div class="join-ambu-top-img">
                <img src="{{url('/assets/image/driver_png.png')}}" alt="">
            </div>
            <div class="join-ambu-top-desc">
                <h3 class="">Ambulance Driver</h3>
                <p class="p-text">Join our platform to experience these benefits:</p>
            </div>
        </div>
        <div class="row gy-4 join-ambu-box-container">
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{url('/assets/image/calender.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Earn and Thrive</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Low commission rates for greater earnings</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Real-time earnings tracking and daily payouts</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Access to daily offers and weekly incentives</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{url('/assets/image/rupee.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Flexibility and Control</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Choose your own schedule</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Select the types of rides and categories you prefer</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Option for rides that align with your preferred destinations</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Our special feature matches you with riders going in the same direction</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{url('/assets/image/safety.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">24/7 Support and Safety</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Get 24/7 access to our support team for any issues</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>An in-app SOS button for your safety</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Stay informed with new policies and features via in-app notifications</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Track your performance including your acceptance rate and trip ratings</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{url('/assets/image/driver_well.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Driver Wellness</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Your health and safety matter to us</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>View your driving hours to take care of yourself</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Get notifications for break</li>
                        <li class="join-ambu-box-list-item"><span class="list-disc"></span>Offer quality services to riders while taking care of yourself</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Join Us:As Driver -->

<!-- Join Us:As Partner -->
<section class="join-partner">
    <div class="join-ptr-container container">
        <div class="join-ptr-top">
            <div class="join-ptr-top-img">
                <img src="{{url('/assets/image/ambu-png-icon.png')}}" alt="">
            </div>
            <div class="join-ptr-top-desc">
                <h3 class="">Ambulance Service Provider (Partner)</h3>
            <div>
        </div>
        <div class="row gy-4 join-ptr-box-container">
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/driver_tracking.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Real-Time Driver Tracking</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/on-off.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Check Driver's On/Off Duty Status</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/history.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Get Daily/Weekly/Monthly Booking History</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/revenue.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Check Revenue Reports</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/driver_history.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Check Driver Assignment History</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{url('/assets/image/add_dvr_ambu.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Expand Your Fleet by adding drivers and ambulances</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Join Us:As Partner -->

<!-- Join Us:As Hospital -->
<section class="join-hospital">
    <div class="join-hpl-container container">
        <div class="join-hpl-top">
            <div class="join-hpl-top-img">
                <img src="{{url('/assets/image/hospital-png-icon.png')}}" alt="">
            </div>
            <div class="join-hpl-top-desc">
                <h3 class="">Ambulance Service Provider (Hospital)</h3>
</div>
        </div>
        <div class="row gy-4 join-hpl-box-container">
            <div class="col-md-6">
                <div class="join-hpl-box">
                    <div class="join-hpl-box-img">
                        <img src="{{url('/assets/image/driver_tracking.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Real-Time Driver Tracking</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-hpl-box">
                    <div class="join-hpl-box-img">
                        <img src="{{url('/assets/image/on-off.png')}}" alt="">
                    </div>
                    <h3 class="join-box-heading">Check Driver's ON/OFF Duty Status</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Join Us:As Hospital -->

<!-- Review section -->
@include('include.testimonial')
<!-- Review Section -->

<!-- dowmload banner -->
@include('include.download_banner')
 <!-- dowmload banner --> 

@endsection
