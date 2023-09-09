<!-- customer support facility -->
@php
$get_category_name = DB::table('ambulance_category')
->get();
@endphp
<section class="customer-support">
  <h1 class="main-heading text-center">Customer Support Facilities</h1>
  <div class="grid-container">
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/ambu-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
        24/7 Ambulance Support
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">Oxygen Support</li>
        <li class="secondary-text">Basic Life Support</li>
        <li class="secondary-text">Advanced Life Support</li>
        <li class="secondary-text">Faster Response Times</li>
        <li class="secondary-text">Trained and Certified Staff</li>
        <li class="secondary-text">Advanced Medical Equipment</li>
        <li class="secondary-text">
          Specialized Transport for Critical Care Patients
        </li>
      </ul>
    </div>
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/patient-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
      Patient Support
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">Multilingual Helpdesk</li>
        <li class="secondary-text">Local Language Support</li>
        <li class="secondary-text">Patient Care Helpline</li>
        <li class="secondary-text">Trip Support Services</li>
      </ul>
    </div>
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/call-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
      Call Support
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">Expert Advice</li>
        <li class="secondary-text">Availability</li>
        <li class="secondary-text">Immediate Response</li>
        <li class="secondary-text">Multilingual Support</li>
        <li class="secondary-text">Remote Troubleshooting</li>
        <li class="secondary-text">Multi-Platform Support</li>
      </ul>
    </div>
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/smooth-discharge-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
      Smooth Discharge Processes
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">Pick/Drop Service</li>
        <li class="secondary-text">Personalized Care</li>
        <li class="secondary-text">Skilled Paramedic Staff</li>
        <li class="secondary-text">Safe/Comfortable Transportation</li>
        <li class="secondary-text">Dedicated Discharge Coordinators</li>
      </ul>
    </div>
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/multi-payment-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
      Multiple Payment Methods
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">Cash</li>
        <li class="secondary-text">UPI Payment</li>
        <li class="secondary-text">Credit/ Debit Card</li>
        <li class="secondary-text">Book in Advance</li>
        <li class="secondary-text">Transparent Billing</li>
      </ul>
    </div>
    <div class="grid-item d-flex flex-column align-items-center">
      <img src="{{asset('assets/image/emgy-supp.png')}}" alt="" />
      <h4 class="primary-text fw-bold text-center">
      Expansion of Our Ambulance Coverage
      </h4>
      <ul class="d-flex flex-column align-items-center text-center">
        <li class="secondary-text">PAN India Coverage</li>
        <li class="secondary-text">Mobile App Integration</li>
        <li class="secondary-text">Collaborating with Hospitals</li>
        <li class="secondary-text">Advanced Medical Technology</li>
        <li class="secondary-text">Sustainable/Eco-Friendly Practices</li>
      </ul>
    </div>
  </div>
</section>