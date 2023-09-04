
@extends('layouts.adminlayout')
@section('title',"About Us | MedCab")
@section('description',"With MedCab, the Best and Fastest Online Ambulance Service is just a tap away, giving you an
advantage when it comes to urgent medical assistance in India.")
@section('keywords',"MedCab, MedCab About us, MedCab Vision, MedCab Mission, ambulance service, ambulance
service provider in India, emergency medical transportation")
@section('main')
<!-- About Us Section Start -->
    <section class="about-section">
        <div class="container">
            <div class="about-top">
                <h2 class="title-text">Beyond the Sirens:</h2>
                <h1 class="">Discover Who We Are</h1>
            </div>
            <div class="about-text">
                <p class="p-text">
                Welcome to MedCab, India's fastest-growing ambulance service provider. At MedCab, we are dedicated to providing comprehensive solutions to all your ambulance needs. With our 24/7 availability and a wide range of ambulances, including BLS, ALS, Patient transport ambulance, ICU ambulance, Air ambulance, Boat ambulance, Train ambulance, Dead Body ambulance and even animal ambulance, we ensure that every medical transportation requirement is met. 
                <br/>
                <br/>
                We are committed to delivering the best possible ambulance service to each and every individual in India. Our team of highly trained professionals is committed to providing compassionate care and ensuring your safety during transit. 
                <br/>
                <br/>
                As we continue to grow, our mission remains unchanged – to deliver the best possible emergency medical transportation to each and every person in India. Trust MedCab for reliable, professional and compassionate ambulance services. Your well-being is our top priority.
                </p>
            </div>
            <div class="about-vision about-block">
                <div class="row">
                    <div class="col-md-5 p-3">
                        <div class="about-img-block">
                            <img src="{{asset('assets/image/map.png')}}" alt="India Map" class="about-block-img">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="vision-text">
                            <h3 class="sub-title-800">Our Vision</h3>
                            <p class="p-text">
                            To create a healthier and happier world by providing accessible, affordable and quality healthcare to all. We strive to be a leader in the healthcare industry, leveraging technology and innovation to revolutionize the way healthcare is delivered, making it more patient- centric and accessible to everyone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-mission about-block">
                <div class="row flex-row-reverse">
                    <div class="col-md-5 p-3">
                        <div class="about-img-block">
                            <img src="{{asset('assets/image/mission.png')}}" alt="Our Mission" class="about-block-img">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="vision-text">
                            <h3 class="sub-title-800">Our Mission</h3>
                            <p class="p-text">
                            To provide timely and efficient ambulance services to people in need of emergency medical care with a focus on safety, comfort and compassion.<br/>
                            To offer a range of healthcare services beyond ambulance transport, including medical escorts, home healthcare, telemedicine, etc. to help patients receive the care they need in the most appropriate setting.
                            <br/>
                            To prioritize the needs of patients and their families, working closely with healthcare providers and facilities to ensure seamless and coordinated care throughout the patient journey.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
<!-- About Us Section End-->

<div class="container">
    <div style="" class="text-center">
        <h3 class="sub-title-800">Supercharging The Emergency Medical Transportationces </h3>
        <p class="p-text" style="margin-bottom:40px;">
        Supercharging The Emergency Medical Transportation with a relentless focus on providing swift ambulance services, we strive to enhance the overall
        healthcare landscape. Our aim is to accelerate the delivery of lifesaving solutions to those in need. 
        <br/>
        <br/>
        Our platform is designed to offer fast response times and easy ambulance booking, ensuring that help is just a few clicks away. With MedCab, you can count on our ambulances arriving within 10 minutes, delivering prompt emergency medical transportation when it matters the most. 
        <br/>
        <br/>

        Through cutting-edge technology, a wide range of ambulance options and a highly responsive platform, we are revolutionizing emergency medical care. With every call, we drive positive change, propelling innovation and prosperity in our communities.
        </p>     
    </div>
    <div class="FAQ" style="margin-top:120px;">
        <h3 class="sub-title-800 text-center">Frequently Asked Questions (FAQs)</h3>
    </div>
    <div class="faq-lists">
        <div class="faq-box">
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
        </div>
        <?php $i=0;
        $faqs=[
           
            [
                'que'=>"What languages are available for booking an ambulance with the MedCab App?",
                'ans'=>"
               MedCab offers language options such as English, Hindi, Telugu, Kannada and Bengali for booking an ambulance through our app or website."
            ],
            [
                'que'=>"Can I choose the type of ambulance I need?",
                'ans'=>"Yes, you can choose the type of ambulance based on the emergency. We offer basic life support (BLS), advanced life support (ALS), ICU & Air ambulances. Our team will also help you choose the right ambulance based on the patient's condition."
            ],
            [
                'que'=>"Is pre-booking available with MedCab?",
                'ans'=>"Yes, MedCab provides pre-booking options through our toll-free number at affordable rates. You can book an ambulance in advance to ensure availability in case of emergencies."
            ],
            [
                'que'=>"Do you provide ambulance services in other cities ?",
                'ans'=>"Yes, MedCab provides ambulance services in other cities across India such as Delhi, Hyderabad, Pune, Kolkata, Bangalore, etc. You can book our services through our ambulance booking app or website or dial our toll-free number to call an ambulance."
            ],
            [
                'que'=>"What is the toll-free emergency ambulance number in India?",
                'ans'=>"Dial 108 for Emergency Medical Response Ambulance Service, 102 for the ambulance service for pregnant women and infants. For private ambulance service, dial: 18008908208 & call an ambulance now!"
            ],
        ];

        
        foreach($faqs as $faq){?>
            <div class="faq-box">
                <div class="faq-q">
                    <span class="Q text-white fw-bold">Q</span>
                    <h3 class="faq-que">{{$faq['que']}}</h3>
                    <div class="close-btn">
                        <span></span>
                    </div>
                    <div class="open-btn">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <div class="faq-ans">
                    <div class="A text-white fw-bold">A</div>  
                    <p class="p-text">
                       {{$faq['ans']}}
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
