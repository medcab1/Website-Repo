
@extends('layouts.adminlayout')
@section('title')<?php echo $city->city_meta_title;?>@endsection
@section('description'){!!$city->city_meta_desc!!}@endsection
@section('keywords')<?php echo $city->city_meta_keyword;?>@endsection

@section('main')
<!-- City page top section -->
<!-- City Header -->



<section class="header cityPage">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="cityPage-title">
                <h1 class="main-heading text-start m-0">Ambulance Services</h2>
                    <h1 class="main-heading text-start m-0 mb-4 fw-light">in {!!$city->city_name!!}</h2>

            </div>
            <div class="header-booking p-4">
                <div class="booking-option text-white mb-3">
                    <a href="#" class="border-1 rounded-5 active">Emergency</a>
                    <a href="#" class="'border-1 rounded-5">Bulk</a>
                    <a href="#" class="'border-1 rounded-5">Rent</a>
                </div>
                <form class="header-bookingForm">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Pickup Location</label>
                        <div class="input-wrapper">
                            <span>
                                <img src="{{asset('assets/website-images/location.png')}}" alt="" />
                            </span>
                            <input type="text" class="form-control shadow-none outline-none" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Pickup Address Here" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Drop Location</label>
                        <div class="input-wrapper">
                            <span><img src="{{asset('assets/website-images/drop-locatino.png')}}" alt="" /></span>
                            <input type="text" class="form-control shadow-none outline-none" id="exampleInputPassword1" placeholder="Enter Destination Adress here" />
                        </div>
                    </div>
                    <div class="mt-2 booking-submit">
                        <button class="border rounded p-1 booking-time">
                            <span><img src="{{asset('assets/website-images/Access time.png')}}" alt="" /></span>
                        </button>
                        <button type="submit" class="btn">Search Ambulance</button>
                    </div>
                </form>
            </div>
            <div class="header-cta">
                <div class="header-ctaBox mt-4">
                    <span><img src="{{asset('assets/website-images/call.png')}}" alt="" /></span>
                    <a href="#">Call Emergency 18008-908-208</a>
                </div>
                <div class="header-ctaBox mt-4">
                    <span><img src="{{asset('assets/website-images/hospital-cehck.png')}}" alt="" /></span>
                    <a href="#">Check Hospitals Availability</a>
                </div>
            </div>
        </div>
        <div class="city-HeaderImage">
            <img src="{{asset('/assets/website-images/city-image.png')}}" class="img-fluid" alt="banner" />
        </div>
    </div>
</section>
<!-- City Header -->

<!-- City About  -->
<section class='cityAbout'>
    <div class="cityAbout-image">
        <img src="{{asset('/assets/website-images/city-image.png')}}" alt="banner" />
    </div>
    <div class="cityAbout-text">
        <h1 class="main-heading  text-start mt-2">24/7 Ambulance Service in {!!$city->city_name!!}</h2>
            <p class="primary-text">
                {!!$city->city_body_desc!!}
            </p>
    </div>
    </div>
</section>
<!-- City About  -->

<!-- Ambulance Service -->
@include('include.ambulance_services')
<!-- Ambulance Service -->

