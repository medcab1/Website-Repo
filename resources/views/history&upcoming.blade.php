
@extends('layouts.configLayout')
@section('title',"Booking-History: Ambuance-booking")
@extends('layouts.header')
@section('main')
<?php
$history=$data[0]['booking_history'];
$upcoming=$data[0]['booking_upcoming'];
?>  
<style>

	/* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
  pointer-events: none;
  background: #6e93f7;
  transition: all 0.2s ease;
}
form button.active {
  background: #4070f4;
  pointer-events: auto;
}
form button:hover {
  background: #0e4bf1;
}
</style>
<div class="booking-page header-top-margin">
		<nav class="navigation"></nav>
		<section class="booking-page-section py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-10 mx-auto">
						<ul class="nav booking-tab-bar mb-3" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="true">Upcoming Bookings</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="pills-bookingHistory-tab" data-bs-toggle="pill" data-bs-target="#pills-bookingHistory" type="button" role="tab" aria-controls="pills-bookingHistory" aria-selected="false">Bookings History</button>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab" tabindex="0">
								
								@foreach($upcoming as $uc_booking)
								<!-- ---- card ---- -->
								<div class="card2 basic-info-wrapper border p-2 px-4 mb-3" card-id="{{$uc_booking->booking_id}}">
									<div class="vertical-center justify-between font-600">
										<a href="{{$uc_booking->booking_id}}" class="badge bg-secondary booking-type font-500">
										@if($uc_booking->booking_type==2)
											{{"Bulk Booking (".$uc_booking->booking_no_of_bulk."/".$uc_booking->booking_bulk_total.")"}}
										@elseif($uc_booking->booking_type==1)
										   Rental Booking
										@elseif($uc_booking->booking_type==0)
										   Regular Booking
										@endif
									
										</a>
										<a href="{{url('/payment_done').'/'.$uc_booking->booking_id}}" class="d-inline-block font-600" id="booking-page-link">₹ {{$uc_booking->booking_total_amount}}  <i class="fa-solid fa-angle-right ms-2"></i></a>
									</div>	
									<h3 class="font-18 vertical-center my-2 mt-4"><span class="dot"></span>{{$uc_booking->booking_view_category_name}}</h3>
									<div class="row my-3">
									<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Date</small><span class="d-block font-15 font-600">
												<?php if(str_contains(",",$uc_booking->booking_schedule_time)){
														$dateTime=explode(",",$uc_booking->booking_schedule_time);
														$date=$date[0];
														$time=$dateTime[1];
														echo $data;
													}else{
														$dateTime=explode(" ",$uc_booking->booking_schedule_time);
														$date=$dateTime[0];
														$time=$dateTime[1].' '.$dateTime[2];
														echo $date;
													}?>
											</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Time</small><span class="d-block font-15 font-600">
												{{$time}}
											</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Vehicle No.</small>
											<span class="d-block font-15 font-600 text-primary vehicle-id">
												@if(!empty($uc_booking->vehicle_rc_number))
												Assigned:{{$uc_booking->vehicle_rc_number}}
												@else
												{{'Searching...'}}
												@endif
											</span>	
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">OTP</small><span class="d-block font-15 font-600">{{$uc_booking->booking_view_otp}}</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Ride ID</small><span class="d-block font-15 font-600">{{$uc_booking->booking_id}}</span>
										</div>
									</div>									
									<p class="font-15 vertical-start mb-1"><span class="pickup"></span>{{$uc_booking->booking_pickup}} </p>
									<p class="font-15 vertical-start mb-4"><span class="drop"></span>
								{{$uc_booking->booking_drop}}	
								</p>	
								</div>
								@endforeach
							</div>
							<div class="tab-pane fade" id="pills-bookingHistory" role="tabpanel" aria-labelledby="pills-bookingHistory-tab" tabindex="0">
								@foreach($history as $booking)
								<div class="card2 basic-info-wrapper <?php if($booking->booking_status==5) {echo "disabled-card";} ?> border p-2 px-4 mb-3" card-id="{{$booking->booking_id}}">
									<div class="vertical-center justify-between font-600">
										<span class="booking-type px-0 font-500 <?php if($booking->booking_status==5) {echo "text-danger";}else{ echo "text-success";} ?>">
										@if($booking->booking_status==5)
										<i class="fa-solid fa-circle-xmark me-2"></i>@else<i class="fa-solid fa-circle-check me-2"></i>@endif
										@if($booking->booking_status==5)
										Ride Cancelled 
										@elseif($booking->booking_status==4)
										Ride Completed 
										@elseif($booking->booking_status==3)
										Ride In Progress(Invoice)
										@elseif($booking->booking_status==2)
										Booking Ongoing
										@elseif($booking->booking_status==1)
										Booking Done
										@endif
										<small class="dot-small text-muted ms-4">
										@if($booking->booking_type==2)
											{{"Bulk Booking (".$booking->booking_no_of_bulk."/".$booking->booking_bulk_total.")"}}
										@elseif($booking->booking_type==1)
										   Rental Booking
										@elseif($booking->booking_type==0)
										   Regular Booking
										@endif
									
									</small></span>
										<a href="<?php if($booking->booking_status==4){echo route('consumer.GetInvoice',$booking->booking_id);}?>" class="d-inline-block font-600">₹ {{$booking->booking_total_amount}} <i class="fa-solid fa-angle-right ms-2"></i></a>
									</div>										
									<h3 class="font-18 vertical-center my-2 mt-4"><span class="dot"></span> {{$booking->booking_view_category_name}}</h3>
									<div class="row my-3">
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Date</small><span class="d-block font-15 font-600">
												<?php if(str_contains(",",$booking->booking_schedule_time)){
														$dateTime=explode(",",$booking->booking_schedule_time);
														$date=$date[0];
														$time=$dateTime[1];
														echo $data;
													}else{
														$dateTime=explode(" ",$booking->booking_schedule_time);
														$date=$dateTime[0];
														$time=$dateTime[1].' '.$dateTime[2];
														echo $date;
													}?>
											</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Time</small><span class="d-block font-15 font-600">
												{{$time}}
											</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Vehicle No.</small><span class="d-block font-15 font-600">{{$booking->vehicle_rc_number}}</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">OTP</small><span class="d-block font-15 font-600">{{$booking->booking_view_otp}}</span>
										</div>
										<div class="col-md col-6 mb-md-0 mb-3">
											<small class="d-block font-12">Ride ID</small><span class="d-block font-15 font-600">{{$booking->booking_id}}</span>
										</div>
									</div>									
									<p class="font-15 vertical-start mb-1"><span class="pickup"></span>{{$booking->booking_pickup}} </p>
									<p class="font-15 vertical-start mb-4"><span class="drop"></span>

                                    {{$booking->booking_drop}}
								</p>									
								</div>
								@endforeach
							</div>
							
						</div>
					</div>
				</div>
			</div>


		</section>
<script>
	 const inputs = document.querySelectorAll("input"),
  button = document.querySelector("#otpBtnSubmit");

// iterate over all inputs
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
   
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;

    // if the value has more than one character then clear it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    // if the backspace key is pressed
    if (e.key === "Backspace") {
      // iterate over all inputs again
      inputs.forEach((input, index2) => {
t
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }

    if (!inputs[5].disabled && inputs[5].value !== "") {
		alert("done");
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});

//focus the first input which index is 0 on window load
window.addEventListener("load", () => inputs[0].focus());
   function pageRefresher(){
	var cards=$('.card2');
            $.ajax({
              url: '{{url('/booking/booking-refreshing')}}',
              method: 'POST',
              success: function(response) {
                console.log(response.status);
				var arr=response.data;
				console.log(arr);
				$.each(arr, function() {
					$b_status=this['booking_status'];
					$b_id=this['booking_id'];
					$v_no=this['vehicle_rc_number'];
					$.each(cards, function(index,item){
						if($(item).attr('card-id')==$b_id){
							if($b_status==2){
								$(item).find('.vehicle-id').html('Assigned:'+$v_no).css('color','red');
								$(item).find('#booking-page-link').attr('href','{{url('driver/driver-assigned')."/"}}'+$b_id)
							}
                        }
					})
				});
            	setTimeout(pageRefresher, 8000);
              },
              error: function(xhr) {
                alert('Waiting Failed');
                console.error(xhr);
              }
            });   
        }
    window.onload = function() {
		setTimeout(pageRefresher, 4000);
    }
</script>
@endsection
