   @php
   $get_hospital_count = count(DB::table('hospital_lists')
   -> get());
   $get_cities_count = count(DB::table('city')
   -> get());
   $get_driver_count = count(DB::table('driver_details')
   -> get());
   @endphp
   <!-- Book & Get Ambulance -->
   <section class="app-preview get-ambulance">
       <div class="app-previewTop d-flex justify-content-center py-4 px-2 cards">
           <div class="bg-white card shadow-lg text-center">
               <h1 class="counter-count">{{$get_cities_count}}+</h1>
               <p>Cities</p>
           </div>
           <div class="bg-white card shadow-lg text-center">
               <h1 class="counter-count">{{$get_hospital_count}}+</h1>
               <p>Hospitals</p>
           </div>
           <div class="bg-white card shadow-lg text-center">
               <h1 class="counter-count">{{$get_driver_count}}+</h1>
               <p>Drivers</p>
           </div>
       </div>
       <div class="app-previewBottom">
           <div class="heading text-center">
               <h1 class="text-white">Book & Get Ambulance in 10 Minutes</h1>
               <a href="#" class="text-decoration-none bg-white shadow-lg my-2 primary-cta">Download MedCab App</a>
           </div>
           <div class="image-wrapper owl-carousel owl-theme owl-carousel-preview">
               <div class="preview-image item">
                   <img src="{{asset('assets/website-images/Wood-Hand.png')}}" alt="" />
               </div>
               <div class="preview-image item">
                   <img src="{{asset('assets/website-images/iPhone 12 Pro (Wooden Hands).png')}}" alt="" />
               </div>
               <div class="preview-image item">
                   <img src="{{asset('assets/website-images/Wood-Hand-1.png')}}" alt="" />
               </div>
           </div>
       </div>
       <!-- White curve background -->
       <div class="white-curve">
           <img src="{{asset('assets/website-images/white-curve.png')}}" alt="" />
       </div>
   </section>
