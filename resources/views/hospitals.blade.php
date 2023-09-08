@extends('layouts.adminlayout')
@section('title','Ambulance Services for Hospitals - MedCab')
@section('description',"MedCab - India's leading emergency medical transport provider, offers the fastest ambulance
services to hospitals with 24/7 customer support in all over India.")
@section('keywords',"MedCab, Ambulance Services for Hospitals")
@section('main')



<!-- hospitals header -->
<section class="hospitals w-100 padding">
  <section class="section-1 d-flex w-100">
    <div class="text w-50 d-flex flex-column justify-content-evenly">
      <div class="title">
        <h3>Trusted Medical Transport Solution for Your Hospital</h3>
      </div>
      <div class="info d-flex flex-column gap-4">
        <p>
          Medcab is India's premier medical transport system, providing top
          notch emergency/ non-emergency services with 24x7 ambulance
          availability nationwide.
        </p>
        <p>
          Our aim is to revolutionize the industry and become India's go-to
          emergency response system, available at your fingertips. With our
          state-of-the-art dispatch softeware, hospitals can schedule
          pickups and drops with ease, ensuring prompt service every time.
          Time is of the assence in medical emergencies, which is why we
          prioritize speed and efficiency, offering the quickest possible
          response times to provide unparalleled support. Join us in our
          mission to make medical emergencies a top priority and experience
          our exceptional ambulance services today!
        </p>
      </div>
    </div>
    <div class="image w-50">
      <img src="{{asset('assets/website-images/hospitals-main.png')}}" alt="main" />
    </div>
  </section>
</section>
<!-- hospitals header -->


<!-- check hospital availability -->
<section class="hospital-availability-2 grid-container-box section-2 d-flex justify-content-center w-100 padding ">
  <div class="facilities gap-3">
    <div class="label mb-md-5 mb-sm-3 d-flex flex-column align-items-center gap-5">
      <img src="{{asset('assets/website-images/hospital.png')}}" alt="hospital">
      <h3 class="text-center fw-bold mb-4">
        Hospital Services Includes
      </h3>

    </div>
    <div class="grid-container">
      @foreach ($get_data as $key)

      <a href="#">
        <div class="grid-item shadow">
          <div>
            <img src="{{ env('DYNAMIC_IMAGE_URL') . '/' . $key->hospital_serv_cat_icon }}" class="mb-lg-4 mb-sm-2" alt="x-ray" />
          </div>
          <h5 class="">{{$key->hospital_serv_cat_name}}</h5>
          <p>Check Availability of both AC and Non-AC</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
<!-- check hospital availability -->

<!-- download availability banner -->
@include('include.download_availability_banner')
<!-- download availability banner -->

<!-- our services -->
@include('include.service')
<!-- our services -->

<!-- download banner -->
@include('include.download_banner')
<!-- download banner -->

@endsection