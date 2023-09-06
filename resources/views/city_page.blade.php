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
<header class="header">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="header-small-hero">
                <h1 class="header-text">
                    <span>One Stop Solution</span><br />
                    for all of your<br />
                    <span>Ambulance Needs</span>
                </h1>
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
                    <div class="mt-5 booking-submit">
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
        <div class="header-right">
            <h1 class="header-text">
                <span>One Stop Solution</span><br />
                for all of your<br />
                <span>Ambulance Needs</span>
            </h1>
        </div>
    </div>
    <div class="header-image">
        <img src="{{asset('/assets/website-images/website-gif-final.gif')}}" class="img-fluid" alt="banner" />
    </div>
</header>


@endsection