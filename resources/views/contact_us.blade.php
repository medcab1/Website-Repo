
@extends('layouts.adminlayout')
@section('title',"Contact Us - MedCab")
@section('main')
@section('description',"Have any query? Feel free to contact us at 18008-908-208 . Our support team is 24/7 available
to assist you.")
@section('keywords',"MedCab, MedCab Contact Us, MedCab Contact Number, MedCab Helpline Number, MedCab
Ambulance Helpline Number")

<!-- Contact Section start -->
    <section class="contact-section section-padding" style="margin-bottom:-70px;">
        <div class="container">
            <div class="contact-us row gy-4">
                <div class="col-lg-6 p-0 ">
                    <div class="contact-left-img h-100 d-flex-center p-2">
                       <img src="{{url('/assets/image/contact us.png')}}" alt="Contact Us banner" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="contact-form px-3">
                        <h1 class="form-caption">
                        Contact Us
                        </h1> 
                        <form action="{{URL::Route('ContactUs.Save')}}" method="post" id="contact-form">
                            <div class="form-mess mb-4">
                                <h3 class="text-success">
                                    @if(!empty(Session::has('success_mess')))
                                    {{Session::get('success_mess')}}
                                    @endif
                                </h3>
                                <h3 class="text-success">
                                    @if(!empty(Session::has('failed_mess')))
                                    {{Session::get('failed_mess')}}
                                    @endif
                                </h3>
                            </div>
                           <div class="row" style="row-gap:20px;">
                                <div class="col-6">
                                    <div class="">
                                        <label  class="form-label">First Name*</label>
                                        <input type="text" pattern="[a-zA-Z]+" oninput="inputCharacterOnly(this)" name="first-name" class="form-control" value="{{ old('first-name') }}">
                                        <span  class="errorMess form-text text-danger">
                                            
                                            @if($errors->has('first-name'))
                                            {{$errors->first('first-name')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <label  class="form-label">Last Name*</label>
                                        <input type="text" pattern="[a-zA-Z]+"  name="last-name" oninput="inputCharacterOnly(this)" class="form-control" value="{{ old('last-name') }}">
                                        <span  class="errorMess form-text text-danger">
                                            
                                        @if($errors->has('last-name'))
                                            {{$errors->first('last-name')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label  class="form-label">Phone Number*</label>
                                        <input type="number" name="mob_no" maxlength="10" class="form-control" value="{{ old('mob_no') }}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        <span  class="errorMess form-text text-danger">
                                            
                                        @if($errors->has('mob_no'))
                                            {{$errors->first('mob_no')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label  class="form-label">Email Address*</label>
                                        <input type="email"  name="email" class="form-control" value="{{ old('email') }}" style="text-transform:lowercase;">
                                        <span  class="errorMess form-text text-danger">
                                        @if($errors->has('email'))
                                            {{$errors->first('email')}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label  class="form-label">Message</label>
                                        <textarea rows="3" name="message"  class="form-control text-left" style="text-align-last:auto;">{{ old('message') }}</textarea>
                                        <span  class="errorMess form-text text-danger">
                                        @if($errors->has('message'))
                                            {{$errors->first('message')}}
                                            @endif
                                        </span>
                                </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <button type="submit" class="form-control medcab-btn" id="contact-form-submit-btn">Submit</button>                                        
                                    </div>
                                </div>
                                
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    
   
</script>
<!-- Contact Section end -->

@endsection
