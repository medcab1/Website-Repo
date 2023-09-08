@extends('layouts.adminlayout')
@section('title',"Contact Us - MedCab")
@section('main')
@section('description',"Have any query? Feel free to contact us at 18008-908-208 . Our support team is 24/7 available
to assist you.")
@section('keywords',"MedCab, MedCab Contact Us, MedCab Contact Number, MedCab Helpline Number, MedCab
Ambulance Helpline Number")

<!-- Contact Section start -->
<section class="contact-section section-padding padding" style="margin-bottom: -30px">
  <div class="container-fluid">
    <div class="contact-us row gy-4">
      <div class="col-lg-6 p-0">
        <div class="contact-left-img h-100 d-flex-center p-2">
          <img src="{{asset('assets/website-images/frame31802.png')}}" alt="Contact Us banner" class="w-100" />
        </div>
      </div>
      <div class="col-lg-6 p-0">
        <div class="contact-form px-3">
          <h1 class="main-heading text-start form-caption">Get in Touch</h1>
          <form action="" method="post" id="contact-form">
            <div class="form-mess mb-4">
              <h3 class="text-success"></h3>
              <h3 class="text-success"></h3>
            </div>
            <div class="row" style="row-gap: 20px">
              <div class="col-12 col-sm-6">
                <div class="">
                  <label class="primary-text form-label">First Name*</label>
                  <input type="text" pattern="[a-zA-Z]+" oninput="inputCharacterOnly(this)" name="first-name" class="form-control" value="" />
                  <span class="errorMess form-text text-danger"> </span>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="">
                  <label class="primary-text form-label">Last Name*</label>
                  <input type="text" pattern="[a-zA-Z]+" name="last-name" oninput="inputCharacterOnly(this)" class="form-control" value="" />
                  <span class="errorMess form-text text-danger"> </span>
                </div>
              </div>
              <div class="col-12">
                <div class="">
                  <label class="primary-text form-label">Phone Number*</label>
                  <input type="number" name="mob_no" maxlength="10" class="form-control" value="{{ old('mob_no') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
                  <span class="errorMess form-text text-danger"> </span>
                </div>
              </div>
              <div class="col-12">
                <div class="">
                  <label class="primary-text form-label">Email Address*</label>
                  <input type="email" name="email" class="form-control" value="" style="text-transform: lowercase" />
                  <span class="errorMess form-text text-danger"> </span>
                </div>
              </div>
              <div class="col-12">
                <div class="">
                  <label class="primary-text form-label">Message</label>
                  <textarea rows="3" name="message" class="form-control text-left" style="text-align-last: auto"></textarea>
                  <span class="errorMess form-text text-danger"> </span>
                </div>
              </div>
              <div class="col-12">
                <div class="">
                  <button type="submit" class="text-white primary-text form-control medcab-btn" id="contact-form-submit-btn">
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-loc row gy-4 mb-5">
    <div class="col-lg-6 p-0">
      <div class="contact-left-img h-70 d-flex-center p-4">
        <img src="{{asset('assets/website-images/frame32703.png')}}" width="100%" alt="Contact Us banner" />
      </div>
    </div>
    <div class="col-lg-6 p-0">
      <div class="link px-3 d-flex flex-column">
        <a class="d-inline-block mb-3 mt-3 primary-text" href="default.asp"><img src="{{asset('assets/website-images/frame72 (1).png')}}" alt="address" href="mailto:webmaster@example.com" />Third Floor Rajsha Tower Vibhuti Khand Gomti Nagar, Lucknow,
          Uttar Pradesh 226010</a><br />
        <a class="d-inline-block mb-3 primary-text" href="default.asp"><img src="{{asset('assets/website-images/frame72 (2).png')}}" alt="address" href="mailto:webmaster@example.com" />+91 8755672479</a> <br />
        <a class="d-inline-block mb-3 primary-text" href="default.asp">
          <img src="{{asset('assets/website-images/frame72 (3).png')}}" alt="address" href="mailto:webmaster@example.com" />info@medcabprivaelimited.com</a><br />
      </div>
    </div>
  </div>
</section>

<script>


</script>
<!-- Contact Section end -->

@endsection