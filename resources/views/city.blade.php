
@extends('layouts.adminlayout')
@section('title')<?php echo $city->city_meta_title;?>@endsection
@section('description'){!!$city->city_meta_desc!!}@endsection
@section('keywords')<?php echo $city->city_meta_keyword;?>@endsection

@section('main')
<!-- City page top section -->
<section class="city-section">
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            
           
            <div class="col-sm-12 col-md-6 p-0">
                <div class="city-top-img">
                    <img src="https://madmin.cabmed.in/{{$city->city_thumbnail}}" alt="{!!$city->city_name!!}" class="bg-light w-100 h-100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                <div class="city-top-text">
                    <h1 class="title-text">{!!$city->city_title!!}</h1>
                    <p class="p-text">
                    MedCab is a leading ambulance service provider in {!!$city->city_name!!} that has been serving the city and surrounding areas for a long time.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- City page top section -->

<!-- Book Now -->
<section class="book-now">
    <div class="container ">
        <h1 class="title-text text-white text-center" style="margin-bottom:80px;">To BOOK an Ambulance NOW!</h1>
        <div class="row gy-3">
            <div class="col-md-5">
                <div class="book-by-download book-now-box">
                    <div class="book-icon">
                        <img src="{{url('assets/image/download.png')}}" alt="Download  image">
                    </div>
                    <h3 class="">Download</h3>
                    <h3 class="">MedCab App</h3>
                    <div class="download-group-btn">
                        <a href="https://play.google.com/store/apps/details?id=com.medcab.consumer"><img src="{{url('assets/image/google-bg-black.png')}}" alt="Google Play Store"></a>
                        <a href="https://apps.apple.com/in/app/medcab-partner/id6448983664"><img src="{{url('assets/image/apple-bg-black.png')}}" alt="App Store"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="book-now-box h-100">
                    <h3 class=" text-white">OR</h3>
                </div>
            </div>
            <div class="col-md-5">
                <div class="book-by-call book-now-box">
                    <div class="book-icon">
                        <img src="{{url('assets/image/phone.png')}}" alt="Phone Image">
                    </div>
                    <h3 class="">Call</h3>
                    <h3 class="">+91 0522-351-2772</h3>
                    <a href="">
                        <span class="call-icon ml-auto"><i class="fa-solid fa-phone"></i></span> <span>Call Now</span>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>
<div class="container">
        <div style="margin-top:120px;" class="blog-content-text">
            <h3 class="sub-title-800 text-center">{!!$city->city_heading!!}</h3>
            <p class="p-text" style="margin-bottom:40px;">
            {!!$city->city_body_desc!!}
            </p>    
        <!-- </div>
     
        <div style="margin-top:120px;" class=""> -->
            <h3 class="sub-title-800 text-center">{!!$city->city_block1_heading!!}</h3>
            <div class="blog-content-text" style="margin-bottom:40px;">
            {!!$city->city_block1_body!!}
            </div>
        </div>
        <div style="margin-top:120px;" class="">
            <h3 class="sub-title-800 text-center">How to Book an Ambulance in {!!$city->city_name!!}?</h3>
            <p class="p-text" style="margin-bottom:40px;">
            MedCab is revolutionizing the ambulance booking process by providing an easy-to-use app and website. With just a few clicks, you can book an ambulance and rest assured that we will reach you quickly. Our platform also provides you with all the necessary information about our services, ensuring a hassle-free experience.           
            </p>    
        </div>
         <div style="margin-top:120px;margin-bottom:120px;" class="booking-step-city">
            <h3 class="sub-title-800 text-center ">Call Us to Book an Ambulance</h3>
            <p class=" p-text">Here's how you can call an ambulance for booking in {!!$city->city_name!!} with us:</p>
            <p class="p-text">
               <button class="step-btn">Step 1</button>Call our emergency ambulance number in {!!$city->city_name!!} 18008-908-208 or visit our website Medcab.in         
            </p>  
            <p class="p-text">
               <button class="step-btn">Step 2</button>Provide the necessary details, including the patient's name, address and condition.         
            </p> 
            <p class="p-text">
               <button class="step-btn">Step 3</button>Our team will assess the situation and dispatch the nearest ambulance equipped with the necessary medical equipment.        
            </p> 
            <p class="p-text">
               <button class="step-btn">Step 4</button> Our trained medical staff will provide the patient with the best possible care and transport them safely to the hospital.         
            </p> 
            <p class="p-text">
               <button class="step-btn">Step 5</button> Payment can be made through various modes, including cash, debit/credit card and online transfer.        
            </p>  
            <p class="p-text">
            At MedCab, we understand the importance of prompt and efficient medical assistance in an emergency. That's why we ensure that our ambulance services are available 24/7 and our response time is among the quickest in {!!$city->city_name!!}. Trust MedCab for safe and reliable ambulance service Don't hesitate to call MedCab in case of a medical emergency. We are always ready to serve and ensure that you receive the best medical attention.
            </p> 
        </div>
</div>
<!-- Book Now -->

