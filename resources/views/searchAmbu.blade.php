
@extends('layouts.configLayout')
@section('title',"MedCab | Ambulance Service in India | Ambulance Booking ")
@section('main')

<div class="container ambulance-search ">
   
        <div class="ambulance-search-body">
            <a href="{{URL::to('/')}}" class="move-page-btn"><i class="fa-solid fa-arrow-left-long mr-auto"></i>
            @if($users['booking-type']==0)
                Emergency Ambulance Booking
            @elseif($users['booking-type']==1)
                Rental Ambulance Booking
            @elseif($users['booking-type']==2)
                Bulk Ambulance Booking
            @endif
          
        </a>
            <div class="row ambulance-search-body-row m-0 flex-wrap flex-row-reverse " style="row-gap:20px;">
                
                    <div class="col-lg-7 ambu-detail-col h-100 ambu-search-right">
                        <div class="ambu-types">
                            <div class="ambu-types-body">
                                <h5 class="type-heading">  Select Ambulance Type</h5>
                                <div class="ambu-types-list">
                                    @foreach($price as $cat)
                                    <div class="ambu-type-box  search-ambu-type-box p-relative  <?php 
                                    if($cat->avl_status=='1'){
                                        echo 'disabled-item ';
                                    }
                                     if($users['booking-type']==2 && $cat->ambulance_category_type!='C'){ echo 'bulk-ambu-type-box disabled-item';}else{ echo 'bulk-ambu-type-box';}  ?>" id="ambu_{{$cat->ambulance_category_type}}">
                                        <div class="ambu-types-img flex-column" style="width:auto!important;" >
                                            <img src="{{url($cat->ambulance_category_icon)}}"  alt="{{$cat->ambulance_category_name}}" >
                                        @if($users['booking-type']==2)
                                            <span class="ambu-dis-time" id="ambu-dis-time-{{$cat->ambulance_category_type}}">{{$cat->arrival_time}}</span>
                                        @endif
                                        </div>
                                        <div class="ambu-types-detail">
                                            <h4 class="ambu-type-heading" cat-type="{{$cat->ambulance_category_type}}">{{$cat->ambulance_category_name}}</h4>
                                            <p class="ambu-type-desc text-left" style="text-align:left!important;">
                                                <?php $include=''; 
                                                        $i=0;
                                                foreach($ambu_facilities as $facility){
                                                    if($cat->ambulance_category_type==$facility->ambulance_facilities_category_type){
                                                        $include=$facility->ambulance_facilities_name.', ';
                                                        echo $include;
                                                        $i++; 
                                                        if($i==3){
                                                            break;
                                                        }
                                                    }
                                                }
                                                
                                                    ?>
                                            <a  class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#{{ str_replace(' ', '-', $cat->ambulance_category_name)}}"> Read more</a>
                                            </p>
                                        </div>
                                        <div class="ambu-type-price-detail">
                                            <span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign ml-2"></i>
                                            <?php
                                            $facility_rate=0;
                                            $service_charge=0;
                                
                                            if($users['booking-type']==0 || $users['booking-type']==2){
                                                foreach($ambu_facilities as $facility){
                                                    if($cat->ambulance_category_type==$facility->ambulance_facilities_category_type){
                                                        $facility_rate=$facility_rate+$facility->ambulance_facilities_rate_amount ;   
                                                    }   
                                                }
                                                if( $users['distance'] <=$cat->ambulance_base_rate_till_km)
                                                {
                                                    $fare=$cat->ambulance_base_rate_amount ;
                                                    $total=$fare+$facility_rate;
                                                    echo  sprintf('%0.2f', intval($total));
                                                    
                                                }
                                                else
                                                {
                                                    $fare=$cat->ambulance_base_rate_amount + (($users['distance']-$cat->ambulance_base_rate_till_km)*$cat->ambulance_rate_multiply)*$cat->ambulance_rate_amount;
                                                    $total=$fare+$facility_rate;
                                                    echo  sprintf('%0.2f', intval($total));
                                                }
                                            }
                                            else{
                                                if($users['booking-period']==24){
                                                    $total=$cat->arr_rental_amount;
                                                    echo  sprintf('%0.2f', intval($total));
                                                }
                                                elseif($users['booking-period']==31){
                                                    $total=$cat->arr_rental_amount;
                                                    echo  sprintf('%0.2f', intval($total));
                                                }
                                                else{
                                                    echo '0';
                                                }
                                            }
                                            
                                            
                                            ?>         
                                            </span>
                                         @if($users['booking-type']==2)
                                        <div class="ambu-type-quantity input-group w-100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" class="quantity" name="quantity" class="form-control input-number" placeholder="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                 <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                        @endif
                                        @if($users['booking-type']==0 || $users['booking-type']==1)
                                        <span class="ambu-dis-time"  id="ambu-dis-time-{{$cat->ambulance_category_type}}">{{$cat->arrival_time}}</span>
                                        @endif
                                        </div>
                                        
                                       

                                    </div>
                                        <!-- Read MOre model start -->
                                        <div class="modal p-3" id="{{ str_replace(' ', '-',   $cat->ambulance_category_name)}}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h6 class="modal-title text-secondary" id="exampleModalCenterTitle" >{{$cat->ambulance_category_name}}</h6>
                                                        <button type="button" class="modal-close close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="epuipment">
                                                            <span class="equip-sub-heading">Facilities</span>
                                                            <div class="equipment-type-list">
                                                                @foreach($ambu_facilities as $facility)
                                                                @if($cat->ambulance_category_type==$facility->ambulance_facilities_category_type)
                                                                <div class="equipment-type">
                                                                    <div class="equipment-img">
                                                                        <img src="{{$facility->ambulance_facilities_image}}" alt="{{$facility->ambulance_facilities_name}}">
                                                                    </div>
                                                                    <span class="equipment-name" style="font-size:10px;">   
                                                                    {{$facility->ambulance_facilities_name}}
                                                                    </span>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="case-list mt-4">
                                                            <span class="equip-sub-heading">For case like:</span>
                                                            <div class="case-list-items">
                                                                <ul>
                                                                   
                                                                    @foreach($cases_like as $case)
                                                                        @if($cat->ambulance_category_type==$case->accl_cat_type) 
                                                                            <li>{{$case->accl_text}} </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer flex-nowrap border-0 justify-content-center">
                                                            <button type="button" class="m-btn" style="color: white;width: fit-content;height: 28px;background-color: #c5354f;" data-bs-dismiss="modal">Back</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <!-- read more model end -->             
                                    @endforeach 
                                        <!-- ambu-type end -->
                                </div>
                                <div class="selected-ambu-footer">
                                    <span class="selected-ambulence-footer"></span>
                                    <span class="total-sel-ambu-price"></span>
                                </div>
                            </div>
                            <div class="next-btn">
                                <button  id="loginBtn" class="sub-btn" data-bs-toggle="modal" data-bs-target="#login" disabled  >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5  ambu-detail-col ambu-search-left">
                    <div class="search-form">
                    <form class="booking-form" id="forms">
                        @csrf    
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1">PickUp Location</label>
                            <div class="input-group pick-group justify-content-center align-items-center bg-light-gray">
                                <img src="{{url('/assets/image/pickup-icon.png')}}" alt="Pickup address icon" style="margin-left:10px;" >
                                <input type="text" class="form-control pick b-none input-focus-none p-0 pr-2"  name="pick"  id="pickup" value="{{$users['pick']}}"  placeholder="Enter Pickup location here" disabled>
                                <!-- <i class="fa-solid fa-location-crosshairs control-icon"  id="current_location"></i>
                                <i class="fa-solid fa-xmark reset-input control-icon"></i>
                                <input type="hidden" id="lat" name="pick_lat" value="lat">
                                <input type="hidden" id="lng" name="pick_lng" value="lng"> -->
                            </div>
                        </div>
                        @if($users['booking-type']==0 ||$users['booking-type']==2)
                        <div class="form-group p-relative ">
                            <label for="exampleDropdownFormPassword1">Drop Location</label>
                            <div class="input-group drop-group justify-content-center align-items-center bg-light-gray gx-2">
                                <img src="{{url('/assets/image/drop-icon.png')}}" alt="Drop address icon" style="height:16px;width:16px;">
                                <input type="text" class="form-control b-none input-focus-none" id="drop" name="drop" value="{{$users['drop']}}" placeholder="Enter Desination location here" disabled >
                                <!-- <i class="fa-solid fa-xmark drop-reset-input control-icon"></i> -->
                            </div>
                            <!-- <input type="hidden" name="drop_lat" id="drop_lat"  value="lat">
                            <input type="hidden" name="drop_lng" id="drop_lng"  value="lng">
                           -->
                        </div>
                        @endif
                      
                        @if($users['booking-type']==1)
                                <div class="form-group p-relative ">
                                    <label for="exampleDropdownFormPassword1">Duration</label>
                                    <div class="input-group drop-group justify-content-center align-items-center bg-light-gray">
                                        <input type="text" class="form-control b-none  input-focus-none" id="distance" name="distance" <?php 
                                        if($users['booking-period']==24) 
                                            {
                                                echo 'value="'.$users["sel-hours"].' Hours"';
                                            }
                                        else {
                                                echo 'value="'.$users['sel-days'].' Days"';
                                            }?>
                                         Style="border:none;" disabled >
                                    </div>
                                </div>
                        @else
                        <div class="form-group p-relative ">
                                    <label for="exampleDropdownFormPassword1">Distance</label>
                                    <div class="input-group drop-group justify-content-center align-items-center bg-light-gray">
                                        <input type="text" class="form-control b-none  input-focus-none" id="distance" name="distance" value="{{$users['distance']}}KM" Style="border:none;" disabled >
                                    </div>
                                </div>
                        @endif                        
                    </form>
                       
                        <div class="map-container">
                            <div id="map" style="height:100%;width:100%;"></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

