<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ env('APP_BASE_URL') }}assets/image/title_icon.png" type="image"> <!--.ico-->
    <meta property="og:title" content="@yield('title')">
    <meta property="og:site_name" content="Med Cab">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="https://medcab.in/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://medcab.in/assets/image/title_icon.png"> <!--/* 250 * 250-->
    <meta property="og:image:url" content="https://medcab.in/assets/image/title_icon.png"><!--250 * 250 -->
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="250">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:site" content="@medcab_care">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">

    <meta itempprop="name" content="MedCab | Ambulance Service in India"><!-- Title-->
    <meta itemprop="description" content="@yield('description')">
    <meta itemprop="image" content="https://medcab.in/assets/image/title_icon.png"> <!--icon-->

    <link rel="apple-touch-icon" href="https://medcab.in/assets/image/title_icon.png"> <!--56*56-->
    <link rel="apple-touch-icon-precomposed" href="https://medcab.in/assets/image/title_icon.png"> <!--56*56-->
    <link rel="icon" sizes="192x192" href="https://medcab.in/assets/image/title_icon.png"> <!--192*192-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!--Title Icon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/image/title_icon.png') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap .min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" referrerpolicy="no-referrer" />
    <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" />

    <link rel="stylesheet" href="{{ url('vendors/OwlCarousel/assets/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ url('vendors/OwlCarousel/animate.css') }}" />
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- ✅ load jQuery ✅ -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- ✅ load jquery UI ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CM903DJR5V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-CM903DJR5V');
    </script>

    <!-- Facebook  30 June 2023  live -->
    <meta name="facebook-domain-verification" content="gkmkranozdqpn214pnyc49xieh5zfs" />

    <!-- Latest compiled JavaScript -->
    <!-- <link rel="stylesheet" href="{{ url('css/custom.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('css/utill.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('css/responsive.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('css/style.css') }}?<?php echo time(); ?>"> -->


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet" />


    <!-- Crousel Styles -->
    <link rel="stylesheet" href="{{ url('styles/owl-styles/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ url('styles/owl-styles/owl.theme.default.min.css') }}" />

    <!-- Bootstrap:added -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" />

    <!-- new css -->
    <link rel="stylesheet" href="{{ url('styles/nav.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/reset.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/header.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/our-services.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/aboutuss.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/ambulance.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/blogs.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/booking-preview.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/contact.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/download-app.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/footer.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/fs-media.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/grid-container.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/hospital-availability.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/hospitals.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/join-us.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/ourServices.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/reviews.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/section.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/video-preview.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/why-us.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/city_page.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/hosp-service-detail.css') }}?<?php echo time(); ?>">
    <link rel="stylesheet" href="{{ url('styles/blog-detail .css') }}?<?php echo time(); ?>">






    <style>
        #login-solid-btn {
            display: flex !important;
            text-align: center !important;
            justify-content: center !important;
            align-items: center;
            font-family: 'lato';
            padding: 10px;
            width: 120px;
            height: 39px;
            background-color: transparent;
            border: 1px solid #FFFFFF;
            font-weight: 700 !important;
            color: white;
            border-radius: 6px;
            margin-right: 20px;
            cursor: pointer;
        }

        #login-solid-btn:hover {
            background-color: white;
            color: var(--text-red) !important;
            ;

        }

        @media (max-width: 1400px) {
            #login-solid-btn {
                background-color: #c5354f;
                border-color: #c5354f;
                color: white;
            }
        }
    </style>
</head>

<body>


    <!-- Navigation Bar -->
    <!-- ***** Header Area Start ***** -->

    <!-- Navbar : added -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <span>
                    <img src="{{ asset('/assets/website-images/logo.png') }}" class="mb-1" alt="" />
                    <!-- <img src="../images/logo.png" class="mb-1" alt="" /> -->
                </span>
                MedCab</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav d-flex align-items-center me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ URL::route('Home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('OurServices') }}">Our Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Ambulances') }}">Ambulances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Hospitals') }}">Hospitals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('JoinUs') }}">Join Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Blogs') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('AboutUs') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ContactUs') }}">Contact Us</a>
                    </li>
                    <li class="nav-ctn-book">
                        <a class="nav-link rounded bg-white nav-booknow me-lg-2 mb-2 mb-lg-0 px-3 py-1" href="#" tabindex="-1" aria-disabled="true">Book Now</a>
                    </li>
                    <li class="nav-ctn-login text-white">
                        <button type="button" class="btn btn-primary nav-link rounded px-4 py-1 shadow-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#" tabindex="-1" aria-disabled="true">
                            Login
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ***** Header Area End ***** -->
    <!-- Login Modal start -->

    <div class="modal varification-model p-4" id="login" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="login-header">
                        <img alt="Medcab Logo" src="{{ env('APP_BASE_URL') }}assets/image/logo.png" id="popup-header" style="height:30px; width:auto">
                        <h6 class="modal-title text-secondary"></h6>
                    </div>
                    <button type="button" class="modal-close close" style="font-size:1.5rem;" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white;font-size:1.rem!important;">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form method="post" class="login-form" id="loginForm">
                        <input type="text" name="tokens" id="tokens" hidden content="{{ csrf_token() }}">
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
                        <input type="text" name="tokens" id="reg_tokens" hidden content="{{ csrf_token() }}">
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
                        <input type="text" name="tokens" id="otp_tokens" hidden content="{{ csrf_token() }}">
                        <div class="form-group p-relative w-100">

                            <!-- <input type="tel" id="otp" class="form-control "  onkeypress="return onlyNumberKey(event)" name="otp" placeholder="Enter 6 digit OTP" autofocus> -->
                            <span class="text-danger error-message" id="otp-message" style="display:none;">Otp
                                Message</span>
                        </div>
                        <div class="m-auto" style="width:fit-content;">
                            <label for="exampleDropdownFormPassword1" class="text-center font-18 font-700 d-block mb-3">
                                Please enter OTP sent to
                            </label>
                            <label for="exampleDropdownFormPassword1" class="text-center font-16 font-600 d-block mb-3">

                                @if (Session::has('consumer_mob'))
                                {{ '+91 ' . Session::get('consumer_mob') }}
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
                                Resend OTP in <span class=" font-700 font-18 text-gn-sndy" id="otp-timer">30</span>
                                sec
                            </label>
                        </div>
                        <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                            <input type="submit" class="sub-btn  nextBTn " id="otp-btn" Value="Verify OTP">
                        </div>

                </div>
                {{ session()->get('consumer_name') }}
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Login Modal end -->

    <!-- Main Section -->
    @yield('main')
    <!-- End of main section -->

    <!-- Footer Area -->
    <x-footer_comp />
    <!-- end footer area -->

</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('vendors/OwlCarousel/owl.carousel.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
</script> -->
<!-- <script src="{{ url('js/custom.js') }}?<?php echo time(); ?>"></script> -->



<!-- footer -->
<script src="{{ url('js/footer.js') }}?<?php echo time(); ?>"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Owl Crousel -->
<script src="{{ url('js/carousel.js') }}" ?<?php echo time(); ?>"></script>
<script src="{{ url('js/OwlCarousel/owl.carousel.js') }}" ?<?php echo time(); ?>"></script>
<script src="{{ url('js/OwlCarousel/owl.carousel.min.js') }}" ?<?php echo time(); ?>"></script>

</html>