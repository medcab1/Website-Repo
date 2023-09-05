  <!-- check hospital availability -->
  @php
  $get_hospital_data = DB::table('hospital_service_category')
    ->get();
    @endphp
  
              
              <div class="grid-container">
                @foreach($get_hospital_data as $key)
                  <a href="#">
                      <div class="grid-item shadow">
                          <div>
                              <img src="{{ env('DYNAMIC_IMAGE_URL') . '/' . $key->hospital_serv_cat_icon }}" class="mb-lg-4 mb-sm-2" alt="" />
                          </div>
                          <h5 class="">{{$key->hospital_serv_cat_name}}</h5>
                          <p>Check Availability of both AC and Non-AC</p>
                      </div>
                  </a>
                  @endforeach
              </div>
          