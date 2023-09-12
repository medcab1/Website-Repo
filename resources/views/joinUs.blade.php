@extends('layouts.adminlayout')
@section('title','Join Us - MedCab
')
@section('description',"Join us in our mission to save lives by providing prompt and round the clock Ambulance Service
in India and become our partner in serving humanity.")
@section('keywords',"MedCab, MedCab Join Us, Partner With Us, MedCab Partner")
@section('main')


<!-- join us -->
<!-- Section Join Us top Banner Section -->
<section class="join-us padding">
    <div class="join-us-container">
        <div class="">
            <div class="row gy-4 d-flex-center gap-4 gap-md-0">
                <div class="col-lg-6 col-md-12">
                    <div class="join-top-left d-flex flex-column gap-5">
                        <h1 class="title-text">
                            Join Our Community of Service Providers
                        </h1>
                        <p class="primary-text">Be a Part of Saving Lives Every Minute</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="join-top-right">
                        <div class="join-top-right-img w=100%">
                            <img src="{{asset('assets/website-images/join-us-header.png')}}" width="100%" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="trinity d-flex flex-column flex-lg-row justify-content-around align-items-center py-5 gy-3 join-as-row">
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{asset('assets/website-images/Frame 31843.png')}}" alt="" />
                        </div>
                        <div class="join-info-detail">
                            <h3 class="">Join as <br />Ambulance Driver</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{asset('assets/website-images/Frame 31818.png')}}" alt="" />
                        </div>
                        <div class="join-info-detail">
                            <h3 class="p-text">
                                Join as <br />Ambulance Service Provider (Partner)
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 d-flex-center join-as-col">
                    <div class="join-info-box">
                        <div class="join-info-img">
                            <img src="{{asset('assets/website-images/Frame 31818 (1).png')}}" alt="" />
                        </div>
                        <div class="join-info-detail">
                            <h3 class="p-text">Join as <br />Hospital</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section Join Us top Banner Section -->

<!-- Join Us:As Driver -->
<section class="join-ambulance join-section padding">
    <div class="join-ambu-container container d-flex flex-column">
        <div class="join-ambu-top">
            <div class="join-ambu-top-img">
                <img src="{{asset('assets/website-images/Frame 31843(1).png')}}" alt="" />
            </div>
            <div class="join-ambu-top-desc">
                <h3 class="primary-text">Ambulance Driver</h3>
                <p class="p-text primary-text">
                    Join our platform to experience these benefits:
                </p>
            </div>
        </div>
        <div class="row gy-4 join-ambu-box-container">
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{asset('assets/website-images/Frame 31817.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Earn and Thrive</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Low commission rates for
                            greater earnings
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Real-time earnings tracking and
                            daily payouts
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Access to daily offers and
                            weekly incentives
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{asset('assets/website-images/Frame 31816.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Flexibility and Control</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Choose your own schedule
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Select the types of rides and
                            categories you prefer
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Option for rides that align
                            with your preferred destinations
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Our special feature matches you
                            with riders going in the same direction
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{asset('assets/website-images/Frame 31814.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">24/7 Support and Safety</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Get 24/7 access to our support
                            team for any issues
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>An in-app SOS button for your
                            safety
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Stay informed with new policies
                            and features via in-app notifications
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Track your performance
                            including your acceptance rate and trip ratings
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ambu-box">
                    <div class="join-ambu-box-img">
                        <img src="{{asset('assets/website-images/Frame 31815.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Driver Wellness</h3>
                    <ul class="join-ambu-box-list">
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Your health and safety matter
                            to us
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>View your driving hours to take
                            care of yourself
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Get notifications for break
                        </li>
                        <li class="join-ambu-box-list-item secondary-text">
                            <span class="list-disc"></span>Offer quality services to
                            riders while taking care of yourself
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="button mt-5">Download MedCab Driver App</button>
    </div>
</section>
<!-- Join Us:As Driver -->

<!-- Join Us:As Partner -->
<section class="join-partner join-section padding">
    <div class="join-ptr-container container d-flex flex-column">
        <div class="join-ptr-top">
            <div class="join-ptr-top-img">
                <img src="{{asset('assets/website-images/Frame 31845.png')}}" alt="" />
            </div>
            <div class="join-ptr-top-desc">
                <h3 class="">Ambulance Service Provider</h3>
                <p class="p-text primary-text">
                    Join our platform to experience these benefits:
                </p>
            </div>
        </div>
        <div class="row gy-4 join-ptr-box-container">
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31831.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Real-Time Driver Tracking</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31827.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">
                        Check Driver's On/Off Duty Status
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31825.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">
                        Get Daily/Weekly/Monthly Booking History
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31826.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Check Revenue Reports</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31829.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">
                        Check Driver Assignment History
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-ptr-box">
                    <div class="join-ptr-box-img">
                        <img src="{{asset('assets/website-images/Frame 31856.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">
                        Expand Your Fleet by adding drivers and ambulances
                    </h3>
                </div>
            </div>
        </div>
        <button class="button mt-5">Download MedCab Business App</button>
    </div>
</section>
<!-- Join Us:As Partner -->

<!-- Join Us:As Hospital -->
<section class="join-hospital join-section padding">
    <div class="join-hpl-container container d-flex flex-column">
        <div class="join-hpl-top">
            <div class="join-hpl-top-img">
                <img src="{{asset('assets/website-images/Frame 31844.png')}}" alt="" />
            </div>
            <div class="join-hpl-top-desc">
                <h3 class="">Hospitals</h3>
                <p class="p-text primary-text">Connecting with us allows yours:</p>
            </div>
        </div>

        <div class="row gy-4 join-hpl-box-container">
            <div class="col-md-6">
                <div class="join-hpl-box">
                    <div class="join-hpl-box-img">
                        <img src="{{asset('assets/website-images/Frame 31831.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">Real-Time Driver Tracking</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="join-hpl-box">
                    <div class="join-hpl-box-img">
                        <img src="{{asset('assets/website-images/Frame 31830.png')}}" alt="" />
                    </div>
                    <h3 class="join-box-heading join-us-col-clr">
                        Check Driver's ON/OFF Duty Status
                    </h3>
                </div>
            </div>
            <button class="button mt-5 w-auto">Contact Us</button>
        </div>
    </div>
</section>
<!-- Join Us:As Hospital -->
<!-- join us -->


<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner -->

@endsection