</div>

<!-- Modal -->
<div class="modal" id="ModalCenter" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                <h6 class="modal-title text-secondary" id="exampleModalCenterTitle" >Schedule Ambulance</h6>
                
            </div>
            <div class="modal-body ">
                <div class="schedule-box">
                    <div class="input-group mb-2" id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                        </label>
                        <input id="datepicker" type="date" min="<?php echo date('Y-m-d'); ?>" data-date="" data-date-format="DD MMMM YYYY" class="form-control date-input b-none date" style="border:none;"  placeholder="Select Date" />
                        <label class="dropdown-btn" id="scheduling">
                                <span class="down-chevron-icon " >
                                    
                                </span>
                            </label>
                    </div>
                    <div class="input-group mb-2 " id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                        <label class="input-group-btn" for="txtDate">
                            <span class="btn btn-default">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                        </label>
                        <input id="timepicker" type="time"  min="<?php echo date('h:i:s'); ?>" class="form-control date-input b-none time" style="border:none;"  placeholder="Select Time" />
                        <label class="dropdown-btn" id="scheduling">
                                <span class="down-chevron-icon " >
                                    
                                </span>
                            </label>
                    </div>
                    <p class="text-danger text-light">Book in Advance - Schedule your Date and Time</p>

                </div>
            </div>
            <div class="modal-footer flex-nowrap border-0">
                <button type="button" class="m-btn medcab-btn-transparent" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="m-btn w-100 medcab-btn" id="confirm-btn">Confirm</button>
            </div>
        </div>
    </div>
    </div>
    <!-- Schedule now model end -->
