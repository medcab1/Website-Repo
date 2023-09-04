
@extends('layouts.adminlayout')
@section('title','Types of Ambulance Services | MedCab Ambulance App')
@section('main')
@section('description',"Select the best ambulance type from BLS, ALS, ICU, Dead Body, Patient Transfer, Air Ambulance and book an ambulance in 1 minute with MedCab app in India.")
@section('keywords',"Types of ambulance, Ambulance Booking, Ambulance Online Book, Online Ambulance Booking
Number, ambulance number, air ambulance, BLS, advance life support, patient transport
ambulance, ICU ambulance, Boat ambulance, Water ambulance, Dead body ambulance,
e-rickshaw ambulance")

<!-- Start Blog Banner Section -->
<section class="hospitals-top section-padding ">
    <div class="hospitals-banner bg-white">
    <div class="container ">
        <div class="row gy-4 ">
            <div class="col-lg-6 col-md-12 ">
                <div class="banner-text-left text-left" style="text-align:left;">
                    <h1 class="banner-heading">
                    Ambulance Service
                    </h1>
                   
                    <p class="p-text">
                    Welcome to MedCab's ambulance services, where we prioritize your health and safety. Our ambulance services are designed to meet your urgent medical needs with utmost care and precision. Our services are available 24/7 and we pride ourselves on our state-of-the-art equipment and highly experienced staff.
                    <br/>
                    <br/>
                    We offer a variety of ambulance services, including basic life support, advanced life support, critical care transport, etc. Our services are tailored to meet the unique needs of each patient and we strive to provide compassionate and reliable care.
                    <br/>
                    <br/>
                    At MedCab, we understand the importance of timely and efficient medical care, which is why we go the extra mile to provide exceptional service. Trust MedCab to take care of your medical transportation needs and experience the difference.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 d-flex-center">
                <div class="  h-100 w-100" style="bg-color:#F89E9E;">
                    <img src="{{url('/assets/image/ambulances-img.png')}}" alt="Ambulance Image" class="w-100">
                </div>
            </div>
        </div>
    </div> 
    </div>
    <div class="container"> 
        
    </div>

</section>

<!-- Services -->
<div class="top-curve-img ">
    <img src="{{url('/assets/image/top-curve-img.png')}}" alt="Curve BG" class="w-100" alt="">
</div>
@include('include.service')
<!-- Services -->

<!-- Supports section -->
@include('include.support_section')
<!-- Supports section -->

<!-- dowmload banner -->
@include('include.download_banner');
 <!-- dowmload banner --> 
@endsection
