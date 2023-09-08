@extends('layouts.adminlayout')
@section('title',"About Us | MedCab")
@section('description',"With MedCab, the Best and Fastest Online Ambulance Service is just a tap away, giving you an
advantage when it comes to urgent medical assistance in India.")
@section('keywords',"MedCab, MedCab About us, MedCab Vision, MedCab Mission, ambulance service, ambulance
service provider in India, emergency medical transportation")
@section('main')
<!-- About Us Section Start -->
<section class="about-section padding">
    <div class="about-header">
        <img src="{{asset('assets/website-images/about-header.png')}}" width="100%" alt="India Map" class="about-block-img">
        <div class="about-top">
            <h2 class="title-text">Beyond the Sirens</h2>
            <h1 class="">Discover Who We Are</h1>
        </div>
    </div>
    <div class="container">
        <div class="about-text">
            <p class="primary-text">
                Welcome to MedCab, India's fastest-growing ambulance service provider. At MedCab, we are dedicated to providing comprehensive solutions to all your ambulance needs. With our 24/7 availability and a wide range of ambulances, including BLS, ALS, Patient transport ambulance, ICU ambulance, Air ambulance, Boat ambulance, Train ambulance, Dead Body ambulance and even animal ambulance, we ensure that every medical transportation requirement is met.
                <br />
                <br />
                We are committed to delivering the best possible ambulance service to each and every individual in India. Our team of highly trained professionals is committed to providing compassionate care and ensuring your safety during transit.
                <br />
                <br />
                As we continue to grow, our mission remains unchanged – to deliver the best possible emergency medical transportation to each and every person in India. Trust MedCab for reliable, professional and compassionate ambulance services. Your well-being is our top priority.
            </p>
        </div>
        <div class="about-vision about-block">
            <div class="row d-flex align-items-center">
                <div class="col-md-5 p-3">
                    <div class="about-img-block-2">
                        <img src="{{asset('assets/image/map.png')}}" alt="India Map" class="about-block-img-2">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="vision-text">
                        <h3 class="main-heading mt-0">Our Vision</h3>
                        <p class="primary-text">
                            At MedCab, our vision is to be the trusted leader in ambulance services across India, providing exceptional care and prompt medical assistance to everyone. We strive to ensure that every patient receives timely transportation, skilled paramedic support and state-of-the-art medical equipment, all delivered with utmost compassion and professionalism.
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
                        <h3 class="main-heading">Our Mission</h3>
                        <p class="primary-text">
                            At MedCab, our mission is to save lives and provide exceptional emergency medical services to the people of India. With our fleet of state-of-the-art ambulances and highly skilled medicalprofessionals, we're dedicated to being the driving force behind every critical moment, ensuring that help reaches you faster than a heartbeat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="text-center">
            <h3 class="main-heading">Supercharging The Emergency Medical Transportationces </h3>
            <p class="primary-text" style="margin-bottom:40px;">
                Supercharging The Emergency Medical Transportation with a relentless focus on providing swift ambulance services, we strive to enhance the overall
                healthcare landscape. Our aim is to accelerate the delivery of lifesaving solutions to those in need.
                <br />
                <br />
                Our platform is designed to offer fast response times and easy ambulance booking, ensuring that help is just a few clicks away. With MedCab, you can count on our ambulances arriving within 10 minutes, delivering prompt emergency medical transportation when it matters the most.
                <br />
                <br />

                Through cutting-edge technology, a wide range of ambulance options and a highly responsive platform, we are revolutionizing emergency medical care. With every call, we drive positive change, propelling innovation and prosperity in our communities.
            </p>
        </div>

</section>
<!-- FaQ session -->
@include('include.faqs')

<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner -->

@endsection