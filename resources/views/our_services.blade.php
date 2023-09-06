@extends('layouts.adminlayout')
@section('title','Our Services')
@section('description',"MedCab - India's leading emergency medical transport provider, offers the fastest ambulance
services to hospitals with 24/7 customer support in all over India.")
@section('keywords',"MedCab, Ambulance Services for Hospitals")
@section('main')

<!-- our services page start -->



<section class="ourServices">
    <!-- main image -->
    <section class="serviceHead section-1 w-100">
        <!-- <img src="../images/handShake.png" alt="hands"> -->
        <h1 class="fs-sm-2">Discover Our Range of Services</h1>
    </section>

    <!-- toggle -->
    <section class="section-2 d-flex justify-content-between w-100">
        <div class="as border w-50 d-flex flex-column align-items-center p-4 text-center w-100">
            <img class="mb-2" src="{{asset('assets/website-images/whiteCircle.png')}}" alt="whiteCircle" />
            <p class="text-white">Ambulance Services</p>
        </div>
        <div class="chas border w-50 d-flex flex-column align-items-center p-4 text-center w-100">
            <img class="mb-2" src="{{asset('assets/website-images/whiteCircle.png')}}" alt="whiteCircle" />
            <p class="text-white">Check Hospital Availability Services</p>
        </div>
    </section>

    <!-- ambulance services -->
    @include('include.ambulance_services')
    <!-- ambulance services -->

    <!-- hospital availability main -->
    @include('include.hospital_availability_main')
    <!-- hospital availability main -->

    <!-- download availability banner -->
    @include('include.download_availability_banner')
    <!-- download availability banner -->

    <!-- faqs -->
    @include('include.faqs')
    <!-- faqs -->

    <!-- download banner -->
    @include('include.download_banner')
    <!-- download banner -->

</section>
<!-- our services page end -->

@endsection