
<!-- our services (updated) -->
@php
  $ambulance_facility = DB::table('ambulance_facilities')
  -> join('ambulance_category','ambulance_facilities.ambulance_facilities_category_type','=','ambulance_category.ambulance_category_type')
  -> get();
  @endphp
  @dd($ambulance_facility)
  <section class="our-services">
      <h1 class="our-services-heading text-center">Our Services</h1>
      <div
        class="our-servicesCards owl-carousel owl-carousel-services owl-theme"
      >
        <div class="our-servicesCard item">
          <h2>Air Ambulace</h2>
          <img src="{{asset('assets/website-images/Component 11-1.png')}}" alt="" />
          <p>
            Designed to transport critically ill patients who require
            specialized medical care during transportation.
          </p>
          <div class="service-icons">
            <div class="icon"><img src="{{asset('assets/website-images/Group 72.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 161.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 81.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 148.png')}}" alt="" /></div>
          </div>
          <a href="#" class="read-more">Read More</a>
        </div>
        <div class="our-servicesCard item">
          <h2>Air Ambulace</h2>
          <img src="{{asset('assets/website-images/Component 11-1.png')}}" alt="" />
          <p>
            Designed to transport critically ill patients who require
            specialized medical care during transportation.
          </p>
          <div class="service-icons">
            <div class="icon"><img src="{{asset('assets/website-images/Group 72.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 161.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 81.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 148.png')}}" alt="" /></div>
          </div>
          <a href="#" class="read-more">Read More</a>
        </div>
        <div class="our-servicesCard item">
          <h2>Air Ambulace</h2>
          <img src="{{asset('assets/website-images/Component 11-1.png')}}" alt="" />
          <p>
            Designed to transport critically ill patients who require
            specialized medical care during transportation.
          </p>
          <div class="service-icons">
            <div class="icon"><img src="{{asset('assets/website-images/Group 72.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 161.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 81.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 148.png')}}" alt="" /></div>
          </div>
          <a href="#" class="read-more">Read More</a>
        </div>
        <div class="our-servicesCard item">
          <h2>Air Ambulace</h2>
          <img src="{{asset('assets/website-images/Component 11-1.png')}}" alt="" />
          <p>
            Designed to transport critically ill patients who require
            specialized medical care during transportation.
          </p>
          <div class="service-icons">
            <div class="icon"><img src="{{asset('assets/website-images/Group 72.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 161.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 81.png')}}" alt="" /></div>
            <div class="icon"><img src="{{asset('assets/website-images/Group 148.png')}}" alt="" /></div>
          </div>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>
      <div class="btn-view">
        <a href="#"
          >View All
          <svg
            class="mb-1 ms-1"
            width="18"
            height="14"
            viewBox="0 0 21 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M20.7071 8.7071C21.0976 8.31658 21.0976 7.68342 20.7071 7.29289L14.3431 0.928931C13.9526 0.538407 13.3195 0.538407 12.9289 0.928931C12.5384 1.31946 12.5384 1.95262 12.9289 2.34314L18.5858 8L12.9289 13.6569C12.5384 14.0474 12.5384 14.6805 12.9289 15.0711C13.3195 15.4616 13.9526 15.4616 14.3431 15.0711L20.7071 8.7071ZM8.74227e-08 9L20 9L20 7L-8.74227e-08 7L8.74227e-08 9Z"
              fill="white"
            />
          </svg>
        </a>
      </div>
    </section>
