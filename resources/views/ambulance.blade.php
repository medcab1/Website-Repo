@extends('layouts.adminlayout')
@section('title','Types of Ambulance Services | MedCab Ambulance App')
@section('main')
@section('description',"Select the best ambulance type from BLS, ALS, ICU, Dead Body, Patient Transfer, Air Ambulance and book an ambulance in 1 minute with MedCab app in India.")
@section('keywords',"Types of ambulance, Ambulance Booking, Ambulance Online Book, Online Ambulance Booking
Number, ambulance number, air ambulance, BLS, advance life support, patient transport
ambulance, ICU ambulance, Boat ambulance, Water ambulance, Dead body ambulance,
e-rickshaw ambulance")

<!-- Start Blog Banner Section -->

<!-- ambulance header -->
<header class="ambulance-header d-flex">
  <div class="left d-flex flex-column align-items-start">
    <h1 class="main-heading">Ambulances</h1>
    <div class="d-flex flex-column gap-4">
      <p class="primary-text">
        Choose the ambulance that best fits your needs and book online
        through our App or website.
      </p>
      <p class="primary-text">
        With a hassle-free booking process that makes it easy to get the
        medical transport you require
      </p>
    </div>
  </div>
  <div class="right">
    <img src="{{asset('assets/website-images/ambulance-header-img.png')}}" alt="" />
  </div>
</header>
<!-- ambulance header -->

<!-- ambulance services -->
@include('include.ambulance_services')
<!-- ambulance services -->

<!-- customer support -->
@include('include.customer_support')
<!-- customer support -->

<!-- how to book -->
@include('include.booking_preview')
<!-- how to book -->

<!-- download banner -->
@include('include.download_banner')
<!-- download banner -->


@endsection