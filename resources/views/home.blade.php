@extends('layouts.adminlayout')
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
@section('main')
<style>
    .sub-btn {
        opacity: 1 !important;
    }

    .disable-item {
        opacity: .6 !important;
        pointer-events: none !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/geolocator/dist/geolocator.min.js"></script>


<!-- Header -->
<header class="header">
    <div class="header-small-hero">
        <h1 class="header-text">
            <span>One Stop Solution</span><br />
            for all of your<br />
            <span>Ambulance Needs</span>
        </h1>
        <div class="header-small-heroImage">
            <img src="{{asset('/assets/website-images/website-gif-final.gif')}}" alt="profile Pic" class="img-fluid">
        </div>
    </div>
    <div class="header-wrapper">
        <div class="header-left">
            <div class="header-booking p-4">
                <div class="booking-option text-white mb-3">
                    <a href="#" class="border-1 rounded-5 active">Emergency</a>
                    <a href="#" class="'border-1 rounded-5">Bulk</a>
                    <a href="#" class="'border-1 rounded-5">Rent</a>
                </div>
                <form class="header-bookingForm">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Pickup Location</label>
                        <div class="input-wrapper">
                            <span>
                                <img src="{{asset('assets/website-images/location.png')}}" alt="" />
                            </span>
                            <input type="text" class="form-control shadow-none outline-none" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Pickup Address Here" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Drop Location</label>
                        <div class="input-wrapper">
                            <span><img src="{{asset('assets/website-images/drop-locatino.png')}}" alt="" /></span>
                            <input type="text" class="form-control shadow-none outline-none" id="exampleInputPassword1" placeholder="Enter Destination Adress here" />
                        </div>
                    </div>
                    <div class="mt-3 booking-submit">
                        <button class="border rounded p-1 booking-time">
                            <span><img src="{{asset('assets/website-images/Access time.png')}}" alt="" /></span>
                        </button>
                        <button type="submit" class="btn">Search Ambulance</button>
                    </div>
                </form>
            </div>
            <div class="header-cta">
                <div class="header-ctaBox mt-4">
                    <span><img src="{{asset('assets/website-images/call.png')}}" alt="" /></span>
                    <a href="#">Call Emergency 18008-908-208</a>
                </div>
                <div class="header-ctaBox mt-4">
                    <span><img src="{{asset('assets/website-images/hospital-cehck.png')}}" alt="" /></span>
                    <a href="#">Check Hospitals Availability</a>
                </div>
            </div>
        </div>
        <div class="header-right">
            <h1 class="header-text">
                <span>One Stop Solution</span><br />
                for all of your<br />
                <span>Ambulance Needs</span>
            </h1>
        </div>
    </div>
    <div class="header-image">
        <img src="{{asset('/assets/website-images/website-gif-final.gif')}}" class="img-fluid" alt="banner" />
    </div>
</header>


<!-- Booking Preview -->
@include('include.book_and_get_ambulance')

<!-- Our Services -->
@include('include.service')
<!-- Our Services -->

<!-- hospital availability -->
@include('include.hospital_availability')
<!-- hospital availability -->


<!-- Why Choose use Start-->
@include('include.why_choose_us')
<!-- Why Choose use End-->

<!-- Booking Steps -->
@include('include.booking_preview')
<!--Booking Steps end  -->

<!--Vedio Section Start-->
@include('include.video')
<!-- Vedio Section End-->

<!-- Review section -->
@include('include.reviews')
<!-- Review Section -->

<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner -->



<!--Schedule booking time Modal start -->
<div class="modal" id="ModalCenter" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title text-secondary" id="exampleModalCenterTitle">Schedule Ambulance</h6>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body ">
                <div class="schedule-box">
                    <div class="input-group mb-2" id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                        </label>
                        <input id="datepicker" type="date" min="<?php echo date('Y-m-d'); ?>" data-date="" data-date-format="DD MMMM YYYY" class="form-control date-input b-none" style="border:none;" placeholder="Select Date" />
                        <label class="dropdown-btn" id="scheduling">
                            <span class="down-chevron-icon ">

                            </span>
                        </label>
                    </div>
                    <div class="input-group mb-2 " id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                        </label>
                        <input id="timepicker" type="time" min="<?php echo date('H:i:s'); ?>" class="form-control date-input b-none" style="border:none;" />
                        <label class="dropdown-btn" id="scheduling">
                            <span class="down-chevron-icon ">

                            </span>
                        </label>
                    </div>
                    <p class="text-secondary">Book in Advance - Schedule your Date and Time</p>
                </div>
            </div>
            <div class="modal-footer flex-nowrap border-0">
                <button type="button" class="m-btn medcab-btn-transparent" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="m-btn w-100 medcab-btn" id="confirm-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Schedule booking time Modal end -->

<!-- Login Modal start -->

<div class="modal varification-model p-4" id="login" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="login-header">
                    <img alt="Medcab" src="assets/image/logo.png" id="popup-header" style="height:30px; width:auto">
                    <h6 class="modal-title text-secondary"></h6>
                </div>
                <button type="button" class="modal-close close" style="font-size:1.5rem;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;font-size:1.rem!important;">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form method="post" class="login-form" id="loginForm">
                    <input type="text" name="tokens" id="tokens" hidden content="{{csrf_token()}}">
                    <div class="form-group p-relative w-100">
                        <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                        <input type="tel" id="phone" class="form-control " maxlength="10" onkeypress="return onlyNumberKey(event)" name="phoneNO" onload="focusInputElement('phone')" placeholder="Enter Your Mobile number" autofocus>
                        <span class="text-danger error-message" id="login-message">
                            @error('phone')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                        <input type="submit" class="sub-btn  nextBTn disable-item" id="verify-btn" Value="Verify">
                    </div>
                </form>
                <form method="post" class="login-form" id="registerForm">
                    <input type="text" name="tokens" id="reg_tokens" hidden content="{{csrf_token()}}">
                    <div class="form-group p-relative w-100">
                        <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                        <input type="text" id="name" class="form-control " oninput="inputCharacterOnly(this)" name="name" onkeypress="return onlyCharacters(event)" placeholder="Enter Your Name" onload="focusInputElement('name')">
                        <span class="text-danger error-message" id="register-message"></span>
                    </div>
                    <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                        <input type="submit" class="sub-btn  nextBTn disable-item" id="proceed-btn" Value="Proceed">
                    </div>
                </form>
                <form method="post" class="login-form" id="otpForm">
                    <input type="text" name="tokens" id="otp_tokens" hidden content="{{csrf_token()}}">
                    <div class="form-group p-relative w-100">

                        <!-- <input type="tel" id="otp" class="form-control "  onkeypress="return onlyNumberKey(event)" name="otp" placeholder="Enter 6 digit OTP" autofocus> -->
                        <span class="text-danger error-message" id="otp-message" style="display:none;">Otp Message</span>
                    </div>
                    <div class="m-auto" style="width:fit-content;">
                        <label for="exampleDropdownFormPassword1" class="text-center font-18 font-700 d-block mb-3">
                            Please enter OTP sent to
                        </label>
                        <label for="exampleDropdownFormPassword1" class="text-center font-16 font-600 d-block mb-3">

                            @if(Session::has('consumer_mob'))
                            {{"+91 ".Session::get('consumer_mob')}}
                            @endif
                        </label>
                        <div class="otp-input-container input-field" style="">
                            <input type="number" class="otp-input" id="otp-input-1" style="">
                            <input type="number" class="otp-input" id="otp-input-2" disabled>
                            <input type="number" class="otp-input" id="otp-input-3" disabled>
                            <input type="number" class="otp-input" id="otp-input-4" disabled>
                            <input type="number" class="otp-input" id="otp-input-5" disabled>
                            <input type="number" class="otp-input" id="otp-input-6" disabled>

                            <!-- <input type="number" />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled /> -->

                        </div>
                        <label for="" id="wrong-otp-mess" class=" font-400 font-16 mt-3 d-block text-danger">
                        </label>
                        <a id="resend-otp" class=" font-400 font-16 mt-3 d-block text-danger">

                        </a>
                        <label for="" id="counter" class=" font-400 font-16 mt-3 d-block">
                            Resend OTP in <span class=" font-700 font-18 text-gn-sndy" id="otp-timer">30</span> sec
                        </label>
                    </div>
                    <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                        <input type="submit" class="sub-btn  nextBTn " id="otp-btn" Value="Verify OTP">
                    </div>

            </div>
            {{session()->get('consumer_name')}}
            </form>
        </div>
    </div>
</div>
</div>
</div>

<!-- Login Modal end -->
<div id="map" style="height:300px;width:100%;display:none;"></div>

<div id="toastContainer">
    <div id="toast" class="alert alert-success hidden">
        This is a notification message.
    </div>
</div>

<script>
    $(document).ready(function() {



        showToast("Book an ambulance for ambulance 24*7!");
        $('.duration-group').click(function() {
            $('#rentalTimePeriod').modal('show');
        });
        $(".duration-select-box").hide();
        $('#hours').show();
        $('#normal').prop('checked', true);
        $(".booking-period-radio").change(function() {
            var data_id = $(this).attr('data-id');
            $('.duration-select-box').hide();
            $('#' + data_id).show();

        });

        function getLatLng(address, lat_id, lng_id) {
            var geocoders = new google.maps.Geocoder();
            geocoders.geocode({
                    'address': pickup
                },
                function(result, status) {
                    var location = [];
                    var lat = result[0].geometry.location.lat();
                    var lng = result[0].geometry.location.lng();
                    location.push({
                        'lat': lat
                    });
                    location.push({
                        'lng': lng
                    });
                    $('#' + lat_id).val(lat);
                    $('#' + lng_id).val(lng);
                    // console.log(location);

                }
            );
        }

        function nearBySearchList(lat, lng) {
            if (lat != "" && lng != "") {
                var pyrmont = new google.maps.LatLng(lat, lng); // sample location to start with: Mumbai, India
                mapp = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15
                });
                var request = {
                    location: pyrmont,
                    radius: 5000,
                    types: ['hospital', 'clinic'] // this is where you set the map to get the hospitals and health related places
                };
                var service = new google.maps.places.PlacesService(mapp);
                service.nearbySearch(request, funCallback);
            }
        }

        function funCallback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                var arr = [];
                for (var i = 0; i < 5; i++) {
                    var usr = {};
                    usr.name = results[i].name;
                    usr.lat = results[i].geometry.location.lat();
                    usr.lng = results[i].geometry.location.lng();
                    usr.vicinity = results[i].vicinity;
                    arr.push(usr);
                }
                // console.log(arr);
                return arr;
            }

        }
        //bugs solved
        $('#rentalTimePeriod').on('shown.bs.modal', function(e) {
            if ($("#by-day").is(":checked")) {
                $("#by-hour").prop("checked", true);
            }
        });
        //bugs solved ends
        $('#submit-btn').click(function() {

            drop = $('#drop').val();
            pickup = $('#pickup').val();
            if (drop != "" && pickup != "") {
                $('#loc-form').submit();
            } else if (pickup != '' && !$('.drop-form-group').is(':visible')) {
                $('#loc-form').submit();
            } else if (pickup != "" && drop == "") {
                alert("Please enter your drop location for booking!");
                return false;
            } else if (pickup == "" && drop != "") {
                alert("Please enter your pick-up location for booking!");
                return false;
            } else {
                alert("Please enter your location for booking!");
                return false;
            }

        });

        $('#schedule-now').on('click', function() {
            $('#ModalCenter').modal('toggle');
            alert("show model");
        });
        $('#lat').val("done");
        var pickUp_autocomplete = new google.maps.places.Autocomplete((document.getElementById('pickup')), {
            types: ['geocode'],
        });
        pickUp_autocomplete.setComponentRestrictions({
            'country': ['in']
        });

        pickUp_autocomplete.addListener('place_changed', function() {
            var place = pickUp_autocomplete.getPlace();

            if (place.geometry) {
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#lat').val(latitude);
                $('#lng').val(longitude);
            }
        });


        var drop_autocomplete = new google.maps.places.Autocomplete((document.getElementById('drop')), {
            types: ['hospital'],
        });
        drop_autocomplete.setComponentRestrictions({
            'country': ['in']
        });
        drop_autocomplete.addListener('place_changed', function() {
            var place = drop_autocomplete.getPlace();

            if (place.geometry) {
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#drop_lat').val(latitude);
                $('#drop_lng').val(longitude);
                // console.log("Drop Latitude: " + latitude);
                // console.log("Drop Longitude: " + longitude);
            }
        });



        // Getting and setting Current location(name) to drop input 
        $('#current_location').click(function() {
            $('#drop').prop('disabled', false);
            $(this).hide();
            $('.reset-input').show();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            // console.log(position);
            var val_lat = parseFloat(position.coords.latitude);
            var val_lng = parseFloat(position.coords.longitude);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                },
                zoom: 6,
            });
            initialize(val_lat, val_lng);
            var infoWindow = new google.maps.InfoWindow();
            const geocoder = new google.maps.Geocoder();
            geocodeLatLng(geocoder, val_lat, val_lng);
        }

        function geocodeLatLng(geocoder, val_lat, val_lng) {
            const latlng = {
                lat: val_lat,
                lng: val_lng
            };
            geocoder.geocode({
                location: latlng
            }).then((response) => {
                $('#pickup').val(response.results[0].formatted_address);
                // console.log(response.results[0]);
            })

        }

        var mapp;
        var initmap;

        function initialize(latitude, longitude) {
            // alert("initialize");
            if (latitude != "" && longitude != "") {
                var pyrmont = new google.maps.LatLng(latitude, longitude); // sample location to start with: Mumbai, India
                mapp = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15
                });
                var request = {
                    location: pyrmont,
                    radius: 5000,
                    types: ['hospital', 'clinic'] // this is where you set the map to get the hospitals and health related places
                };
                $('#lat').val(latitude);
                $('#lng').val(longitude);
                var service = new google.maps.places.PlacesService(mapp);
                service.nearbySearch(request, callback);
            }
        }

        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                var arr = [];
                var p_lat = $('#lat').val();
                var p_lng = $('#lng').val();
                for (var i = 0; i < 5; i++) {
                    createMarker(results[i]);
                    var d_lat = results[i].geometry.location.lat()
                    var d_lng = results[i].geometry.location.lng()
                    var dis = distance(p_lat, p_lng, d_lat, d_lng);
                    var usr = {};
                    usr.name = results[i].name;
                    usr.drop_lat = d_lat;
                    usr.drop_lng = d_lng;
                    usr.vicinity = results[i].vicinity;
                    usr.distance = dis.toFixed(3);
                    // console.log(usr.distance);
                    arr.push(usr);
                }
                showList(arr, results);
            }
        }

        function showList(placelist, results) {
            $('.popup-box').html('');
            $('.right-box').html('');
            var i = 1;
            for (var place in placelist) {
                var formated_address = placelist[place].name.concat(' ', placelist[place].vicinity);
                // console.log(placelist[place].name.replace("'",'\''));
                var places = "<div class='hospital-name' id='name-" + i + "' value='" + placelist[place].name.replace("'", '\'').concat(' ', placelist[place].vicinity) + "' onclick='myFunction(this)'  d_lat='" + placelist[place].drop_lat + "' d_lng='" + placelist[place].drop_lng + "' > <img alt='Hospital-Icon' src='" + results[2].icon + "'/><span><b>" + placelist[place].name + "</b><br/>" + placelist[place].vicinity + "</span></div>";
                // console.log(placelist[place].name.concat(' ',placelist[place].vicinity));
                var place_box = " <div class='col-xs-12 col-sm-6 pt-2 pb-2'>" +
                    "<div class='suggestion-card hospital-name card p-2'>" +
                    "<span d_lat='" + placelist[place].drop_lat + "' d_lng='" + placelist[place].drop_lng + "'>" + placelist[place].name + "<br/>" + placelist[place].vicinity + "</span>" +
                    "</div>" +
                    "</div>";
                $('.suggestion-box.right-box').append(place_box);
                $('.popup-box').append(places);
                i++;
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map: mapp,
                position: place.geometry.location,
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(mapp, this);
            });
        }

        function get_location(pickup) {
            if ($('#pickup').val() != '') {
                var geocoder = new google.maps.Geocoder();
                var address = $('#pickup').val();
                geocoder.geocode({
                    'address': pickup
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var pick = {};
                        pick['pick_lat'] = results[0].geometry.location.lat();
                        pick['pick_lng'] = results[0].geometry.location.lng();
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        $('#lat').val(latitude);
                        $('#lng').val(longitude);
                    }
                    initialize(latitude, longitude);
                });
            }
        }

        $('.reset-input').click(function() {
            $('#pickup').val('');
            $('#drop').prop('disabled', true);
            $(this).hide();
            $('#current_location').show();
            // $('#suggestion').hide();
            $('#popup_sugg').hide();
            $('.suggestion').hide();
            $('#map').html('');
            initialize("", "");
        });

        $('#pickup').click(function() {
            $('#current_location').show();
            $('.reset-input').hide();
            $(this).val('');
            $('#map').html('');
            $('.right-box').html('');
            $('.popup-box').html('');
        });

        $('.drop-reset-input').hide();
        $('#drop').keyup(function() {
            if ($(this).val() == '') {
                $('.drop-reset-input').hide();
            }
            if ($(this).val() != '') {
                $('.drop-reset-input').show();
            }
        });
        $('.drop-reset-input').click(function() {
            $('#drop').val('');
        });
        $('#drop').click(function() {
            $('.drop-reset-input').show();
            if ($(this).val() != '') {

            }
            pickup = $('#pickup').val();
            drop = $('#drop').val();
            if (pickup != '') {
                get_location(pickup);
                $('#popup_sugg').show();
            } else if (pickup != "" && drop != "") {
                $('#drop').val('');
                alert("enter your drop location");
            } else {
                alert($('#pickup').val() + "Please Enter Pick Up address first!");
            }
        });

        $('#drop').keydown(function() {
            $("#popup_sugg").hide();
        });

        $('#pickup').keyup(function() {
            if ($(this).val() != "") {
                // alert('disabled');
                $('#drop').prop('disabled', false);
                $('#current_location').show();
                $('.reset-input').hide();
            } else {
                $('#drop').prop('disabled', true);
            }

            if ($(this).val() != '') {
                $('#current_location').hide();
                $('.reset-input').show();
            }
        });
        $('#pickup').change(function() {
            if ($(this).val() != "") {
                // alert('disabled');
                $('#drop').prop('disabled', false);
            } else {
                $('#drop').prop('disabled', true);
            }
        });

        $('#drop').change(function() {
            $('.drop-reset-input').show();
            let origin = $('#pickup').val();
            let destination = $('#drop').val();
        });

        // Login script start
        const inputs = document.querySelectorAll(".otp-input");
        button = document.querySelector("#otp-btn");

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }

                if (!inputs[5].disabled && inputs[5].value !== "") {
                    return;
                }
                button.classList.remove("active");

            });
        });

        //login submit
        $('#phone').on('change keydown paste input', function() {
            if ($(this).val() != "" && $(this).val().length == 10) {
                $("#verify-btn").removeClass('disable-item'); // enable button
            } else {
                $("#verify-btn").addClass('disable-item'); // enable button
            }
        });

        $('#name').on('change keydown paste input', function() {

            if ($(this).val() != "" && $(this).val().length >= 3) {
                $("#proceed-btn").removeClass('disable-item'); // enable button
            } else {
                $("#proceed-btn").addClass('disable-item'); // enable button
            }
        });
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            let phone = $('#phone').val();
            // alert(phone);
            token = $('#tokens').attr('content');

            if (phone != "") {

                var jsonData = {
                    phone: phone,
                };
                $.ajax({
                    url: "/medcab/booking/login",
                    type: "POST",
                    data: jsonData,
                    beforeSend: function() {
                        $("#verify-btn").prop('disabled', true); // disable button
                    },
                    success: function(response) {
                        $("#phone").focus();
                        if (response.code == 0) {
                            $('#loginForm').css('display', 'none');
                            countdown(30);
                            $('#otpForm').css('display', 'flex');
                        } else if (response.code == 1) {
                            $('#loginForm').css('display', 'none');
                            $('#registerForm').css('display', 'flex');
                            $("#register-message").html(response.message);
                        } else {
                            $(".error-message").html(response.message);
                        }
                        $("#verify-btn").removeClass('disable-item'); // enable button
                        $("#loginForm")[0].reset();
                    },
                    error: function(response) {
                        $(".error-message").html(response.message);
                        //console.log(response);
                    },
                });
            } else {
                alert("Please enter your mobile number");
                $('#phone').focus();
                $(".error-message").html("Please enter your mobile number to proceed");
            }
        });

        //login submit
        $('#otpForm').on('submit', function(e) {
            e.preventDefault();
            var otpInputs = document.getElementsByClassName("otp-input");
            var otpValues = '';
            for (var i = 0; i < otpInputs.length; i++) {
                otpValues = otpValues + otpInputs[i].value;
            }
            let input_otp = parseInt(otpValues);

            $('#otp').focus();
            let token = $('#otp_tokens').attr('content');
            if (input_otp != "") {
                $.ajax({
                    url: "/otp_match",
                    type: "POST",
                    data: {
                        _token: token,
                        otp: input_otp
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $(".otp-message").html(data.message);
                            $("#otp-btn").removeClass('disable-item'); // enable button
                            $("#otpForm").html(data.message);
                            $('#welcome-user').append("<b>" + data.consumer_name + "</b>");
                            // alert(data.message);
                            window.location.replace("{{route('Home')}}");
                        } else {
                            // console.log(data);
                            $('#wrong-otp-mess').html(data.message);
                            $('.otp-input').val('');
                            $('.otp-input').css('border-color', '#E42222');
                        }
                    },
                    error: function(response) {
                        alert(response.message);
                        $(".otp-message").html(response.message);
                        // console.log(response);
                    },
                });
            } else {
                alert("please enter otp for proceed");
                $('#otp').focus();
            }
        });
        //otp verification end


        // resend OTP request start
        $('#resend-otp').click(function(e) {
            alert("{{session('consumer_mob')}}");
            e.preventDefault();
            $.ajax({
                url: "{{route('login_verification.Resendotp')}}",
                type: 'post',
                data: {
                    mob: "{{session('consumer_mob')}}",
                },
                success: function(response) {
                    alert('Otp sent successfully');
                    // console.log(response);
                },
                error: function(response) {
                    alert('Failed to send otp! Please try again.');
                }
            });
        });
        // resend OTP request end
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            token = $('#reg_tokens').attr('content');
            if (name != "") {
                $.ajax({
                    url: "/medcab/booking/registration",
                    type: "POST",
                    data: {
                        _token: token,
                        name: name
                    },
                    beforeSend: function() {
                        $("#proceed-btn").prop('disabled', true); // disable button
                    },
                    success: function(regResponse) {
                        $("#phone").focus();
                        if (regResponse.status == 0) {
                            $('#registerForm').css('display', 'none');
                            $('#otpForm').css('display', 'flex');
                            countdown(30);
                            $("#otp-message").html(regResponse.otp);
                        } else if (regResponse.status == 1) {
                            $('#registerForm').css('display', 'flex');
                            $("#register-message").html(regResponse.message);
                        } else {
                            $(".error-message").html(regResponse.message);
                        }
                        $("#welcome-user").html(regResponse.consumer_name);
                        // console.log(regResponse);
                        $("#proceed-btn").prop('disabled', false); // enable button
                        $("#registerForm").html(regResponse.message);
                    },
                    error: function(regResponse) {
                        alert("name not matched!");
                        $('#name').focus();
                        $(".register-message").append("<br>" + regResponse.message + "<br/>");
                        //console.log(regResponse);
                    },
                });
            } else {
                alert("Please enter your name");
                $('#name').focus();
                $(".register-message").html("Please enter your name to proceed");
            }
        });

        // Login script end


        //calling callback function
        function distance(lat1, lon1, lat2, lon2) {
            var p = 0.017453292519943295; // Math.PI / 180
            var c = Math.cos;
            var a = 0.5 - c((lat2 - lat1) * p) / 2 +
                c(lat1 * p) * c(lat2 * p) *
                (1 - c((lon2 - lon1) * p)) / 2;
            var distance = 12742 * Math.asin(Math.sqrt(a));
            return 12742 * Math.asin(Math.sqrt(a));
            // console.log(distance);
        }
    });


    var elements = document.getElementsByClassName("hospital-name");

    var myFunction = function(e) {
        var drop = e.getAttribute("value");
        // alert('Do You want to conform Drop Location?');
        document.getElementById('drop').value = drop;
        $('#popup_sugg').hide();
        var pickup = $('#pickup').val();
        var drop_lat = e.getAttribute("d_lat");
        var drop_lng = e.getAttribute("d_lng");
        $('#drop_lat').val(drop_lat);
        $('#drop_lng').val(drop_lng);
        //console.log("latitude="+ drop_lat+" longitude="+drop_lng);                 
    }

    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', myFunction, false);
    }

    function calculateDistance(origin, destination) {
        alert('called');
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [origin],
            destinations: [destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
            // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
            avoidHighways: false,
            avoidTolls: false
        }, callback_cal);
    }

    //calling callback function
    function callback_cal(response, status) {
        alert('callback');
        // console.log(response);
        if (status != google.maps.DistanceMatrixStatus.OK) {
            $('#result').html(err);
        } else {
            var origin = response.originAddresses[0];
            var destination = response.destinationAddresses[0];
            if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                $('#result').html("Better get on a plane. There are no roads between " + origin + " and " + destination);
            } else {
                var dis_in_km;
                dis_in_km = response.rows[0].elements[0].distance.value / 1000;
                $("#distance").val(dis_in_km);
                alert(dis_in_km + "call back");
            }
        }
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initMap">
</script>
@endsection                                 