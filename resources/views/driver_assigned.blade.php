
@extends('layouts.configLayout')
@section('title','Medcab:driver')
@section('main')
<?php if(Session::has('users'))
{
    $users=Session::get('users');
}
$booking_detail=$data[0]['booking_details'][0];
$addons='';
$addons=$data[0]['specialist_list_rate'];
$location=$data[0]['live_location_details']['live_location'][0];
// $location='';

?>

<div class="booked-driver-container container h-100 d-flex justify-content-start flex-column align-items-start">
    <div class="back-move mb-3">
    <a href="{{route('Home')}}" class="move-page-btn mb-4"><i class="fa-solid fa-arrow-left"></i>
            @if($users['booking-type']==0)
                Emergency Ambulance Booking
            @elseif($users['booking-type']==1)
                Rental Ambulance Booking
            @elseif($users['booking-type']==2)
                Bulk Ambulance Booking
            @endif
    </a>
    </div>
    <div class="booking-driver-detail w-100">
        <div class="row  gx-4 gy-4">
            <div class="col-md-5 p-0 booking-detail-right">
                <div class="booked-detail">
                    <div class="top-header-1">
                        <p class="top-header-text">Start your order with PIN:{{$booking_detail['otp']}} </p>
                        <button class="ride-cancel-btn btn-click-effect"  data-bs-toggle="modal" data-bs-target="#cancelRide" cancel-ride-id="{{$booking_detail['booking_id']}}">Cancel</button>
                    </div>
                    <div class="top-header-2">
                        <p class="driver-ambu-type">{{$booking_detail['booking_category_name']}} <i class="fas  fa-light fa-circle-exclamation"></i></p>
                        <span class="arriving-time-text">Arriving in {{$booking_detail['acc_to_pick_duration']}}</span>
                    </div>
                    <div class="driver-details">
                        <div class="driver-profile">
                            <img src="{{URL::to('/')}}/assets/driver/driver.png" alt="Driver Marker" class="h-100 w-100">
                        </div>
                        <div class="driver-info">
                            <p class="driver-ambu-no">{{$booking_detail['booking_vehicle_rc_no']}}</p>
                            <p class="driver-name">{{$booking_detail['booking_driver_name']}}</p>
                            <p class="driver-mobile-no">{{$booking_detail['booking_driver_mobile']}}</p>
                        </div>
                    </div>
                    <div class="driver-contact-btn">
                        <a href="" class="driver-btn btn-click-effect" id="message-driver" data-bs-toggle="modal" data-bs-target="#driverChat">Message</a>
                        <a href="tel:{{$booking_detail['booking_driver_mobile']}}" class="driver-btn btn-click-effect" id="call-driver">Call</a>
                    </div>
                    <!--Addons List-->
                            
                            <?php 
                            
                            if(sizeof($addons)){ 
                                ?>
                            <div class="underline-divider"></div>
                            <div class="invoice-booking-type w-100">
                                <h1 class="invoice-sub-heading">Ambulance Support</h1>
                                <div class="invoice-booking-list-box">
                               <?php  foreach($addons as $addon){
                                    
                                    ?>
                                        <div class="invoice-booking-list-item">
                                            <div class="invoice-booking-type-img" >
                                                 <img src="https://dev.cabmed.in/{{$addon['addons_icon']}} " alt="{{$addon['addons_name']}} " style="height:100px;width:100px;" class="h-100 w-100"> 
                                            </div>
                                            <div class="invoice-booking-types-detail">
                                                <h4 class="invoice-type-heading">
                                                   {{$addon['addons_name']}} <span></span>
                                                </h4>
                                                <a class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#basic"> Read more</a>
                                            </div>
                                            <div class="invoice-booking-type-price ml-auto">
                                                <span class=""><i class="fa-solid fa-indian-rupee-sign mr-1"></i>
                                                   {{$addon['addons_price']}}
                                                </span>
                                            </div>
                                        </div>
    
                                <?php     
                                        
                                    }?>
                                </div>
                            </div>
                               <?php }
                                
                                ?>

                    <!--Addons List-->
                    
                    <div class="underline-divider"></div>
                    <div class="location-detail">
                        <div class="location-icon-left">
                            <div class="pickIcons">
                                <span class="d-pick-icon border-0"><img src="{{url('/assets/image/pickup-icon.png')}}" alt="Pickup Address Icon"></span>
                                <span class="location-connector"></span>
                            </div>
                            <div class="pick-location">
                                <h4 class="location-type">Pickup Location</h4>
                                <p class=" pick-address">{{$booking_detail['pickup_address']}}</p>
                            </div>
                        </div>
                        <div class="location-name-detali">
                            <span class="d-dest-icon border-0"><img src="{{url('/assets/image/drop-icon.png')}}" alt="Drop Address Icon"></span>
                            <div class="drop-location">
                                <div class="location-type">
                                    <h4>Drop Location</h4>
                                    @if($booking_detail['booking_type']!=1)
                                    <a href="" class="change-location"><i class="mr-2 fa-solid fa-pencil"></i>Change Location</a>
                                    @endif
                                </div>
                                <p class=" drop-address" title="Drop Location">
                                        {{$booking_detail['drop_address']}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="underline-divider"></div>
                    <div class="payment-detail">
                        <h4 class="pay-heading">Payment</h4>
                        <span class="price-detail">
                            <span>Total Charge</span>
                            <span class="total-payment"><i class="fa-solid fa-indian-rupee-sign"></i>{{$booking_detail['total_amount']}}</span>
                        </span>
                    </div>
                    <div class="dashed-divider"></div>
                   
                        <?php 
                        if($booking_detail['payment_type']<3){?>
                         <div class="payment-detail-type">
                            <p class="payment-type-name"><i class="fa-solid fa-circle-check"></i>
                           <?php if($booking_detail['total_amount']==session('payAmount')){
                                echo "Full Payment";
                                $paid_amount=$booking_detail['total_amount'];
                            }
                            
                            else{
                                echo "Advanced Payment"; 
                                $paid_amount=$booking_detail['advance_amount'];
                            }?>
                            </p>
                            <a href="" class="payment-status-btn" style="background: #42A646;">Done</a>
                            <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>{{$paid_amount}}</p>
                        </div>
                        <div class="dashed-divider"></div>
                     <?PHP
                        }
                        ?>
                   
                    
                    @if($booking_detail['payment_type']>=2)
                    <div class="payment-detail-type">
                        <p class="payment-type-name"><i class="fas fa-thin fa-circle-exclamation"></i>Remaining Payment</p>
                        <a href="" class="payment-status-btn" style="background: #D8712A;">Pending</a>
                        <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>
                       <?php 
                    //    if($booking_detail['payment_type']==2){
                    //         echo $booking_detail['total_amount']-$booking_detail['advance_amount'];
                    //    }
                    //    else if($booking_detail['payment_type']==3){
                    //       echo $booking_detail['total_amount'];
                    //    }
                        echo $booking_detail['remaining_amount'];
                        ?>
                        </p>
                    </div>
                    <div class="dashed-divider"></div>
                    @endif
                    <div class="payment-methods">
                        <a  class="pay-in-case btn-click-effect" id="pay-case">
                            <span class="circle"></span>
                            <i class="fa-solid fa-circle-check pay-check"></i>
                            Pay in cash
                        </a>
                            
                        <form action="https://medcab.in/assets/cc_pay_soni/ccavRequestHandler.php" method="post" id="payForm">
                            
                            <input type="text" name="consumer_id" hidden value="{{$booking_detail['consumer_id']}}">
                            <input type="text" name="booking_id" hidden value="{{$booking_detail['booking_id']}}">
                            <input type="text" name="merchant_id" hidden value="2566639">
                            <input type="text" name="order_id" hidden value="MEDCAB{{$booking_detail['booking_id'].rand(100,999)}}">
                            <input type="text" name="amount" id="pay-amount" hidden value="{{$booking_detail['remaining_amount']}}">
                            <input type="text" name="merchant_param4" hidden value="1">
                            <input type="text" name="currency" hidden value="INR">
                            <input type="text" name="merchant_param1" hidden value="{{$booking_detail['consumer_id']}}">
                            <input type="text" name="merchant_param2" hidden value="{{$booking_detail['booking_id']}}">
                            <input type="text" name="merchant_param3" hidden value="https://medcab.in/driver/driver_assigned/{{$booking_detail['booking_id']}}">
                            <input type="text" name="redirect_url" value="https://medcab.in/assets/cc_pay_soni/ccavResponseHandler.php" hidden/>
                            <input type="text" name="cancel_url" value="https://medcab.in/assets/cc_pay_soni/ccavResponseHandler.php" hidden/>

                            <button type="submit" class="pay-now pay-now-remain w-110 modal-button-solid btn-click-effect">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
             <div class="col-md-7 booking-detail-map p-md-3 px-sm-0">
                <div class="show-map h-100 w-100" id="show-map" onload="drawPolyline({{$booking_detail['acc_to_pick_polilyne']}},'show-map')">
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- message chat box -->
<div class="modal driver_chat p-3" id="driverChat" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content chatBox">
            <div class="modal-header border-0">
                <div class="chatBox-header">
                    <div class="chat-profile">
                        <img src="" alt="Driver Profile">
                    </div>
                    <div class="driver-name-status">
                        <h4 class="chat-driver-name">Cab No. Here</h4>
                        <p class="chat-driver-status">Active</p>
                    </div>
                </div>                     
            </div>
            <div class="modal-body ">
                <div class="chat-body-container">
                    <div class="chat-body">
                            <div class="driver-chat outgoing-message">
                            <span class="chat-message">Hello {{$booking_detail['c_name']}}!</span>
                            <span class="chat-time">
                                    <?php 
                                        $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
                                        echo $dateTime->format("H:i A"); 
                                    ?>
                            </span>
                            </div>  
                            <div class="driver-chat incoming-message">
                            <span class="chat-message">Hello {{$booking_detail['booking_driver_name']}}</span>
                            <span class="chat-time">
                                    <?php 
                                        $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
                                        echo $dateTime->format("H:i A"); 
                                    ?>
                            </span>
                            </div>                                                   
                    </div>
                    <textarea name="" id="" cols="30" rows="10" class="chat-input-box" placeholder="Type a message"></textarea>    
                </div>
                <div class="modal-footer flex-nowrap border-0 justify-content-center">
                    <button type="button" class="chat-back-btn chat-btn"  data-bs-dismiss="driver_chat">Back</button>
                    <button type="button" class="chat-send-btn chat-btn" >Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- message chat box end -->

<!-- Cancellation start-->
<x-cancellation/>
<!-- Cancellation end -->

<!-- Cancel Ride Modal Start -->
<div class="modal p-3" id="completedRide" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-box b-0">
            <div class="modal-body cancel-box-body ">
                <div class="sqr color-light-green">
                <span class="circle-right color-light-green border-2 " >
                    <i class="fa-solid fa-check"></i>
                    </span>
                </div>
                
                <h2>Your Ride has been completed.</h2>
            </div>
             <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="cancel-yes-btn btn-trans" data-bs-toggle="modal"  id="doneForInvoice" >Done</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Cancel Ride Modal End -->

<!-- Rating Modal start -->

<div class="modal p-5" id="rating-modal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog rating-container modal-dialog-centered" role="document">
        <div class="modal-content h-100 rating b-0">
            <div class="modal-header rating-header b-0">
                <h2 class=" text-center"><i class="fa-solid fa-circle-check"></i>Ride Completed Successfully</h2>
                <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>{{$booking_detail['total_amount']}}</p>
            </div>
            <div class="modal-body rating-body "> 
                <div class="rating-star">
                    <div class="rating-user-profile">
                        <img src="" alt="User profile">
                    </div>    
                    <p>How was your ride with {{$booking_detail['booking_driver_name']}}?</p>     
                    <div class="rating-stars">
                        <?php 
                        $s=1;
                        while($s<=5){
                            ?>
                        <i class="fa-regular fa-star r-star" id="star-{{$s}}"></i>
                        
                        <?php
                        
                         $s++;   
                        }
                        ?>
                    </div> 
                </div>  
                <div class="rating-option">
                    <p>What was Experience?</p>
                    <div class="rating-option-list">
                        @if(!empty($rating_list))
                            @foreach($rating_list as $rating)
                            <button class="rating-option-btn" data-id="{{$rating->br_text_ctd_id}}">{{$rating->br_text_ctd_text}}</button>
                            @endforeach
                       @endif
                    </div>
                </div> 
                <textarea name="" id="" cols="30" rows="1" class="rating-message" name="other-reason" placeholder="Write here if you have anything in our mind"></textarea>  
            </div>
            <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="rating-submit-btn btn-trans w-70"  data-bs-dismiss="modal">Submit</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Rating Modal end -->

<!-- invoice modal start -->

<div class="modal fade top-slide" id="payModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header color-success">
        <!-- <h5 class="modal-title" id="myModalLabel">Booking Payment</h5> -->
       <div class="d-flex-center align-items-center">
       <div class="rating-user-profile m-2 ">
                        <img src="{{asset('assets/image/driver_icon.png')}}" alt="Driver Icon" class="h-100 w-100">
                    </div>    
                    <p class="p-text text-white m-0"> {{$booking_detail['booking_driver_name']}}</p>  
       </div>   
        <button type="button" class="close close-x-mark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <p class="p-text font-500 font-18 ">
        <?php if($booking_detail['payment_type']==2){
                echo "Remaining Amount";
            }
            else if($booking_detail['payment_type']==3){
                echo "Total Amount";
            }
            else{
                echo "Total Paid Amount";
            }
        ?>           
        </p>
        <p class="font-20 font-800 fx-2 remain-amount"></p>
      </div>
      <div class="modal-footer paymodal-footer flex-nowrap border-0 justify-content-center">
            <button type="button" class="modal-button-transaprent pay-in-case   w-50"  data-dismiss="modal" aria-label="close" data-bs-dismiss="modal">PAY CASH</button>
            <button type="button" class="modal-button-solid  w-50 pay-now-final" id="pay-done-btn" data-bs-dismiss="modal">PAY NOW</button>
      </div>
    </div>
  </div>
</div>

<!-- invoice modal end -->
<script>


    window.onload = function() {
            $('.pay-now-final').click(function(){
                $("input[name='merchant_param4']").val(2);
                $('#payForm').submit();
            });
        
        var pickLoc=parseFloat("{{$booking_detail['pick_lat']}}")+','+parseFloat("{{$booking_detail['pick_long']}}");
        var dropLoc=parseFloat("{{$booking_detail['drop_lat']}}")+','+parseFloat("{{$booking_detail['drop_long']}}");
        var driverLoc={lat:parseFloat("{{$location->driver_live_location_lat}}"),lng:parseFloat("{{$location->driver_live_location_long}}")};
        
        var pick_icon='https://medcab.in/assets/image/pick-icon.png';
        var drop_icon='https://medcab.in/assets/image/drop-icon.png';
        var driver_icon='https://medcab.in/assets/image/ambulance.png';
                const map = new google.maps.Map(document.getElementById("show-map"), {
                    zoom: 18,
                    center: {lat: 26.863302, lng: 81.0015002}
                });
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    polylineOptions: {
                    strokeColor: '#2196f3' 
                    },
                    map: map,
                    suppressMarkers: true ,
                });
                function calculateAndDisplayRoutes(directionsService, directionsDisplay,origin,destination,marker2,title2) {           
                    directionsService.route({
                    origin:origin,
                    destination:destination,
                    travelMode: 'DRIVING',
                    }, function(response, status) {
                        if (status === 'OK') {
		                    directionsDisplay.setDirections(response);
                            var steps = response.routes[0].legs[0].steps;
                            for (var i = 0; i < steps.length; i++) {
                            var step = steps[i];

                                if(i==0){
                                    console.log(steps[i]);
                                    var marker = new google.maps.Marker({
                                        position: step.start_location,
                                        map: map,
                                        title: "Consumer Pickup location",
                                   
                                        icon: {
                                        url:pick_icon , 
                                        scaledSize: new google.maps.Size(25, 25),
                                        },
                                    });
                                }
                                if(i == steps.length-1){
                                 console.log(steps[i]);
                                    var marker = new google.maps.Marker({
                                        position: step.end_location,
                                        map: map,
                                        title: title2,       
                                        icon: {
                                        url: marker2,
                                        scaledSize: new google.maps.Size(25, 25), 
                                        origin:{x:1,y:1}
                                        },
                                    });
                                }
                                
                            }
                                            
                        } 
                        else {
                            console.log('Directions request failed due to ' + status);
                        }
                    });
                }
                var i=0;
                var driverMarker = new google.maps.Marker({
                    position:driverLoc,
                    map: map,
                    title: "Driver comming location",
                    icon: {
                    url: 'https://medcab.in/assets/image/ambulance.png', 
                    scaledSize: new google.maps.Size(30, 30), 
                    },
                });
        var isFirstIteration = true;
        
          
        calculateAndDisplayRoutes(directionsService, directionsDisplay,pickLoc,driverLoc,driver_icon,"driver location");
        function getDriverLocation(){
        // var isFirstIteration = true;

            var i=0;
            var url=window.location.href;
            var booking_id=url.split('/')[url.split('/').length-1];
                $.ajax({
                url: '{{url("/driver/get-driver-live-location")}}',
                method: 'POST',
                data:{driver_id:"{{$location->driver_live_location_d_id}}",booking_id:"{{$booking_detail['booking_id']}}"
                },
                success: function(response) {
                    console.log(response);
                    var driverLoc={ lat:parseFloat(response.dvr_lat),lng:parseFloat(response.dvr_lng)};
                    // 

                    if(response.payment_status==2){
                        $('.payment-methods').html('<button type="button" class="modal-button-solid btn-success   w-100" >Paid</button>');

                    }
                    if(response.accept_status=='1' && response.booking_status=='2'){
                        console.log('not reached');
                        driverMarker.setPosition(driverLoc);
                    }
                    else if(response.accept_status=='0' && response.booking_status=='2'){
                            // console.log("Booking accepted");
                            if("{{session('users.booking-type')}}"==1){
                                
                                driverMarker.setPosition(driverLoc);
                                console.log('driverMar ker for rental');
                                // console.log(response);
                                if(isFirstIteration==true){
                                    alert('isFisrtIteration is true.');
                                    var directionsService = new google.maps.DirectionsService;
                                    var directionsDisplay = new google.maps.DirectionsRenderer({
                                        polylineOptions: {
                                        strokeColor: 'Transparent', 
                                        },
                                        map: null,
                                        // suppressMarkers: true ,
                                    });
                                    calculateAndDisplayRoutes(directionsService, directionsDisplay,pickLoc,driverLoc,driver_icon,"driver location");
                                    isFirstIteration = false;
                                
                                } 
                            }
                            else{
                                driverMarker.setPosition(driverLoc);

                                console.log('driverMarker for other'+isFirstIteration);
                                if(isFirstIteration==true){
                                    var directionsService = new google.maps.DirectionsService;
                                    var directionsDisplay = new google.maps.DirectionsRenderer({
                                        polylineOptions: {
                                        strokeColor: '#2196f3' 
                                        },
                                        map: map,
                                        suppressMarkers: true ,
                                    });
                                    console.log("driverMarker for othern  iggggg");
                                    calculateAndDisplayRoutes(directionsService, directionsDisplay,pickLoc,dropLoc,drop_icon,"Consumer drop location");
                                    isFirstIteration = false;
                                } 
                            }
                    }
                    else if(response.accept_status=='0' && response.booking_status=='3'){
                        $('.remain-amount').html('<i class="fa-solid fa-indian-rupee-sign mr-1 "></i> '+response.remaining);
                        
                        if(response.payment_status==2){
                            $('.paymodal-footer').html('<button type="button" class="modal-button-solid    w-100"  data-dismiss="modal" aria-label="close" data-bs-dismiss="modal">Amount Paid</button>');
                        }
                        if(i==0){
                            $('#payModal').modal('show');
                            i++;
                        }
                    }
                    else if(response.accept_status=='0' && response.booking_status=='4'){
                        var options = {
                                    "backdrop" : "static",
                                    "show":true,
                                };
                            $('#completedRide').modal('show');
                            $('#payModal').modal('hide');
                            $('#completedRide').modal(options);
                            $('#doneForInvoice').click(function(){
                                window.location.replace('https://medcab.in/consumer/get-invoice/{{$booking_detail["booking_id"]}}');
                            });
                    }
                    else{
                        console.log('Ride cancelled By {{$booking_detail["booking_driver_name"]}}');
                    }
                    setTimeout(getDriverLocation, 2000);
                },        
                error: function(xhr) {
                    alert('Faild to search driver!');
                    console.error(xhr);
                }
            });   
        }
        getDriverLocation();
        $('#pay-case').click(function(){
            $('.circle').toggle();
            $('.pay-check').toggle();
        });
        $('.chat-back-btn').click(function(){
            $('#driverChat').modal('hide');
        });
    }
</script>
@endsection