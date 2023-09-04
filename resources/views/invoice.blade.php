@extends('layouts.configLayout')
@extends('layouts.header')
@section('title',"Booking Invoice | Ambulance service")
@section("main")
    <div class="booking-invoice-page">
		<section class="booking-page-section py-5">
			<div class="container">

				<div class="row">
					<div class="col-lg-6 col-md-8 mx-auto">
						<div class="container pt-5">
							<a href="{{route('home_page')}}" class="navigation vertical-center font-600"><i class="fa-solid fa-arrow-left me-2"></i>
                            @if($booking_details['booking-type']==0)
                                Emergency Ambulance Booking
                            @elseif($booking_details['booking-type']==1)
                                Rental Ambulance Booking
                            @elseif($booking_details['booking-type']==2)
                                Bulk Ambulance Booking
                            
                            @endif
                        </a>
						</div>
						<!-- ---- card ---- -->
						<div class="card2 basic-info-wrapper ride-info mb-2">										
							<span class="font-18 text-uppercase font-600 d-block text-success my-2 my-4">Ride Details</span>
							<div class="rider-profile-details vertical-center">
								<div class="img-thumb" style="width:80px; height: 80px; margin-right: 18px;">
									<img src="" alt="">
								</div>
								<div class="details">
									<h3 class="font-22 font-600">{{$booking_details['driver_name']}}</h3>
									<small class="d-block text-muted font-13">Trips:{{$booking_details['driver_total_trips']}}  | {{$booking_details['driver_avg_rating']}} <span class="star text-warning">★</span></small>
								</div>
							</div>
							<div class="row my-3">
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Date</small><span class="d-block font-15 font-600">
                                        <?php 
											echo explode(",",$booking_details['schudle_time'])[0];
										?>
                                    </span>
								</div>
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Pickup Time</small><span class="d-block font-15 font-600">
                                        <?php 
                                            echo date('h:i a',$booking_details['pickup_time']);
                                        ?>
                                    </span>
								</div>
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Rent Hours</small><span class="d-block font-15 font-600">
                                        <?php 
                                            if($booking_details['booking_type']==1){
                                                if($booking_details['booking_type_for_rental']==0){
                                                    echo $booking_details['duration'].'Hours'; 
                                                    $suffix='Hours';
                                                }
                                                else{
                                                     echo $booking_details['duration'].'Days';
                                                    $suffix='Days';

                                                }
                                            }
                                            else{
                                               echo $booking_details['duration'].'KM';
                                               $suffix='KM';

                                            }
                                        ?>
                                    </span>
								</div>
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Vehicle No.</small><span class="d-block font-15 font-600">
                                        {{$booking_details['driver_vehicle_no']}}
                                    </span>
								</div>
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Ride ID</small><span class="d-block font-15 font-600">
                                    {{$booking_details['booking_id']}}
                                    </span>
								</div>
							</div>				
						</div>
						<!-- ---- card ---- -->
						<div class="card2 booking-details mb-2">										
							<span class="font-18 text-uppercase font-600 d-block text-success my-2 my-4">Bookings</span>
							<h3 class="font-18 vertical-center my-2 mt-4"><span class="rectangle"></span></h3>
							<div class="my-2 mt-4">

								<span class="font-15 vertical-center mb-4"><span class="pickup"></span>
									<p>
										<span class="d-block font-500">Pickup</span>{{$booking_details['pickup_address']}}	</p>
								</span>

								<span class="font-15 vertical-center mb-1">
									<span class="drop"></span>
									<p>
										<span class="d-block font-500">Drop</span>
                                        @if($booking_details['booking_type']==1)
                                            {{'Rental for'.$booking_details['duration'].$suffix}}
									</p> 
								</span>
							</div>
                            <?php 
                        
                        if(Session::get('booking_addons')){
                            foreach($booking_addons as $addon){?>
							<div class="vertical-center justify-between my-4">
								<h3 class="font-16 font-500 vertical-center m-0"><span class="rectangle"></span>{{$addon['addons_name']}}</h3>
								<span class="d-block">{{$addon['addons_price']}} </span>
							</div>
                            <?php }}?>
							
						</div>
						<!-- ---- card ---- -->
						<div class="row invoice-content-wrapper">
							<div class="card2 col-md-12 ms-0 basic-info-wrapper container p-2 px-4 mb-3">										
								<span class="font-18 text-uppercase font-600 d-block text-success my-2 my-4">Invoice</span>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">{{$booking_details['booking_category_name']}}</p>
									<span class="d-block">{{$booking_details['amount']}}</span>
								</div>
                                
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Doctor Specialist</p>
									<span class="d-block">₹800</span>
								</div>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Nurse</p>
									<span class="d-block">₹300</span>
								</div>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Service Charge</p>
									<span class="d-block">{{$booking_details['service_charge']}}</span>
								</div>
								<!-- <div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Extra Km (4 km x Rs 8)</p>
									<span class="d-block">₹81</span>
								</div>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Extra time Taken</p>
									<span class="d-block">₹21</span>
								</div> -->
								<div class="coupon-code">
									<div class="vertical-center justify-between text-success">
										<h3 class="font-16 vertical-center my-2 mt-4"><i class="fa-solid fa-tags me-2"></i> Discount Applied</h3> <span class="d-block font-500">-0</span>
									</div>
								</div>
								<div class="total-cost dotted-spaced-top mt-4 pt-4">
									<div class="vertical-center justify-between dotted-spaced-bottom pb-4">
										<h3 class="font-16 m-0">TOTAL AMOUNT</h3> <span class="d-block font-500">{{$booking_details['total_amount']}}</span>
									</div>
								</div>
								<div class="payment-status py-4">
									@if($booking_details['payment_type']==2)
                                    <div class="vertical-center justify-between">
										<h3 class="font-18 vertical-center my-2 mt-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Advance Payment:&nbsp;<span class="text-success">
                                            @if($booking_details['payment_type']<=2)
                                            Paid Online
                                            @endif
                                        </span></h3> <span class="d-block font-500">{{$booking_details['advance_amount']}}</span>
									</div>	
                                    @else if($booking_details['payment_type']==1)
                                    <div class="vertical-center justify-between">
										<h3 class="font-18 vertical-center my-2 mt-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Full Payment:&nbsp;<span class="text-success">
                                            @if($booking_details['payment_type']<=2)
                                            Paid Online
                                            @endif
                                        </span></h3> <span class="d-block font-500">{{$booking_details['amount']}}</span>
									</div>	
                                    
                                    @endif
                                    
									<div class="vertical-center justify-between">
										<h3 class="font-18 vertical-center my-2 mt-4"><i class="fa-solid fa-circle-check text-success me-2"></i> Remaining Payment:&nbsp;<span class="text-success">
                                            Paid Offline</span></h3>
                                            <span class="d-block font-500">
                                            @if($booking_details['payment_type']==2)    
                                            {{$booking_details['amount']-$booking_details['advance_amount']}}
                                    @endif										

                                        </span>
									</div>
								</div>
								<div class="button-group text-center mt-4">
									<a href="" class="btn btn-outline-primary me-2" style="max-width: 160px; width:100%;">DOWNLOAD</a>
									<a href="" class="btn btn-outline-primary" style="max-width: 160px; width:100%;">SHARE</a>
								</div>
							</div>
						</div>


						<!-- <div class="card p-4 mad-border-radius overflow-hidden items-wrapperq">
							<h2 class="font-700 font-24 mb-3">Select Bulk Ambulance</h2>
						</div> -->
					</div>
				</div>
			</div>
		</section>
	</div>
    <div class="booked-invoice-container container h-100 d-flex justify-content-start flex-column align-items-start" id="invoice"  >
    <div class="back-move mb-3">
    <a href="" class="move-page-btn mb-4"><i class="fa-solid fa-arrow-left"></i>
        @if($booking_details['booking_type']==0)
                Emergency Ambulance Booking
            @elseif($booking_details['booking_type']==1)
                Rental Ambulance Booking
            @elseif($booking_details['booking_type']==2)
                Bulk Ambulance Booking
            
            @endif
    </a>
    </div>
    <div class="booking-invoice-detail w-100" >
        <div class="row  justify-content-center" >
            <div class="col-md-5 invoice-detail" >
                <h4 class="invoice-sub-heading text-center">Ride Invoice</h4>
                <div class="invoice-ride-details">
                    <p class="ride-date">
                        <span class="ride-date-name">Ride Date</span>
                        <span class="ride-date-text">{{$booking_details['schudle_time']}}</span>
                    </p>
                    <p class="ride-id">
                        <span class="ride-id-name">Ride ID</span>
                        <span class="ride-id-text">{{$booking_details['driver_vehicle_no']}}</span>

                    </p>
                </div>
                <div class="underline-divider"></div>
                <div class="invoice-booking-type">
                    <h1 class="invoice-sub-heading">Booking Type</h1>
                    <div class="invoice-booking-list-box">
                        <div class="invoice-booking-list-item">
                            <div class="invoice-booking-type-img" >
                                <!-- <img src="assets/catagory_icon/amb_icon.png" alt="" style="height:100px;width:100px;"> -->
                            </div>
                            <div class="invoice-booking-types-detail">
                                <h4 class="invoice-type-heading">
                                   {{$booking_details['booking_category_name']}}
                                </h4>
                                <a class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#basic"> Read more</a>
                            </div>
                            <div class="invoice-booking-type-price ml-auto">
                                <p class=""><i class="fa-solid fa-indian-rupee-sign mr-1"></i>
                                {{$booking_details['remaining_amount']}}
                                </p>
                            </div>
                        </div>
                        <?php 
                        
                        // if(Session::get('booking_addons')){
                            foreach($booking_addons as $addon){
                                
                                // if($addon->booking_addons_status=='0' ){
                                ?>
                                    <div class="invoice-booking-list-item">
                                        <div class="invoice-booking-type-img" >
                                            <!-- <img src="assets/catagory_icon/amb_icon.png" alt="" style="height:100px;width:100px;"> -->
                                        </div>
                                        <div class="invoice-booking-types-detail">
                                            <h4 class="invoice-type-heading">
                                               {{$addon['addons_name']}} <span>(Ambulance Support)</span>
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
                                // }    
                            }
                        // }
                            
                        ?>
                    </div>
                </div>
                <div class="underline-divider"></div>
                <div class="invoice-total-amount b-0">
                    <span>Total Amount</span>
                    <span class="t-amount"><i class="fa-solid fa-indian-rupee-sign ml-3"></i>{{session('consumer.full_amount')}}</span>
                </div>
                <div class="underline-divider"></div>
                <h4 class="invoice-sub-heading">Payment Type</h4>
                <div class="invoice-pay-types">