<!-- City Top Routes -->
<section class="cityAbout topRoutes">
    <div class="cityAbout-text">
        <h1 class="main-heading text-start">Top Routes</h1>
        <div class="cityRoutes primary-text">
            <a href="#">
                <div class="route active">
                    <p class="">Taxi from</p>
                    <p>{{$route[0]->city_route_from}} to Delhi</p>
                </div>
            </a>
            <a href="#">
                <div class="route ">
                    <p class="">Taxi from</p>
                    <p>{{$route[0]->city_route_from}} to Lucknow</p>
                </div>
            </a>
            <a href="#">
                <div class="route ">
                    <p class="">Taxi from</p>
                    <p>{{$route[0]->city_route_from}} to Kanpur</p>
                </div>
            </a>
        </div>
        <div class="routeData">
            <p class="distance">
                <span>Distance:</span>
                <span>{{$route[0]->city_route_distance}} kms</span>
            </p>
            <p class="time">
                <span>Estimated Time:</span>
                <span>{{$route[0]->city_route_duration}} hrs</span>
            </p>
        </div>
        <div class="hospitalLists">
            <span>Hospitals Available in Delhi : </span>
            <span>Jeevan Hospital | Manipal Hospital | Maharaja Agrasen Hospital | Fortis Hospital | Jeevan Hospital | Manipal Hospital | Maharaja Agrasen Hospital | Fortis Hospital |Jeevan Hospital | Manipal Hospital | Maharaja Agrasen Hospital | Fortis Hospital | Jeevan Hospital | Manipal Hospital | Maharaja Agrasen Hospital | Fortis Hospital</span>
        </div>
        <div class="primary-cta">Book Now</div>
    </div>
    <div class="cityAbout-image">
        <img src="{{asset('/assets/website-images/city-image.png')}}" alt="banner" />
    </div>
</section>
<!-- City Top Routes -->

<!-- Steps to book ambulance in city -->
<section class="bookAmbulance">
    <h1 class="main-heading text-start">How to Book an Ambulance in {!!$city->city_name!!}</h1>
    <p>
        MedCab is revolutionizing the ambulance booking process by providing an easy-to-use app and website. With just a few clicks, you can book an ambulance and rest assured that we will reach you quickly. Our platform also provides you with all the necessary information about our services, ensuring a hassle-free experience.
    </p>
    <h2 class="secondary-heading text-center">
        Call Us to Book an Ambulance
    </h2>
    <p class="my-4">Here's how you can call an ambulance number in {!!$city->city_name!!} with us : </p>
    <ul class="bookingSteps">
        <div class="step">
            <div class='step_num'>Step 1</div>
            <li>Call our emergency ambulance number in {{$city->city_name}} 18008-908-208 or visit our website <a href="www.medcab.in">medcab.in</a></li>
        </div>
        <div class="step">
            <div class='step_num'>Step 2</div>
            <li>Provide the necessary details, including the patient's name, address and condition.</li>
        </div>
        <div class="step">
            <div class='step_num'>Step 3</div>
            <li>Our team will assess the situation and dispatch the nearest ambulance equipped with the necessary medical equipment.</li>
        </div>
        <div class="step">
            <div class='step_num'>Step 4</div>
            <li>Our trained medical staff will provide the patient with the best possible care and transport them safely to the hospital.</li>
        </div>
        <div class="step">
            <div class='step_num'>Step 5</div>
            <li>Payment can be made through various modes, including cash, debit/credit card and online transfer.</li>
        </div>
    </ul>
    <p>At MedCab, we understand the importance of prompt and efficient medical assistance in an emergency. That's why we ensure that our ambulance services are available 24/7 and our response time is among the quickest in {!!$city->city_name!!}. Trust MedCab for safe and reliable ambulance service Don't hesitate to call MedCab in case of a medical emergency. We are always ready to serve and ensure that you receive the best medical attention.</p>
    </p>
</section>
<!-- Steps to book ambulance in city -->

<!-- Emergency Ambulance Number in City -->
<section class="row bg-light emergency_ambulance_city">
    <div class="col-12 col-lg-4 left-section">
        <h1 class="text-start main-heading">Emergency Ambulance Number in {!!$city->city_name!!}</h1>
        <p>{!!$city->city_emergency_desc!!}</p>
    </div>
    <div class="col-12 col-lg-6 bg-white right-section mt-4 mt-sm-0 ">
        <h2 class="secondary-heading">Ambulance Charges</h2>
        <p class="mt-3">MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway. MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway.</p>
        <div class="row gy-4">
            @include('include.faqs')
        </div>
</section>
<!-- Emergency Ambulance Number in City -->

<!-- Booking Ambulance -->
@include('include.booking_preview')
<!-- Booking Ambulance -->

<!-- download banner -->
@include('include.download_banner')
<!-- download banner -->

<!-- Faqs -->
@include('include.faqs')
<!-- Faqs -->
@endsection
