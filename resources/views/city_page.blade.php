@extends('layouts.adminlayout')
@section('title','Types of Ambulance Services | MedCab Ambulance App')
@section('main')
<!-- @Uttam -->
<!-- @section('description',"Select the best ambulance type from BLS, ALS, ICU, Dead Body, Patient Transfer, Air Ambulance and book an ambulance in 1 minute with MedCab app in India.")
@section('keywords',"Types of ambulance, Ambulance Booking, Ambulance Online Book, Online Ambulance Booking
Number, ambulance number, air ambulance, BLS, advance life support, patient transport
ambulance, ICU ambulance, Boat ambulance, Water ambulance, Dead body ambulance,
e-rickshaw ambulance") -->

<!-- City Header -->

<section class="header cityPage">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="cityPage-title">
                <h1 class="main-heading  text-start m-0">Ambulance Services</h2>
                    <h1 class="main-heading  text-start m-0 mb-4 fw-light">in Rishikesh</h2>

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
        <h1 class="main-heading  text-start mt-2">24/7 Ambulance Service in Rishikesh</h2>
            <p class="primary-text">
                Rishikesh, located in the northern state of Uttarakhand in India, is a popular destination for spiritual seekers and adventure enthusiasts alike. Known as the "Yoga Capital of the World, "Rishikesh is famous for its ashrams, yoga schools and the holy river Ganges that flows through it. However, with the increasing number of tourists and residents, the need for fast ambulance service has become more pressing in Rishikesh. The city has only a handful of ambulances available and often, patients have to wait for hours to get medical attention. MedCab is a leading ambulance service provider in Rishikesh that has been serving the city and surrounding areas for a long time. With a fleet of fully equipped ambulances and trained medical staff, MedCab has been providing round-the-clock emergency medical services to people in need. With MedCab's presence, Rishikesh residents and tourists can now be assured of timely and reliable medical assistance. MedCab's ambulance service has been a game-changer in the healthcare industry of Rishikesh, providing a crucial service that was previously lacking
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
                    <p>Rishikesh to Delhi</p>
                </div>
            </a>
            <a href="#">
                <div class="route ">
                    <p class="">Taxi from</p>
                    <p>Rishikesh to Lucknow</p>
                </div>
            </a>
            <a href="#">
                <div class="route ">
                    <p class="">Taxi from</p>
                    <p>Rishikesh to Kanpur</p>
                </div>
            </a>
        </div>
        <div class="routeData">
            <p class="distance">
                <span>Distance:</span>
                <span>225.5 km</span>
            </p>
            <p class="time">
                <span>Estimated Time:</span>
                <span>4 hr 46 min</span>
            </p>
        </div>
        <div class="hospitalLists">
            <span>Hospitals Avialiable in Delhi : </span>
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
    <h1 class="main-heading text-start">How to Book an Ambulance in Rishikesh</h1>
    <p>
        MedCab is revolutionizing the ambulance booking process by providing an easy-to-use app and website. With just a few clicks, you can book an ambulance and rest assured that we will reach you quickly. Our platform also provides you with all the necessary information about our services, ensuring a hassle-free experience.
    </p>
    <h2 class="secondary-heading text-center">
        Call Us to Book an Ambulance
    </h2>
    <p class="my-4">Here's how you can call an ambulance number in Rishikesh with us : </p>
    <ul class="bookingSteps">
        <div class="step">
            <div class='step_num'>Step 1</div>
            <li>Call our emergency ambulance number in Rishikesh +91xxxxxxxxxx or visit our website Medcab.in</li>
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
    <p>At MedCab, we understand the importance of prompt and efficient medical assistance in an emergency. That's why we ensure that our ambulance services are available 24/7 and our response time is among the quickest in Rishikesh. Trust MedCab for safe and reliable ambulance service Don't hesitate to call MedCab in case of a medical emergency. We are always ready to serve and ensure that you receive the best medical attention.</p>
    </p>
</section>
<!-- Steps to book ambulance in city -->

<!-- Emergency Ambulance Number in City -->
<section class="row bg-light emergency_ambulance_city">
    <div class="col-12 col-lg-4 left-section">
        <h1 class="text-start main-heading">Emergency Ambulance Number in Rishikesh</h1>
        <p class="mb-4">MedCab has become the go-to ambulance service in Rishikesh, known for its reliable and timely services. With our fleet of fully-equipped ambulances and experienced medical staff, MedCab has been catering to the medical needs of Rishikesh residents and tourists for quite some time now. Due to our exceptional service, +91xxxxxxxxxx has become the most used ambulance number in Rishikesh.</p>

        <p class="mb-4">Our emergency response team is trained to handle critical situations with efficiency and compassion, ensuring that patients receive the best possible care. If you or a loved one requires medical assistance, it is crucial to call an ambulance immediately. By dialing MedCab's number, you can be assured of prompt and reliable medical assistance.</p>

        <p>Don't hesitate to call MedCab in case of a medical emergency. We are always ready to serve and ensure that you receive the best medical attention.</p>
        </p>
    </div>
    <div class="col-12 col-lg-6 bg-white right-section mt-4 mt-sm-0 ">
        <h2 class="secondary-heading">Ambulance Charges</h2>
        <p class="mt-3">MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway. MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway.</p>
        <div class="row gy-4 text-center">
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