<!-- Login Modal start -->

                    <div class="modal varification-model p-4" id="login" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <div class="login-header">
                                            <img alt="Medcab Logo" src="assets/image/logo.png" id="popup-header" style="height:30px; width:auto">
                                            <h6 class="modal-title text-secondary"  ></h6>
                                        </div>
                                        <button type="button" class="modal-close close" style="font-size:1.5rem;" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="color:white;font-size:1.rem!important;">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <form  method="post" class="login-form" id="loginForm">
                                            <input type="text" name="tokens" id="tokens" hidden content="{{csrf_token()}}">
                                            <div class="form-group p-relative w-100">
                                                <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                                                <input type="tel" id="phone" class="form-control "   onkeypress="return onlyNumberKey(event)" name="phoneNO" onload="focusInputElement('phone')" placeholder="Enter Your Mobile number" autofocus>
                                                <span class="text-danger error-message" id="login-message">
                                                @error('phone')
                                                {{ $message }}
                                                @enderror
                                                </span> 
                                            </div>
                                            <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                                <input type="submit" class="sub-btn  nextBTn"  id="verify-btn" Value="Verify" >         
                                            </div>      
                                        </form>
                                        <form  method="post" class="login-form" id="registerForm">
                                            <input type="text" name="tokens" id="reg_tokens" hidden content="{{csrf_token()}}">
                                            <div class="form-group p-relative w-100">
                                                <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                                                <input type="text" id="name" class="form-control "   name="name" placeholder="Enter Your Name" onkeypress="return onlyCharacters(event)"  onload="focusInputElement('name')">
                                                <span class="text-danger error-message" id="register-message" ></span> 
                                            </div>
                                            <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                                <input type="submit" class="sub-btn  nextBTn"  id="proceed-btn" Value="Proceed" >         
                                            </div>      
                                        </form>
                                        <form  method="post" class="login-form" id="otpForm">
                                            <input type="text" name="tokens" id="otp_tokens" hidden content="{{csrf_token()}}">
                                            <div class="form-group p-relative w-100">
                                        
                                                <!-- <input type="tel" id="otp" class="form-control "  onkeypress="return onlyNumberKey(event)" name="otp" placeholder="Enter 6 digit OTP" autofocus> -->
                                                <span class="text-danger error-message" id="otp-message" style="display:none;">Otp Message</span> 
                                            </div>
                                            <div class="m-auto" style="width:fit-content;">
                                                    <label for="exampleDropdownFormPassword1" class="text-center font-18 font-700 d-block mb-3">
                                                        Please enter OTP sent to
                                                    </label>                                            
                                                    <label for="exampleDropdownFormPassword1" class="text-center font-16 font-600 d-block mb-3">
                                                    
                                                    @if(Session::has('consumer_mob'))
                                                    {{"+91 ".Session::get('consumer_mob')}}
                                                    @endif
                                                    </label>
                                                    <div class="otp-input-container input-field" style="">
                                                        <input type="number" class="otp-input" id="otp-input-1" style="" >
                                                        <input type="number" class="otp-input" id="otp-input-2"  disabled>
                                                        <input type="number" class="otp-input" id="otp-input-3" disabled>
                                                        <input type="number" class="otp-input" id="otp-input-4"  disabled>
                                                        <input type="number" class="otp-input" id="otp-input-5"  disabled>
                                                        <input type="number" class="otp-input" id="otp-input-6" disabled>
                                                        
                                                        <!-- <input type="number" />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled />
                                                        <input type="number" disabled /> -->
                                                        
                                                    </div>
                                                <label for="" id="wrong-otp-mess" class=" font-400 font-16 mt-3 d-block text-danger">   
                                                </label>
                                                <a id="resend-otp" class=" font-400 font-16 mt-3 d-block text-danger">
                                                    
                                                </a>
                                                <label for="" id="counter" class=" font-400 font-16 mt-3 d-block">
                                                    Resend OTP in <span class=" font-700 font-18 text-gn-sndy" id="otp-timer">26</span> sec
                                                </label>
                                            </div>
                                            <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                                <input type="submit" class="sub-btn  nextBTn"  id="otp-btn" Value="Verify OTP" >         
                                            </div>
                                            
                                        </div>     
                                            {{session()->get('consumer_name')}}
                                        </form>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>                           
                    <form action="{{URL::route('Get_Available_Category')}}" id="getAvailableCategory" method="post" hidden>
                        <button type="submit"></button>
                    </form>            
