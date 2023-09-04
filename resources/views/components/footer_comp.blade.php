  <!-- Footer Area -->
  <footer>
    <div class="footer-container pt-5 pb-5">
        <div class="container">
                <div class="footer-main d-flex justify-content-space-between mb-3">
                    <img src="{{asset('assets/image/logo.png')}}" alt="Medcab Logo" class="logo">
                    <button class="footer-download-btn">Download MedCab App</button>
                </div>
                <div class="row footer-menu justify-content-space-between gy-3">
                        <div class="col-md-2 col-6">
                            <div class="footer-item w-100">
                                <h4 class="links-heading">Quick Links</h4>
                                <ul>
                                    <li><a href="{{URL::route('Home')}}">Home</a></li>
                                    <li><a href="{{URL::route('AboutUs')}}">About Us</a></li>
                                    <li><a href="{{URL::route('Hospitals')}}">Hospitals</a></li>
                                    <li><a href="{{URL::route('Ambulances')}}">Ambulances</a></li>
                                    <li><a href="{{URL::route('JoinUs')}}">Join Us</a></li>
                                    <li><a href="{{URL::route('Blogs')}}">Blogs</a></li>
                                    <li><a href="{{URL::route('ContactUs')}}">Contact Us</a></li>
                                    <li><a href="{{URL::route('SiteMap')}}">Sitemap</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-2 col-6">
                            <div class="footer-item">
                            <h4 class="links-heading">Info.</h4>
                                <ul>
                                    <!--<li><a href="#">Privacy Policy</a></li>-->
                                    <li><a href="{{URL::route('Customer.Privacy&Policy')}}">Customer Privacy & Policy</a></li>
                                    <li><a href="{{URL::route('Driver.Privacy&Policy')}}">Driver Privacy & Policy</a></li>
                                    <li><a href="{{URL::route('Partner.Privacy&Policy')}}">Partner Privacy & Policy</a></li>
                                    <li><a href="{{URL::route('Customer.Cancel&Refund')}}">Customer Cancelation & Refund Policy</a></li>
                                    <li><a href="{{URL::route('Driver.Cancel&Refund')}}">Driver Cancelation & Refund Policy</a></li>
                                    <li><a href="{{URL::route('Term&Condition')}}">Terms & Conditions</a></li>
                                    <li><a href="{{URL::route('Service_Level_Agreement')}}">Service Level Agreement</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="footer-item">
                                <h4 class="links-heading">locations</h4>
                                <div class="row location gy-2 p-2 pl-3s">
                                    <div class="col-4">
                                    <ul class="location-links">
                                        <?php
                                        
                                        $cities =DB::table('city_content')->get(['city_name','city_id','city_title_sku']);
        
                                        ?>
                                        @for($i=0;$cities->count()>$i;$i++)
                                            @if($i==10)
                                                @break
                                            @endif
                                            <li><a href="{{URL::route('CityContent',['title'=>$cities[$i]->city_title_sku])}}">Ambulance in {{$cities[$i]->city_name}}</a></li>
                                        @endfor 
                                     </ul>
                                    </div>

                                    <div class="col-4">
                                    <ul class="location-links">
                                        @for($i=10;$cities->count()>$i;$i++)
                                            @if($i>=10 && $i<20)
                                            <li><a href="{{URL::route('CityContent',['title'=>$cities[$i]->city_title_sku])}}">Ambulance in {{$cities[$i]->city_name}}</a></li>
                                            @elseif($i==21)
                                                @break;
                                            @endif
                                        @endfor 
                                    </ul>
                                    </div>

                                    <div class="col-4">
                                    <ul class="location-links">
                                        @for($i=20;$cities->count()>$i;$i++)
                                            @if($i>19 && $i<30)
                                            <li><a href="{{URL::route('CityContent',['title'=>$cities[$i]->city_title_sku])}}">Ambulance in {{$cities[$i]->city_name}}</a></li>
                                            @elseif($i==31)
                                                @break;
                                            @endif
                                        @endfor
                                     </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <hr style="border-color:white;margin:2.5rem 0;"/>
                <div class=" row footer-details justify-content-start d-flex gx-3 gy-1">
                    <div class="col-lg-3 col-md-4 col-sm-6 footer-address">
                        <span class="info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <span><a href="https://goo.gl/maps/rpDiV523AhxECdPi6">Rajsha Tower, 3/9B, Vibhuti Khand, Gomti Nagar,<br/> Lucknow, Uttar Pradesh, 226010</a> </span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 footer-contact">
               
                        <span class="info-icon">
                        <i class="fa-solid fa-phone"></i>
                        </span>
                        <span><a href="tel: +91 18008908208">18008908208</a></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 footer-mail">
                        <span class="info-icon">
                        <i class="fa-solid fa-envelope"></i>

                        </span>
                        <span><a href="mailto: info@medcab.in">info@medcab.in</a></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12  text-right footer-mail">
                        <span><a href="https://medcabprivatelimited.com/">Copyright © 2023 MedCab  | Powered by MedCab Private Limited</a></span>
                    </div>    
                </div>
        </div>
    </div>
</footer>
  <!-- end footer area -->