<!-- How to book -->
<section class="how-to-book">
    <div class="container">
        <h1 class="title-text text-center">
         How to Book on MedCab App
        </h1>
        <div class="booking-step-city">
            <p class="p-text mb-5">
               <button class="step-btn">Step 1</button>Download the MedCab App from the App Store or Google Play Store.         
            </p>  
            <p class="p-text mb-5">
               <button class="step-btn">Step 2</button>Register your account by providing the required details.         
            </p>
            <div class="row w-100 d-flex m-0 mb-5 justify-content-center gy-4 gx-3">
                <div class="col-lg-3">
                    <div class="booking-step-img w-100">
                        <img src="{{url('assets/image/step3.png')}}" class="w-100" alt="Booking Step-1">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="booking-step-img w-100">
                        <img src="{{url('assets/image/step4.png')}}" class="w-100" alt="Booking Step-2">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="booking-step-img w-100">
                        <img src="{{url('assets/image/step5.png')}}" class="w-100" alt="Booking Step-3">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="booking-step-img w-100">
                        <img src="{{url('assets/image/step6.png')}}" class="w-100" alt="Booking Step-4">
                    </div>
                </div>
            </div> 
            <h3 class="sub-title text-white mb-4">After Booking:</h3>
            <ul class="p-2">
                <li>
                    You will receive a confirmation message along with the estimated time of arrival (ETA) of the ambulance. 
                </li>
                <li>
                    You can track the ambulance in real-time on the app until it reaches your location. Once the ambulance arrives, the medical staff will provide immediate assistance and transport you to the hospital.
                </li>
                <li>
T                   hat's it! By following these simple steps, you can quickly and easily book an ambulance in {!!$city->city_name!!} through the MedCab App and receive prompt medical assistance when you need it the most.
                </li>
            </ul>
          
        </div>
    </div>
</section>
<!-- How to book -->

<!-- Why Choose use Start-->
<section class="choose-us">
    <div class="container">
        <div class="choose-us-container">
            <h1 class="title-text  mb-5 text-center">Why Choose Us</h1>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose1.png')}}" alt="Affordable" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">Affordable</h3>
                            <p class="p-text" style="text-align:justify;">We offer affordable ambulance services    without compromising on quality. Our
                                transparent pricing ensures that you only pay for the services you need.,
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose2.png')}}" alt="Experienced Staff" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">Experienced Staff</h3>
                            <p class="p-text" style="text-align:justify;">Our certified healthcare professionals have years of experience and state-of-the-art equipment to provide you with top-notch emergency care.
                        </p>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose3.png')}}" alt="Fast Response Time" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">Fast Response Time</h3>
                            <p class="p-text" style="text-align:justify;">Our staff is trained to provide quick and efficient emergency medical
                            services, ensuring that you receive the care you need in a timely manner.
                        </p>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose4.png')}}" alt="24/7 Availability" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">24/7 Availability</h3>
                            <p class="p-text" style="text-align:justify;">Medical emergencies can happen anytime, anywhere. That's why our
                            ambulance services are available 24/7 to respond promptly to your call.
                            </p>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose5.png')}}" alt="GPS-Enabled Tracking" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">GPS-Enabled Tracking</h3>
                            <p class="p-text" style="text-align:justify;">You can track the location of your ambulance in real-time through our
                            GPS-enabled tracking system.
                            </p>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 d-flex-center align-items-start">
                    <div class="choose-box">
                        <img src="{{url('/assets/image/choose6.png')}}" alt="Variety of Ambulance Services" class="choose-img ">
                        <div class="choose-body-desc">
                            <h3 class="sub-title mb-3">Variety of Ambulance Services</h3>
                            <p class="p-text" style="text-align:justify;">We offer a wide range of ambulance services. We have the right
                            ambulance equipped with the latest technology for every medical need.
                        </p>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>
<!-- Why Choose use End-->

<div class="container">
    <div style="" class="blog-content-text">
            <h3 class="sub-title-800 text-center">Expanding Our Reach</h3>
            <p class="p-text" style="margin-bottom:40px;">
            {!!$city->city_block2_body!!}
            </p>
        </div>
        <div class="FAQ" style="margin-top:120px;">
            <h3 class="sub-title-800 text-center">Frequently Asked Questions (FAQs)</h3>
        </div>
        <div class="faq-lists">
            <!-- <div class="faq-box">
                <div class="faq-q">
                    <span class="Q text-white fw-bold">Q</span>
                    <h3 class="faq-que">What payment modes do you accept for booking an ambulance?</h3>
                    <div class="close-btn show">
                        <span></span>
                    </div>
                    <div class="open-btn hide">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <div class="faq-ans show">
                    <div class="A text-white fw-bold">A</div>  
                    <p class="p-text">
                        MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway. MedCab accepts multiple payment modes for booking an ambulance such as cash, credit/debit cards and online wallets. You can also choose to pay through our app or website using a secure payment gateway.
                    </p>   
                </div>
            </div> -->
            <?php for($i =0; $i <= count($faq)-1; $i++){?>
            <div class="faq-box">
                <div class="faq-q">
                    <span class="Q text-white fw-bold">Q</span>
                    <h3 class="faq-que">{{$faq[$i]->city_faq_que}}</h3>
                    <div class="close-btn <?php if($i==0) echo 'show';?>">
                        <span></span>
                    </div>
                    <div class="open-btn <?php if($i==0) echo 'hide';?>">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <div class="faq-ans <?php if($i==0) echo 'show';?>">
                    <div class="A text-white fw-bold">A</div>  
                    <p class="p-text">
                    {{$faq[$i]->city_faq_ans}}
                    </p>   
                </div>
            </div>

            <?php  }?>
        </div>
</div>

<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner --> 

@endsection