Offline 
                    <p class="">
                        <span class="">Cash Paid</span>
                        <span class=""><i class="fa-solid fa-indian-rupee-sign"></i>{{$booking_details['total_amount']}}</span>
                    </p>
                   <!-- @if(session('payAmount')==session('consumer.adv_amount'))
                   <p class="">
                        <span class="">Cash</span>
                        <span class=""><i class="fa-solid fa-indian-rupee-sign"></i>{{session('consumer.full_amount')-session('payAmount')}}</span>

                    </p>
                   @endif -->
                </div>
                <div class="underline-divider"></div>
                <div class="invoice-rating driver-details">
                    <div class="driver-profile">
                        <img src="" alt="">
                    </div>
                    <div class="driver-info">
                        <p class="driver-name">{{$booking_details['driver_name']}}</p>
                        <p><i>You rated</i></p>
        
                    </div>
                    <div class="rating-stars ml-auto">
                        <i class="fa-solid fa-star f-x"></i>
                        <i class="fa-solid fa-star f-x"></i>
                        <i class="fa-solid fa-star f-x"></i>
                        <i class="fa-solid fa-star f-x" ></i>
                        <i class="fa-regular fa-star f-x"></i>
                    </div> 
                </div>
                <div class="underline-divider"></div>
                <div class="location-detail">
                        <div class="location-icon-left">
                            <div class="pickIcons">
                                <span class="d-pick-icon"><i class="fa-sharp fa-solid fa-circle-dot fa-beat"></i></span>
                                <span class="location-connector"></span>
                            </div>
                            <div class="pick-location">
                                <h4 class="location-type">Pickup Location</h4>
                                <p class=" pick-address">{{$booking_details['pickup_address']}}</p>
                            </div>
                        </div>
                       
                        <div class="location-name-detali">
                        <span class="d-dest-icon"><i class="fa-solid fa-location-dot fa-beat"></i></span>
                            
                            <div class="drop-location">
                                <div class="location-type">
                                    <h4>Drop Location</h4>
                                    
                                </div>
                                    <p class=" drop-address" title="Kota Heart Hospital, 10-A, Talwana..."> {{$booking_details['drop_address']}}</p>
                            </div>
                        </div>
                </div>
                <div class="underline-divider"></div>
               
            </div>
        </div>
        <a  href="javascript:generatePDF()" class="download-invoice-btn btn-trans  mt-2"  id="downloadButton"><i class="fa-solid fa-download mr-2"></i>Download</a>
    
    </div>
    
</div>

@endsection