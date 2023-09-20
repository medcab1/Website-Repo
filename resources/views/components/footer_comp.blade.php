<!-- footer -->
@php
$cityData = DB::table('city_content')
->get();


$CategoryData = DB::table('ambulance_category')
->get();
@endphp
<footer class="footer">
    <section class="d-flex flex-column align-items-center">
        <div class="cityNames d-flex flex-column w-100 py-4 border-bottom ">
            <div class="d-flex justify-content-between w-100">
                <div class="cities d-flex flex-column w-100">
                    <div id="hideShow">


                        <p class="secondary-text text-justify"><span class="secondary-text fw-bold">AVAILABLE IN </span>
                            @foreach ($cityData as $city_data)
                            <a href="{{route('CityContent',['title'=>$city_data->city_name])}}" target="_blank">
                                {{ $city_data->city_name }} |
                            </a>
                            @endforeach
                        </p>
                    </div>
                    <button onclick="show()" id="hideShowBtn" class="btn text-white shadow-none secondary-text" type="button" data-bs-toggle="collapse" data-bs-target="#cityCollapse" aria-expanded="false" aria-controls="cityCollapse">Show more</button>
                </div>
            </div>
        </div>
        <div class="bookAmbulance d-flex flex-column align-items-center py-4 w-100 border-bottom">
            <div>
                <h6 class="primary-text fw-bold py-3 text-center">BOOK AMBULANCE</h6>
            </div>
            <div class="bookAmbulance-content">
                @foreach ($CategoryData as $category)
                <a href="">{{ $category->ambulance_category_name }} |</a>
                @endforeach
            </div>

        </div>
        <div class="info w-100 d-flex flex-column py-4 border-bottom">
            <div class="show mb-2">
                @foreach ($cityData as $city_data)  
                <h6 class="infoCard secondary-text">Ambulances in {{$city_data->city_name}}
                    
                </h6>
                @endforeach
            </div>
            <!-- <button onclick="showMoreInfo()" id="infoBtn" class="btn text-white text-none shadow-none secondary-text" type="button" data-bs-toggle="collapse" data-bs-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">Show more</button> -->
        </div>
        <div class="downloadApp d-flex w-100 py-4 border-bottom justify-content-between">
            <div class="buttons">
                <button class="btn shadow-none"><img src="{{ asset('assets/website-images/playBtn.png') }}" alt="play store"></button>
                <button class="btn shadow-none"><img src="{{ asset('assets/website-images/appBtn.png') }}" alt="app Store"></button>
            </div>
            <div class="socials d-flex gap-3 align-items-center justify-content-end gap-1 py-4">
                <img src="{{ asset('assets/website-images/icons/facebook.png') }}" alt="Facebook">
                <img src="{{ asset('assets/website-images/icons/linkedin.png') }}" alt="linkedin">
                <img src="{{ asset('assets/website-images/icons/insta.png') }}" alt="insta">
                <img src="{{ asset('assets/website-images/icons/linkedin.png') }}" alt="linkedin">
                <img src="{{ asset('assets/website-images/icons/twitter.png') }}" alt="twitter">
            </div>
        </div>
        <div class="contact d-flex justify-content-center w-100 py-4 border-bottom">
            <p class=""><span><a href="{{URL::route('ContactUs')}}">Contact Us |</a><a href="{{URL::route('Term&Condition')}}"> Terms of Use |</a><a href="{{URL::route('Customer.Privacy&Policy')}}"> Privacy
                        Policy |</a><a href="{{URL::route('Customer.Cancel&Refund')}}"> Refund
                        Policy |</a><a href="{{URL::route('Service_Level_Agreement')}}"> Service Legal Agreement for Vendor/ Driver
                        |</a><a href="">
                        Career |</a><a href=""> Mobile
                        App |</a><a href=""> Media
                        Coverage |</a><a href=""> B2B
                        Partner</a></span></p>
        </div>
        <div class="address d-flex w-100 py-4 border-bottom justify-content-center">
            <div class="elem d-flex align-items-center">
                <img src="{{ asset('assets/website-images/icons/location.png') }}" alt="loc">
                <p> 2/141 Vishal Khand Gomti Nagar, Lucknow, Uttar Pradesh, 226010</p>
            </div>
            <div class="elem d-flex align-items-center">
                <img src="{{ asset('assets/website-images/icons/call.png') }}" alt="call">
                <p> 8755672479</p>
            </div>
            <div class="elem d-flex align-items-center">
                <img src="{{ asset('assets/website-images/icons/mail.png') }}" alt="mail">
                <p> info@medcabprivatelimited.com</p>
            </div>
        </div>
        <div class="copyright  d-flex align-items-center justify-content-center w-100 py-4">
            <p class="text-center">Copyright 2022 Medcab Care Private Limited</p>
        </div>
    </section>
</footer>
<!-- end footer area -->