
@extends('layouts.configLayout')
@section('title',"MedCab | Ambulance Service in India | Ambulance Booking App
")
@section('description',"MedCab offers ambulance services via an online ambulance booking app at low cost in India.
We offer a variety of emergency medical services as per your need.
")
@section('keywords',"Ambulance Services, Ambulance Service, healthcare, medical, Emergency Ambulance
services, Ambulance Booking App, Ambulance Service near me, online ambulance booking,
24*7 Ambulance Booking Service, ambulance booking service, ambulance tracker app, online
ambulance booking app
")

{{--  @dd($hospital_data)  --}}
<style>
    .selected {
        bacground: green;
    }
</style>

@section('main')
<section class="hospital-list-container header-top-margin">
  <div class="container py-4">
    <div class="row h-100">
        <div class="col-lg-5 h-vh">
            <a href="{{route('check-hospital-service')}}" class="move-page-btn"><i class="fa-solid fa-arrow-left-long mr-auto"></i>
               Previous page
            </a>
           <div class="row mt-4 facility-list-scroll">
    @php
    $selectedFacility = null;
    $otherFacilities = [];

    foreach ($service_data as $facility) {
        if ($facility->hospital_serv_cat_name_sku === $category_name) {
            $selectedFacility = $facility;
        } else {
            $otherFacilities[] = $facility;
        }
    }
    @endphp

    <!-- Display the selected facility at the top -->
    @if($selectedFacility)
    <div class="col-12 mb-3">
        <div class="hospt-facility-box selected">
            <div class="h-facility-icon">
                <img src="https://dev.cabmed.in/{{$selectedFacility->hospital_serv_cat_icon}}" alt="{{$selectedFacility->hospital_serv_cat_name}}">
            </div>
            <div class="facility-details">
                <a class="h-facility-name selected">
                    {{$selectedFacility->hospital_serv_cat_name}}
                </a>
                <span class="h-facility-desc text-left">
                    Check Availability of both AC and Non-AC
                </span>
            </div>
        </div>
    </div>
    @endif

    <!-- Loop through the rest of the facilities -->
    @foreach($otherFacilities as $facility)
    <div class="col-12 mb-3">
<div class="hospt-facility-box" data-sku="{{ $facility->hospital_serv_cat_name_sku }}">
            <div class="h-facility-icon">
                <img src="https://dev.cabmed.in/{{$facility->hospital_serv_cat_icon}}" alt="{{$facility->hospital_serv_cat_name}}">
            </div>
            <div class="facility-details">
                <a href="{{ route('services-category', $facility->hospital_serv_cat_name_sku) }}" class="h-facility-name">
                    {{$facility->hospital_serv_cat_name}}
                </a>
                <span class="h-facility-desc text-left">
                    Check Availability of both AC and Non-AC
                </span>
            </div>
        </div>
    </div>
    @endforeach
</div>
 </div>
 <div class="category-name">
    {{$category_name}}
</div>
        <div class="col-lg-7 avl-hospital-list-container  h-vh">
            <div class="avl-hospital-top-header">
                <span  class="move-page-btn"><i class="fa-solid fa-arrow-left-long mr-auto"></i>
                  Mumbai
                </span>
                <div class="city-div">
                    <i class="fa-solid fa-location-dot"></i><span id="city-name"></span><button href=""><i class="fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#citySearchModal"></i></button>
                </div>
            </div>
            <div class="search-bar">
                <div class="search-div">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search Hospital Here" name="search-city-name" id="facility-search">
                </div>
            </div>  
            <div class="hospital-filter-btn-group">
                <button class="fliter-btn all">All</button>
                <button class="fliter-btn iwv">ICU with Ventilator</button>
                <button class="fliter-btn iwov">ICU without Ventilator</button>
            </div>
            <div class="row avl-hospital-list">
                <div class="col-12">
                    <div class="avl-hospital-box">
                        <div class="avl-bed-div">
                            <div class="avl-bed">
                                <div class="green-text"><i class="fa-solid fa-circle"></i>Availabe:<span class="text-black">6 beds</span></div>
                            </div>
                            <div class="fav-hosp-icon">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>
                        <div class="avl-hospital-details">
                            <div class="avl-hospital-icon">
                                <!--<img src="" alt="">-->
                            </div>
                            <div class="avl-hospital-name-dis">
                           <br/>5kmkm away 
                            </div>
                            <div class="avl-hospital-contact">
                                <a href="tel:108"><i class="fa-solid fa-phone"></i>45 45351 35155</a>
                            </div>
                        </div>
                        <div class="avl-hospital-location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Estimate time  to reach lorem episum sjdfefef fsfg jerfjrngjrn hdfhruihfr </span>
                        </div>
                        <div class="hospital-btn-group">
                            <button class="hospital-btn" id="book-btn">Book Ambulance</button>
                            <button class="hospital-btn" id="call-btn">Call Hospital</button>
                            <button class="hospital-btn" id="direction-btn">Direction</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>

    
<!-- City Search Modal start -->
<div class="modal fade" id="citySearchModal" tabindex="-1" role="dialog" aria-labelledby="citySearchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="citySearchModalLabel">Search City</h5>
        <button type="button" class="close bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white fw-bold fs-4">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- City search form -->
        <form>
          <div class="form-group">
            <label for="cityInput">Search City:</label>
            <input type="text" class="form-control" id="cityInput" Autocomplete="off" placeholder="Search city Here">
            <input type="text" class="form-control d-none" id="cityid" >
          </div>
          <div class="city-list">

          </div>
        </form>
      </div>
   
    </div>
  </div>
</div>
<!-- City Search Modal end-->
 <div class="footer-download mt-5 container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-2 hidden-sm">
            <img src="{{asset('assets/image/app-page-2.png')}}" alt="Mobile App Screenshot">
        </div>
        <div class=" col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <div class="download-footer-right">
                <span class="download-footer-head-text">
                    To Check Hospitals’
                    Facilities Availability Online
                </span>
                <div class="footer-img-div">
                    <span class="download-footer-text mb-3">
                        Download MedCab App
                    </span>
                    <div class="download-link-img">
                        <img src="{{asset('assets/image/App-Store-dark.png')}}" alt="Apple Store Icon">
                        <img src="{{asset('assets/image/Google-Play-dark.png')}}" alt="Google Store Icon">
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div> 
</section>

<script>


// filter facility
$('#facility-search').on('keyup',function(e){
        e.preventDefault();

        let facility = $(this).val();
        let city=$('#city-name').text();
        //var url="{{URL::to('/hospital-facility/filter-available-hospital-facility/')}}";
        if(facility!="")
        {
            $.ajax({
                url:url,
                type:"POST",
                data:{facility_search:facility,city:city},
                success:function(facResponse){ 
                    $('.facility-container').html(facResponse.facilities);
                    // console.log(facResponse);
                },
                error: function(facResponse) {
                    console.log(facResponse);
                },
            });
        }
    });

</script>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Highlight and check the anchor tag based on the URL parameter -->
<script>
    $(document).ready(function () {
        var categoryParam = "{{ $category_name }}"; // Get the category name parameter from the URL
        
        if (categoryParam) {
            $('.hospt-facility-box[data-sku="' + categoryParam + '"]').addClass('selected');
            $('.h-facility-name[data-sku="' + categoryParam + '"]').addClass('selected');
        }
    });
</script>
<script>
    $(document).ready(function () {
        // Get the category SKU you want to hover over
        var categoryToHover = "{{ $category_name }}"; // Replace with the actual SKU

        // Find the facility box with the specific category SKU and trigger hover
        var facilityToHover = $('.hospt-facility-box[data-sku="' + categoryToHover + '"]');
        facilityToHover.addClass('hovered');

        // Other JavaScript code...
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
            var pathname = window.location.pathname;
            let hospitalSku2 = pathname.replace('hospital-services/','');
            let hospitalSku =  hospitalSku2.replaceAll('/', '');
            if ("geolocation" in navigator) {
                navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                    if (permissionStatus.state === 'granted') {
                        // Permission already granted, proceed to get location
                        getLocationAndRedirect(hospitalSku);
                    } else if (permissionStatus.state === 'prompt') {
                        // Request permission
                        navigator.geolocation.getCurrentPosition(function() {
                            getLocationAndRedirect(hospitalSku);
                        }, function(error) {
                            console.error("Error getting location:", error);
                        });
                    } else {
                        console.log("Geolocation permission denied.");
                    }
                });
            } else {
                console.log("Geolocation is not available in this browser.");
            }
        
        function getLocationAndRedirect(hospitalSku) {

            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                                
                $.ajax({
                    url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                      var cityName = response.address.city;
                 var redirectTo = "{{ route('services-category-city', ['category_name' => ':category_name', 'city' => ':city']) }}";
               redirectTo = redirectTo.replace(':category_name', hospitalSku).replace(':city', cityName);
                        //alert(redirectTo);
                        
                   $.ajax({
                    url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var cityName = response.address.city;
                        
                        var redirectTo = "{{ route('services-category-city', ['category_name' => ':category_name', 'city' => ':city']) }}";
                        redirectTo = redirectTo.replace(':category_name', hospitalSku).replace(':city', cityName);
        
                            $.ajax({
                                url: redirectTo,
                                method: 'GET',
                                data: {
                                    latitude: latitude,
                                    longitude: longitude,
                                    hospital_serv_cat_name_sku: hospitalSku,
                                    city: cityName
                                }, 
                                success: function(data) {
                                    // Handle success here
                                },
                                error: function(error) {
                                    console.error("Error sending data to controller:", error);
                                }
                            });
                        },
                        error: function(error) {
                            console.error("Error performing reverse geocoding:", error);
                        }
                    });

                    },
                    error: function(error) {
                        console.error("Error performing reverse geocoding:", error);
                    }
                });
            }, function(error) {
                console.error("Error getting location:", error);
            });
        }
    });
</script>


@endsection
