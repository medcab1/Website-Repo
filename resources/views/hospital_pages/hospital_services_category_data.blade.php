
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
        <div class="col-lg-7 avl-hospital-list-container  h-vh">
            <div class="avl-hospital-top-header">
                <span  class="move-page-btn"><i class="fa-solid fa-arrow-left-long mr-auto"></i>
                    ICU Availability 
                </span>
                <div class="city-div">
                    <i class="fa-solid fa-location-dot"></i><span id="city-name">Mumbai</span><button href=""><i class="fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#citySearchModal"></i></button>
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
                                <div class="green-text"><i class="fa-solid fa-circle"></i>Available:<span class="text-black">6 Beds</span></div>
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
                             Hospital Name Lorem Ipsum<br/>2.5km away 
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
        <form id="addressForm" method="POST">
            @csrf
            <input type="hidden" name="category_name" value="{{ $category_name }}">
            <div class="form-group">
                <label for="addressInput">Search City:</label>
                <input type="text" class="form-control" id="search" name="city_name" placeholder="Search for an address">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
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
        $('#citySearchModal').modal('show'); // Show the modal on page load
    });
</script>
  <!-- Include Bootstrap Typeahead plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
    var path = "{{ route('search-city') }}";

    $('#search').typeahead({
        source: function (query, process) {
            return $.get(path, {
                query: query
            }, function (data) {
                return process(data);
            });
        },
        updater: function (item) {
            var cityInfo = item.split(' (');
            var cityID = cityInfo[1].slice(0, -1);
            
            $('#search').val(cityInfo[0].trim());
            $('#city_id').val(cityID);
            
            // Additional code to handle selection if needed
            return cityInfo[0].trim();
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addressForm').submit(function(event) {
            event.preventDefault();

            // Get the entered city name from the input field
            var cityName = $('#search').val();
            var category_name = $('[name="category_name"]').val();

            // Construct the dynamic URL based on the form values
            var actionUrl = "{{ route('services-category-city', [':category_name', ':city_name']) }}";
            actionUrl = actionUrl.replace(':category_name', category_name).replace(':city_name', cityName);

            // Update the form action URL
            $(this).attr('action', actionUrl);

            // Submit the form
            this.submit();
        });
    });
</script>
@endsection