<!-- Login Modal end -->
<script>

const inputs = document.querySelectorAll(".otp-input");
button = document.querySelector("#otp-btn");

inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;

    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    if (e.key === "Backspace") {
      inputs.forEach((input, index2) => {
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }
  
    if (!inputs[5].disabled && inputs[5].value !== "") {
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});

window.addEventListener("load", () => inputs[0].focus());
    $(document).ready(function(){
        if("{{$users['booking-type']}}"==1){
            createMapFun("{{$users['pick_lat']}}","{{$users['pick_lng']}}",'{{env("APP_BASE_URL")}}assets/image/pick-icon.png',"Your pickup location",'map')
        }else{
            polyline_display("{{$users['pick']}}","{{$users['drop']}}","map");
        }

        // Ambulane quantity
   $('.quantity').attr('value',1);
   $('.quantity-right-plus').click(function(e){
        var quantity=0;
        e.preventDefault();
        e.stopPropagation();
        var ambuPrice=$(this).parent().parent().siblings().text()/parseInt($(this).parent().siblings('.quantity').val());
        const actualPrice=parseInt(ambuPrice);
        var qty_input=$(this).parent().siblings('.quantity');
        var quantity = parseInt(qty_input.val());
        qty_input.val(quantity + 1);
        ambuPrice=actualPrice*parseInt(qty_input.val());
        $(this).parent().parent().siblings().html('<i class="fa-solid fa-indian-rupee-sign ml-2"></i> '+ambuPrice);
        // console.log('hhh');
        all_selected_ambu_price();


    });

     $('.quantity-left-minus').click(function(e){
        // alert('decresin');\
        e.preventDefault();
        e.stopPropagation();
        var quantity=0;
        var ambuPrice=$(this).parent().parent().siblings().text();
        const actualPrice=$(this).parent().parent().siblings().text()/parseInt($(this).parent().siblings('.quantity').val());
        var qty_input=$(this).parent().siblings('.quantity');
        var quantity = parseInt(qty_input.val());
            if(quantity>1){
                qty_input.val(quantity - 1);
            }
           
             ambuPrice=actualPrice*parseInt(qty_input.val());
             $(this).parent().parent().siblings().html('<i class="fa-solid fa-indian-rupee-sign ml-2"></i> '+ambuPrice);
             all_selected_ambu_price();

    });



    // Loader for check availability start
    function getAvailableCategory(){
        // console.log("refresh category");
        url="{{URL::route('Get_Available_Category')}}";
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $.each(data.price_list, function(key, value) {
                    console.log(value.ambulance_category_type+":"+value.arrival_time);
                })
                $('.ambu-type-box').each(function(index,element){
                    var catId=$(this).attr('id');
                    // console.log(catId);
                    $.each(data.price_list, function(key, value) {
                        if(catId=="ambu_"+value.ambulance_category_type && value.avl_status=='0'){
                            $('#ambu_'+value.ambulance_category_type).removeClass('disabled-item');
                            // console.log($(this).html());
                            $('#ambu-dis-time-'+value.ambulance_category_type).html(value.arrival_time);
                          

                        }
                        else if(catId=="ambu_"+value.ambulance_category_type && value.avl_status=='1'){
                            $('#ambu_'+value.ambulance_category_type).addClass('disabled-item');
                            // console.log($(this).html());
                            $('#ambu-dis-time-'+value.ambulance_category_type).html(value.arrival_time);

                        }
                    })
                  
                });
                // console.log(data.price_list[0].ambulance_category_state_id);

            })
            .catch(error => {
                
                console.log(error);
                // alert('Error fetching data');
            });
    
        setTimeout(getAvailableCategory,5000);
    }
    setTimeout(getAvailableCategory,5000);

    // Loader for check availability end

        var consumer_name="<?php echo  session('consumer_name');?>";
        var consumer_id="<?php echo  session('consumer_id');?>";
        $('#loginBtn').prop('disabled', true);
        $('#loginBtn').click(function(){
            if(consumer_name=="" || consumer_id=="")
            {
                $('.varification-model').modal({
                    backdrop: 'static',
                    keyboard: false
                },'show');
            }
            else{
                // alert("already logged in "+consumer_name);
                $('.varification-model').modal('hide');
                var ambu_type=$('.selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
                var ambu_price=parseInt($('.selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text()); 
                var ambu_cat_type=$('.selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').attr('cat-type');
                total_ambu=$('.selected-ambulence-footer').html().split(' ')[0];
                total_price=parseInt($('.total-sel-ambu-price').text());
                if(total_ambu=='' || total_price==''){
                    total_ambu=1;
                    total_price=ambu_price;
                }
                else{
                    total_ambu=parseInt(total_ambu);
                    total_price=parseInt($('.total-sel-ambu-price').text());
                }
                // Sample JSON data
                var jsonData = {
                ambu_type: ambu_type,
                ambu_price: ambu_price,
                total_ambu: total_ambu,
                total_price:total_price,
                ambu_cat_type:ambu_cat_type,
                };
// jsonData=bulkAmbu();
// alert(jsonData['ambuTypes'][0].ambu_price);
// console.log(jsonData);
 //
                // URL to send the JSON data to
                var url = '{{url("/consumer/ambu_detail")}}';

                // Send the JSON data using the fetch() function
                fetch(url, {
                method: "POST",
                body: JSON.stringify(jsonData),
                headers: {
                    "Content-Type": "application/json"
                }
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response data
                    window.location.replace('{{ route("booking_page")}}');
                    console.log(data);
                })
                .catch(error => {
                    // Handle any errors
                    console.log(error);
                });
                // window.location.replace(''+"/"+ambu_type+"/"+ambu_price);         
            }
            if($(this).data('clicked')) {
                alert('Please select ambulance type!');
            }
        });
        if("{{$users['booking-type']}}"==0 || "{{$users['booking-type']}}"==1){
            $('.ambu-type-box').click(function(){
                // alert('normal');
                $('.ambu-type-box').removeClass('selected-ambu-type-box');
                var selectedClass=$(this).attr('class');
                $(this).attr('class', selectedClass+' selected-ambu-type-box');
                
                // $(this).attr('id', 'selected-ambu-type-box');
                $('#loginBtn').prop('disabled', false);
                $('.sub-btn').css('opacity','1');
            });
        }
        if("{{$users['booking-type']}}"==2){
            $('.bulk-ambu-type-box').click(function(){
                selectedClass=$(this).attr('class');
                if($(this).hasClass('selected-ambu-type-box')){
                    $(this).removeClass('selected-ambu-type-box');
                    var noPrice=$(this).children('.ambu-type-price-detail').children('.ambu-price').text();
                    var no=$(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val();
                    $(this).children('.ambu-type-price-detail').children('.ambu-price').text(parseInt(noPrice)/parseInt(no));
                    $(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val(1);


                }
                else{
                    $('.ambu-type-box').each(function(index,element){
                        if($(this).hasClass('selected-ambu-type-box')){
                            var no_of_sel_ambu=$(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val();
                            var totalPrice=$(this).children('.ambu-type-price-detail').children('.ambu-price').text();
                            $(this).children('.ambu-type-price-detail').children('.ambu-price').text(parseInt(totalPrice)/parseInt(no_of_sel_ambu));
                            $(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val(1);
                            console.log('true');
                        }
                        else{
                            console.log('false');
                        }
                    });
                    $('.bulk-ambu-type-box').removeClass('selected-ambu-type-box');
                    $(this).attr('class', selectedClass+' selected-ambu-type-box');

                }
                
                if($('.bulk-ambu-type-box').hasClass('selected-ambu-type-box')){
                    $('#loginBtn').prop('disabled', false);
                    $('.sub-btn').css('opacity','1');
                }
                else{
                    $('#loginBtn').prop('disabled', true);
                    $('.sub-btn').css('opacity','.6');
                }
                // var sel_ambu_price=parseInt($(this).children('.ambu-type-price-detail').children('.ambu-price').text()); 
                if($('.selected-ambu-type-box').length==0);{
                    $('.selected-ambulence-footer').html("");
                    $('.total-sel-ambu-price').html("");
                }
                all_selected_ambu_price();
                // $('#loginBtn').prop('disabled', false);
                // $('.sub-btn').css('opacity','1');
            });
        }
    });

    //set all amount
    function all_selected_ambu_price(){
        var total_bulk_ambu=0;
        var total_sel_amount=0;
        // console.log($('.ambu-type-box').hasClass('selected-ambu-type-box').length);
            if($('.selected-ambu-type-box').length>0){
                $('.ambu-type-box').each(function(index,element){
                    // alert("each loop");
                    if($(this).hasClass('selected-ambu-type-box')){
                        var no_of_sel_ambu=$(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val();
                        total_bulk_ambu=parseInt(total_bulk_ambu)+parseInt(no_of_sel_ambu); 
                        var totalPrice=$(this).children('.ambu-type-price-detail').children('.ambu-price').text();
                        total_sel_amount=parseInt(total_sel_amount)+parseInt(totalPrice);
                    }
                    
                });
                if(total_bulk_ambu>0){
                    $('.selected-ambulence-footer').text(total_bulk_ambu+" Ambulances selected");
                    $('.total-sel-ambu-price').html('<i class="fa-solid fa-indian-rupee-sign ml-2"></i> '+total_sel_amount);
                }
                else{
                    $('.selected-ambulence-footer').html("");
                    $('.total-sel-ambu-price').html("");
                }
            }
           
                
    }

    function bulkAmbu(){ 
        var ambudata=[],allData=[];
        if($('.selected-ambu-type-box').length>0){
                $('.ambu-type-box').each(function(index,element){
                    if($(this).hasClass('selected-ambu-type-box')){
                      alert(true);
                         ambu_type=$(this).children('.ambu-types-detail').children('.ambu-type-heading').text();
                         ambu_price=parseInt($(this).children('.ambu-type-price-detail').children('.ambu-price').text()); 
                         ambu_cat_type=$(this).children('.ambu-types-detail').children('.ambu-type-heading').attr('cat-type');
                         no_of_sel_ambu=$(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val();
                         totalPrice=$(this).children('.ambu-type-price-detail').children('.ambu-price').text();
                         if("{{$users['booking-type']}}"!=2){
                            no_of_sel_ambu=1;
                         }
                        var ambu = {
                            'ambu_type': ambu_type,
                            'ambu_price': ambu_price,
                            'ambu_cat_type':ambu_cat_type,
                            'ambu_qty':no_of_sel_ambu,
                            'ambu_price_per':ambu_price/no_of_sel_ambu,
                           
                            };
                        ambudata.push(ambu);
                    }
                    
                });
                allData['ambuTypes']=ambudata;
                token=$('#tokens').attr('content');
                total_ambu=$('.selected-ambulence-footer').html().split(' ')[0];
                total_price=$('.total-sel-ambu-price').text();
                if(total_ambu=='' || total_price==''){
                    total_ambu=1;
                    total_price=ambu_price;
                }
                else{
                    total_ambu=parseInt(total_ambu);
                    total_price=parseInt($('.total-sel-ambu-price').text());
                }
                allData['total_ambu']=total_ambu;
                allData['total_price']=total_price;
                // console.log(allData);
                return allData;
            }       
    }

    //login submit
    $('#loginForm').on('submit',function(e){
        e.preventDefault();
        let phone = $('#phone').val();
        var ambu_type=$('.selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
        var ambu_price=parseInt($('.selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text()); 
        var ambu_cat_type=$('.selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').attr('cat-type');
        token=$('#tokens').attr('content');
        total_ambu=$('.selected-ambulence-footer').html().split(' ')[0];
        total_price=parseInt($('.total-sel-ambu-price').text());
        // if(total_ambu=='' || total_price==''){
        if("{{$users['booking-type']}}"==2){
            total_ambu=parseInt(total_ambu);
            total_price=parseInt($('.total-sel-ambu-price').text());
        }
        else{
            total_ambu=1;
            total_price=ambu_price;
        }
        // if("{{$users['booking-type']}}"==2){
            // var ambu_data=[];
            // var c=0;
            // $('.bulk-ambu-type-box').each(function(){
                
            //     if($(this).hasClass('selected-ambu-type-box')){
                    // ambu_data[i]['ambu-type']= $(this).children('.ambu-types-detail').children('.ambu-type-heading').text();
                    // ambu_data[i]['ambu-type-total']= $(this).children('.ambu-type-price-detail').children('.ambu-type-quantity').children('.quantity').val();
                    // ambu_data[i]['ambu-type-total-price']= $(this).children('.ambu-type-price-detail').children('.ambu-price').text();
                    // ambu_data[i]['ambu-type-price']=ambu_data[i]['ambu-type-total-price']/ambu_data[i]['ambu-type-total'] ;
                //     total_ambu=$('.selected-ambulence-footer').html().split(' ')[0];
                // }
                // else{
                //     $(this).attr('class','selected-ambu-type-box');
                // }
                // i++;
            // })
        // }
        if(phone!="")
        {
            var jsonData = {
                ambu_type: ambu_type,
                ambu_price: ambu_price,
                total_ambu: total_ambu,
                total_price:total_price,
                ambu_cat_type:ambu_cat_type,
                phone:phone,
                };
        console.log(jsonData);
            $.ajax({
                url: "/login_varification",
                type:"POST",
                data:jsonData,
                beforeSend: function() { 
                    $("#verify-btn").prop('disabled', true); // disable button
                },
                success:function(response){ 
                    console.log(response);
                    // $('#login-message').html(response.phone[0]);
                    $("#phone").focus();
                    if(response.code==0){
                        $('#loginForm').css('display','none');
                        countdown(30);
                        $('#otpForm').css('display','flex');
                        // $("#otp-message").html(response.otp);
                    }
                    else if(response.code==1){
                        $('#loginForm').css('display','none');
                        $('#registerForm').css('display','flex');
                        $("#register-message").html(response.message);
                    }
                    else{
                        $(".error-message").html(response.message);
                    }
                    console.log(response);
                    $("#verify-btn").prop('disabled', false); // enable button
                    $("#loginForm")[0].reset();   
                },
                error: function(response) {
                    $(".error-message").html(response.message);
                    console.log(response);
                },
            });
        }
        else
        {
            alert("Please enter your mobile number");
            $('#phone').focus();
            $(".error-message").html("Please enter your mobile number to proceed");
        }
    });
  
   //login submit
    $('#otpForm').on('submit',function(e){
        e.preventDefault();
        var otpInputs = document.getElementsByClassName("otp-input");
        var otpValues = '';
        for (var i = 0; i < otpInputs.length; i++) {
            otpValues=otpValues+otpInputs[i].value;
        }
        // Process the OTP values as needed
        let input_otp=parseInt(otpValues);
        console.log(parseInt(otpValues));        
        $('#otp').focus();
        let token=$('#otp_tokens').attr('content');
       
        if(input_otp!=""){
                $.ajax({
                    url: "/otp_match",
                    type:"POST",
                    data:{_token:token,otp:input_otp},
                    success:function(data)
                    {   if(data.status==0){
                        $(".otp-message").html(data.message);
                        $("#otp-btn").prop('disabled', false); // enable button
                        $("#otpForm").html(data.message);
                        $('#welcome-user').append("<b>"+data.consumer_name+"</b>");
                        // alert(data.message);
                        window.location.replace('{{route("booking_page")}}');
                        // console.log(data);
                    }
                    else{
                        console.log(data);
                        $('#wrong-otp-mess').html(data.message);
                        $('.otp-input').val('');
                        $('.otp-input').css('border-color','#E42222');
                    }
                    },
                    error: function(response) 
                    {
                        alert(response.message);
                        $(".otp-message").html(response.message);
                        console.log(response);
                    },
                });
            // }
            // else if(input_otp!=otp)
            // {
            //     alert("otp not matched!");
            //     $('#otp').focus();
            //     // $("#otp-message").html("otp not matched!"); 
            // }
            // else
            // {
            //     alert("please enter otp for proceed");
            //     $('#otp').focus();
            //     // $("#otp-message").html("Please enter otp for proceed");
            // }
        }
        else{
            alert("please enter otp for proceed");
            $('#otp').focus();
        }
    });


    //otp verification end


    // resend OTP request start
    $('#resend-otp').click(function(e){
        alert("{{session('consumer_mob')}}");
        e.preventDefault();
        $.ajax({
            url:'{{route('login_verification.Resendotp')}}',
            type:'post',
            data:{mob:"{{session('consumer_mob')}}",},
            success:function(response){
                // $('#counter').html('');
                // $('#otp-timer').html(' Resend OTP in <span class=" font-700 font-18 text-gn-sndy" id="otp-timer"></span>');
                // countdown(10);
                alert('Otp sent successfully');
                console.log(response);
            },
            error:function(response){
                alert('Failed to send otp! Please try again.');
            }
        });
    });
    // resend OTP request end
    $('#registerForm').on('submit',function(e){
        e.preventDefault();
        let name = $('#name').val();
        var ambu_type=$('#selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
        var ambu_price=parseInt($('#selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text());
        token=$('#reg_tokens').attr('content');
        // alert(ambu_type+ambu_price);
        if(name!="")
        {
            $.ajax({
                url: "/consumer/register_user",
                type:"POST",
                data:{_token:token,name:name,ambu_type:ambu_type,ambu_price:ambu_price},
                beforeSend: function() { 
                    $("#proceed-btn").prop('disabled', true); // disable button
                },
                success:function(regResponse){ 
                    $("#phone").focus();
                    if(regResponse.status==0){
                        $('#registerForm').css('display','none');
                        $('#otpForm').css('display','flex');
                        countdown(30);
                        $("#otp-message").html(regResponse.otp);
                    }
                    else if(regResponse.status==1){
                        $('#registerForm').css('display','flex');
                        $("#register-message").html(regResponse.message);
                    }
                    else{
                        $(".error-message").html(regResponse.message);
                    }    
                    $("#welcome-user").html(regResponse.consumer_name);
                    console.log(regResponse);
                    $("#proceed-btn").prop('disabled', false); // enable button
                    $("#registerForm").html(regResponse.message);
                },
                error: function(regResponse) {
                    alert("name not matched!");
                    $('#name').focus();
                    $(".register-message").append("<br>"+regResponse.message+"<br/>");
                    console.log(regResponse);
                },
            });
        }
        else{
            alert("Please enter your name");
            $('#name').focus();
            $(".register-message").html("Please enter your name to proceed");
            }
    });

    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
        // calculateAndDisplayRoute(directionsService, directionsDisplay);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
        origin:"{{$users['pick']}}",
        destination: "{{$users['drop']}}",
        travelMode: 'DRIVING'
        }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            console.log(directionsDisplay);
        } 
        else {
            window.alert('Directions request failed due to ' + status);
        }
        });
    }
    
</script>
@endsection

