@extends('layouts.adminlayout')
@section('title','Types of Ambulance Services | MedCab Ambulance App')
@section('main')
<!-- @Uttam -->
<!-- @section('description',"Select the best ambulance type from BLS, ALS, ICU, Dead Body, Patient Transfer, Air Ambulance and book an ambulance in 1 minute with MedCab app in India.")
@section('keywords',"Types of ambulance, Ambulance Booking, Ambulance Online Book, Online Ambulance Booking
Number, ambulance number, air ambulance, BLS, advance life support, patient transport
ambulance, ICU ambulance, Boat ambulance, Water ambulance, Dead body ambulance,
e-rickshaw ambulance") -->

<!-- Header -->

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

@include('include.faqs')
@endsection