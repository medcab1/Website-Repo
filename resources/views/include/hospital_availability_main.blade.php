  <!-- check hospital availability -->
  @php
  $get_hospital_data = DB::table('hospital_service_category')
  ->get();
  @endphp

  <section class="ourServices w-100">

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
        <div class="grid-container">
          @foreach($get_hospital_data as $key)
          <a href="#">
            <div class="grid-item shadow">
              <div>
                <img src="{{ env('DYNAMIC_IMAGE_URL') . '/' . $key->hospital_serv_cat_icon }}" class="mb-lg-4 mb-sm-2" alt="" />
              </div>
              <h5 class="">{{$key->hospital_serv_cat_name}}</h5>
              <p class="w-75">Check Availability of both AC and Non-AC</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </section>
  </section>