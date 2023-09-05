
@extends('layouts.adminlayout')
@section('title','Ambulance Services for Hospitals - MedCab')
@section('description',"MedCab - India's leading emergency medical transport provider, offers the fastest ambulance
services to hospitals with 24/7 customer support in all over India.")
@section('keywords',"MedCab, Ambulance Services for Hospitals")
@section('main')


<!-- hospitals header -->
    
<!-- hospitals header -->

<section class="ourServices d-flex flex-column align-items-center">
      <section class="section-4 grid-container-box d-flex justify-content-center">
          <div class="facilities gap-3">

                <div class="label mb-md-5 mb-sm-3">
                  <h3 class="text-center fw-bold mb-4">
                      Check Hospital Availability
                  </h3>
                  <p class="text-center">
                      Discover the convenience of checking the availability of beds such
                      as ICU Beds, ISU Beds, etc. in nearby hospitals effortlessly,
                      helping you make informed decisions during critical times.
                  </p>
                </div>


                @include('include.hospital_availability_main');

                </div>
      </section>
  </section>


@endsection
