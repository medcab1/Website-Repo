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


<section class="outer-container header-top-margin hospital-availability-already">
    <div class="container hospital-facilities-container py-4">


        <!-- check hospital availability -->
        <section class="hospital-availability-2 grid-container-box section-2 d-flex justify-content-center w-100">
            <div class="facilities gap-3">
                <div class="search-container">
                    <a href="{{route('Home')}}" class="move-page-btn"><i class="fa-solid fa-arrow-left-long mr-auto"></i>
                    </a>
                    <div class="search-bar search-div bg-light">
                        
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input class="bg-light" type="text" placeholder="Search facilities Here" name="search-city-name" id="facility-search">

                    </div>
                </div>

                <div class="grid-container">
                    @foreach ($data as $key)

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
    </div>
    <!-- Button to trigger the modal -->

    <!-- Modal -->
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
                            <input type="text" class="form-control d-none" id="cityid" data-city-id="">
                        </div>
                        <div class="city-list">

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- download availability banner -->
    @include('include.download_availability_banner')
    <!-- download availability banner -->


</section>

<script>
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
                    console.log(response);
                    $("#verify-btn").removeClass('disable-item'); // enable button
                    $("#loginForm")[0].reset();
                },
                error: function(response) {
                    $(".error-message").html(response.message);
                    console.log(response);
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
                        alert(data.message);
                        window.location.replace('{{route("Home")}}');
                    } else {
                        console.log(data);
                        $('#wrong-otp-mess').html(data.message);
                        $('.otp-input').val('');
                        $('.otp-input').css('border-color', '#E42222');
                    }
                },
                error: function(response) {
                    alert(response.message);
                    $(".otp-message").html(response.message);
                    console.log(response);
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
            url: '{{route('login_verification.Resendotp')}}',
            type: 'post',
            data: {
                mob: "{{session('consumer_mob')}}",
            },
            success: function(response) {
                alert('Otp sent successfully');
                console.log(response);
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
                    console.log(regResponse);
                    $("#proceed-btn").prop('disabled', false); // enable button
                    $("#registerForm").html(regResponse.message);
                },
                error: function(regResponse) {
                    alert("name not matched!");
                    $('#name').focus();
                    $(".register-message").append("<br>" + regResponse.message + "<br/>");
                    console.log(regResponse);
                },
            });
        } else {
            alert("Please enter your name");
            $('#name').focus();
            $(".register-message").html("Please enter your name to proceed");
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.check-avl-hospital').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var hospitalSku = $(this).data('sku');

            if ("geolocation" in navigator) {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(permissionStatus) {
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
        });

        function getLocationAndRedirect(hospitalSku) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Perform AJAX for reverse geocoding
                $.ajax({
                    url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var cityName = response.address.city;

                        // Construct the URL for redirection
                        var redirectTo = "{{ route('services-category', ['category_name' => ':category_name']) }}";
                        redirectTo = redirectTo.replace(':category_name', hospitalSku); // Assuming 'hospitalSku' is your category name

                        // Perform AJAX call to the controller with additional data
                        $.ajax({
                            url: redirectTo,
                            method: 'GET',
                            data: {

                                hospital_serv_cat_name_sku: hospitalSku,
                                city: cityName
                            },
                            // latitude: latitude,
                            // longitude: longitude,
                            error: function(error) {
                                console.error("Error sending data to controller:", error);
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