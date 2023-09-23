
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
            <div class="header-booking">

                <form method="post" action="{{URL::to('/search')}}" id="loc-form">
                    @csrf
                    <div class="booking-option text-white mb-3">
                        <div class="border-1 rounded-pill form-checkbox" onclick="toggleRadio('normal')">
                            <input type="radio" name="booking-type" id="normal" value="0" class="booking-type-radio d-none" checked>
                            <label class="form-check-label booking-type-btn rounded-pill booking-type-active">
                                Emergency
                            </label>
                        </div>
                        <div class="border-1 rounded-pill form-checkbox" onclick="toggleRadio('rental')">
                            <input type="radio" name="booking-type" value="1" class="booking-type-radio d-none" id="rental">
                            <label class="form-check-label booking-type-btn rounded-pill" data-bs-toggle="modal" data-bs-target="#rentalTimePeriod">
                                Rental
                            </label>
                        </div>
                        <div class="border-1 rounded-pill form-checkbox" onclick="toggleRadio('bulk')">
                            <input type="radio" name="booking-type" value="2" class="booking-type-radio d-none" id="bulk">
                            <label class="form-check-label booking-type-btn rounded-pill">
                                Bulk
                            </label>
                        </div>
                    </div>
                    <!-- <form class="header-bookingForm"> -->
                    <div class="header-bookingForm">

                        <div class="form-group mb-4 mt-4">
                            <label for="exampleDropdownFormEmail1" class="form-label">Pickup Location</label>
                            <div class="input-group pick-group input-wrapper">
                                <span>
                                    <img src="{{asset('assets/website-images/location.png')}}" alt="" />
                                </span>
                                <input type="text" name="pick" class="form-control shadow-none outline-none pick" id="pickup" aria-describedby="emailHelp" placeholder="Enter Pickup Address Here" />
                                <i class="fa-solid fa-location-crosshairs control-icon" id="current_location"></i>
                                <i class="fa-solid fa-xmark reset-input control-icon pick-cross" style="display: none"></i>
                                <input type="hidden" id="lat" name="pick_lat" value="lat">
                                <input type="hidden" id="lng" name="pick_lng" value="lng">
                            </div>
                        </div>
                        <div class="form-group mb-5 drop-form-group p-relative">
                            <label for="" class="form-label">Drop Location</label>
                            <div class="input-group drop-group input-wrapper">
                                <span><img src="{{asset('assets/website-images/drop-locatino.png')}}" alt="" /></span>
                                <input type="text" class="form-control input-focus-none shadow-none outline-none" id="drop" name="drop" placeholder="Enter Destination Address here" disabled />
                                <i class="fa-solid fa-xmark drop-reset-input control-icon"></i>
                            </div>
                            <input type="hidden" name="drop_lat" id="drop_lat" value="lat">
                            <input type="hidden" name="drop_lng" id="drop_lng" value="lng">
                            <div class="suggestion shadow secondary-text" id="popup_sugg" style="display:none">
                                <p style="color:gray;font-style:italic; margin:10px;margin-bottom:0px;">Nearest Hospitals:</p>
                                <hr class="m-0">
                                <div class="suggestion-box popup-box rounded secondary-text"></div>
                            </div>
                        </div>
                        <div class="form-group p-relative duration-group" style="display:none;">
                            <label for="">Booking Period</label>
                            <input type="text">
                        </div>
                        <input type="text" name="distance" id="distance" hidden>
                        <div class="input-group  " id="schedule-box" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da;display:none;">
                            <label class="input-group-btn" for="txtDate">
                                <span class="btn btn-default">
                                    <i class="fa-regular fa-clock text-color"></i>
                                </span>
                            </label>

                            <input id="txtDate" name="schedule-time" type="text" class="form-control date-input b-none " title="date" style="border:none;display:none" value='<?php echo time(); ?>' />
                        </div>

                        <!--Schedule Rental booking time Modal start -->
                        <div class="modal" id="rentalTimePeriod" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content m-auto" style="width:361px!important;">
                                    <div class="modal-header border-0 bg-danger w-100">
                                        <h6 class="modal-title text-secondary text-white" id="exampleModalCenterTitle">Select Booking Time Period</h6>

                                    </div>
                                    <div class="modal-body ">
                                        <div class="schedule-box">
                                            <p class="text-secondary">Select no. of hours/ days you want to book an ambulance for</p>
                                            <div class="book-time-period-type w-100">
                                                <div class="w-100 d-flex align-items-center" style="gap:20px;">
                                                    <div class="form-checkbox d-flex justify-content-center gap-3 w-50 border py-2">
                                                        <input type="radio" name="booking-period" id="by-hour" data-id="hours" value="24" class="booking-period-radio" checked>
                                                        <label class="form-check-label text-gray">
                                                            Hours
                                                        </label>
                                                    </div>
                                                    <div class="form-checkbox d-flex justify-content-center gap-3 w-50 border py-2">
                                                        <input type="radio" name="booking-period" value="31" data-id="days" class="booking-period-radio" id="by-day">
                                                        <label class="form-check-label text-gray">
                                                            Days
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- hours select box -->
                                            <div class="duration-select-box select-hours w-100" data-class="select-hours" id="hours">
                                                <select name="sel-hours" class="border border-none w-100 py-2" required>
                                                    <option value="1">Select Hours</option>
                                                </select>
                                            </div>
                                            <!-- Hourse select box -->

                                            <!-- Days select box -->
                                            <div class="duration-select-box select-days w-100" data-class="select-days" id="days">
                                                <select name="sel-days" class="border border-none w-100 py-2" required>
                                                    <option value="1">Select Days</option>
                                                </select>
                                            </div>
                                            <!-- Days select box -->
                                        </div>
                                    </div>
                                    <div class="modal-footer flex-nowrap border-0 w-100">
                                        <button type="button" class="m-btn medcab-btn-transparent border border-danger w-100 rounded py-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="m-btn w-100 medcab-btn border border-danger w-100 bg-danger text-white rounded py-2" id="duration-btn">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Schedule Rental booking time Modal end -->
                        <div class="mt-3 booking-submit search-btn-outer">
                            <button class="border rounded p-1 booking-time book-now-watch currDateTime">
                                <span><img src="{{asset('assets/website-images/Access time.png')}}" alt="" /></span>
                            </button>
                            <button type="submit" id="submit-btn" class="btn">Search Ambulance</button>
                        </div>
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

<!--Schedule booking time Modal start -->
<div class="modal" id="ModalCenter" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title text-secondary" id="exampleModalCenterTitle">Schedule Ambulance</h6>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body ">
                <div class="schedule-box">
                    <div class="input-group mb-2" id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                        </label>
                        <input id="datepicker" type="date" min="<?php echo date('Y-m-d'); ?>" data-date="" data-date-format="DD MMMM YYYY" class="form-control date-input b-none" style="border:none;" placeholder="Select Date" />
                        <label class="dropdown-btn" id="scheduling">
                            <span class="down-chevron-icon ">

                            </span>
                        </label>
                    </div>
                    <div class="input-group mb-2 " id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                        </label>
                        <input id="timepicker" type="time" min="<?php echo date('H:i:s'); ?>" class="form-control date-input b-none" style="border:none;" />
                        <label class="dropdown-btn" id="scheduling">
                            <span class="down-chevron-icon ">

                            </span>
                        </label>
                    </div>
                    <p class="text-secondary">Book in Advance - Schedule your Date and Time</p>
                </div>
            </div>
            <div class="modal-footer flex-nowrap border-0">
                <button type="button" class="m-btn medcab-btn-transparent" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="m-btn w-100 medcab-btn" id="confirm-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>

@endsection
