<!-- Check Hospital Availability -->
@php
$get_hospital_data = DB::table('hospital_service_category')
  ->get();
  @endphp

<div class="hospital-availability d-flex justify-content-center">
      <div class="facilities gap-3">
        <div class="label mb-3">
          <h1 class="main-heading">Check Hospital Availability</h1>
          <p class="text-center">
            Discover the convenience of checking the availability of beds such
            as ICU Beds, ISU Beds, etc. in nearby hospitals effortlessly,
            helping you make informed decisions during critical times.
          </p>
        </div>
        <div
          class="grid-container owl-carousel owl-carousel-facilities owl-theme"
        >
          @foreach($get_hospital_data as $key)
          <a href="#" class="item">
            <div class="grid-item shadow">
              <div>
                <img
                  src="{{env('DYNAMIC_IMAGE_URL') . '/' . $key->hospital_serv_cat_icon}}"
                  class="mb-lg-4 mb-sm-2"
                  alt="x-ray"
                />
              </div>
              <h5 class="">{{$key->hospital_serv_cat_name}}</h5>
            </div>
          </a>
          @endforeach
        </div>
        <div class="btn-view">
          <a href="#"
            >View All
            <svg
              class="mb-1 ms-1"
              width="18"
              height="14"
              viewBox="0 0 21 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M20.7071 8.7071C21.0976 8.31658 21.0976 7.68342 20.7071 7.29289L14.3431 0.928931C13.9526 0.538407 13.3195 0.538407 12.9289 0.928931C12.5384 1.31946 12.5384 1.95262 12.9289 2.34314L18.5858 8L12.9289 13.6569C12.5384 14.0474 12.5384 14.6805 12.9289 15.0711C13.3195 15.4616 13.9526 15.4616 14.3431 15.0711L20.7071 8.7071ZM8.74227e-08 9L20 9L20 7L-8.74227e-08 7L8.74227e-08 9Z"
                fill="white"
              />
            </svg>
          </a>
        </div>
      </div>
    </div>