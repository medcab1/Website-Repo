
@extends('layouts.configLayout')
@section('title','Medcab:invoice')
@section('main')

<?php 
// dd($detail);
// dd($detail['invoice']->bi_id);
$booking_addons=$detail['addons'];
$booking_details=$detail['booking_detail'];
$rating_list=$detail['rating_text'];
$invoice=$detail['invoice'];
?>

<!-- Invoice  start-->
<div class="booking-invoice-page">
		<section class="booking-page-section py-5" id="invoiceId">
			<div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        
                    </div>
                </div>
				<div class="row mt-5">
					<div class="col-lg-8 col-md-8 mx-auto mt-4 px-3"  id="">
						<!-- ---- card ---- -->
						<div class="card2 basic-info-wrapper ride-info mb-3 mt-3 px-3">										
							<span class="font-18 text-uppercase font-600 d-block text-success my-2 my-2">Ride Details</span>
							<div class="rider-profile-details vertical-center">
								<div class="img-thumb overflow-hidden" style="width:50px; height: 50px; margin-right: 18px;">
									<img src="https://medcab.in/assets/image/driver_png.png" alt="Driver Image" class="h-100 w-100">
								</div>
								<div class="details">
									<h3 class="font-22 font-600">{{$booking_details['driver_name']}}</h3>
									<small class="d-block text-muted font-13">Trips:{{$booking_details['driver_total_trips']}}  | {{sprintf('%0.1f',$booking_details['driver_avg_rating'])}} <span class="star text-warning">★</span></small>
								</div>
							</div>
							<div class="row my-2">
								<div class="col-md col-6 mb-md-0 mb-3">
									<small class="d-block font-12">Date</small><span class="d-block font-15 font-600">
											<?php if(str_contains(",",$booking_details['schedule_time'])){
                                                $dateTime=explode(",",$booking_details['schedule_time']);
                                                $date=$date[0];
                                                $time=$dateTime[1];
                                                echo $data;
                                            }else{
                                                $dateTime=explode(" ",$booking_details['schedule_time']);
                                                $date=$dateTime[0];
                                                $time=$dateTime[1].' '.$dateTime[2];
                                                echo $date;
                                            }?>
									
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
                                                echo $booking_details['duration'].'';
                                                $suffix='';
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
						<div class="card2 booking-details mb-2 px-3">										
							<span class="font-18 text-uppercase font-600 d-block text-success mt-2 my-2 my-2">
                                <!-- <a  class="badge bg-secondary booking-type font-500"> -->
										@if($booking_details['booking_type']==2)
											Bulk Booking
										@elseif($booking_details['booking_type']==1)
										   Rental Booking
										@elseif($booking_details['booking_type']==0)
										   Regular Booking
										@endif	
								<!-- </a> -->
                            </span>
							<h3 class="font-18 vertical-center my-2 mt-4"><span class="rectangle"></span>
                                {{$booking_details['booking_category_name']}}
                            </h3>
							<div class="my-2 mt-4">

								<span class="font-15 vertical-start mb-4"><span class="pickup"></span>
									<p>
										<span class="d-block font-700">Pickup</span>{{$booking_details['pickup_address']}}	</p>
								</span>

								<span class="font-15 vertical-start mb-1">
									<span class="drop"></span>
									<p>
										<span class="d-block font-700">Drop</span>
                                        @if($booking_details['booking_type']==1)
                                            {{'Rental for '.$booking_details['duration'].$suffix}}
                                        @else
                                        {{$booking_details['drop_address']}}   
                                        @endif
									</p> 
								</span>
							</div>
                            <?php 
                        
                        if(Session::get('booking_addons')){
                            foreach($booking_addons as $addon){?>
							<div class="vertical-center justify-between my-2">
								<h3 class="font-16 font-500 vertical-center m-0"><span class="rectangle"></span>{{$addon['addons_name']}}</h3>
								<span class="d-block">{{$addon['addons_price']}} </span>
							</div>
                            <?php }}?>
							
						</div>
						<!-- ---- card ---- -->
						<div class="row invoice-content-wrapper">
							<div class="card2 col-md-12 ms-0 basic-info-wrapper container p-2 px-4 mb-3">										
								<span class="font-18 text-uppercase font-600 d-block text-success my-2 my-2">Invoice</span>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">{{$booking_details['booking_category_name']}}</p>
									<span class="d-block">{{$booking_details['amount']}}</span>
								</div>
                                
								<!-- <div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Doctor Specialist</p>
									<span class="d-block">₹800</span>
								</div>
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Nurse</p>
									<span class="d-block">₹300</span>
								</div> -->
                               
                            
                                @foreach($booking_addons as $addon)
                                <div class="vertical-center justify-between my-2">
                                    <h3 class="font-16 font-500 vertical-center m-0"><span class="rectangle"></span>{{$addon['addons_name']}}</h3>
                                    <span class="d-block">{{$addon['addons_price']}} </span>
                                </div>
                                @endforeach
								<!-- <div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Service Charge</p>
									<span class="d-block">{{$booking_details['service_charge']}}</span>
								</div> -->
								<div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Extra Km ({{$invoice->bi_ext_km}} km x Rs {{$booking_details['extra_km_rate']}} )</p>
									<span class="d-block">
                                    {{$invoice->bi_ext_km*$booking_details['extra_km_rate']}} Rs
                                    </span>
								</div>
                                <div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Extra Time Taken ({{$invoice->bi_ext_min}} min x Rs {{$booking_details['extra_min_rate']}} )</p>
									<span class="d-block">
                                    {{$invoice->bi_ext_min*$booking_details['extra_min_rate']}} Rs
                                    </span>
								</div>
								<!-- <div class="vertical-center justify-between py-1">
									<p class="font-16 font-400 m-0">Extra time Taken()</p>
									<span class="d-block">₹21</span>
								</div> -->
								<!-- <div class="coupon-code">
									<div class="vertical-center justify-between text-success">
										<h3 class="font-16 vertical-center my-2 mt-4"><i class="fa-solid fa-tags me-2"></i> Discount Applied</h3> <span class="d-block font-500">-0</span>
									</div>
								</div> -->
								<div class="total-cost dotted-spaced-top mt-4 pt-4">
									<div class="vertical-center justify-between dotted-spaced-bottom pb-4">
										<h3 class="font-16 m-0">TOTAL AMOUNT</h3> <span class="d-block font-500">{{$booking_details['total_amount']}}</span>
									</div>
								</div>
								<div class="payment-status py-2">
									@if($booking_details['payment_type']==2)
                                    <div class="vertical-center justify-between">
										<h3 class="font-18 vertical-center my-2 mt-2"><i class="fa-solid fa-circle-check text-success me-2"></i> Advance Payment:&nbsp;<span class="text-success">
                                            @if($booking_details['payment_type']<=2)
                                            Paid Online
                                            @endif
                                        </span></h3> <span class="d-block font-500">{{$booking_details['advance_amount']}}</span>
									</div>	
                                    @elseif($booking_details['payment_type']==1)
                                    <div class="vertical-center justify-between">
										<h3 class="font-18 vertical-center my-2 mt-2"><i class="fa-solid fa-circle-check text-success me-2"></i> Full Payment:&nbsp;<span class="text-success">
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
                                            <!-- @if($booking_details['payment_type']==2)    
                                            {{$booking_details['total_amount']-$booking_details['advance_amount']}}
                                    @endif										 -->
                                            {{$invoice->bi_remain_amount}}
                                        </span>
									</div>
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
        <div class="button-group text-center mt-4 mb-4">
					<a  class="btn btn-outline-primary" id="download" style="max-width: 160px; width:100%;">DOWNLOAD</a>
					<!-- <a href="" class="btn btn-outline-primary" style="max-width: 160px; width:100%;">SHARE</a> -->
				</div>
	</div>

<!-- Invoice End -->
<!-- Rating Modal start -->
<div class="modal p-5" id="rating-modal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog rating-container modal-dialog-centered" role="document">
        <div class="modal-content h-100 rating b-0">
            <div class="modal-header rating-header b-0">
                <h2 class=" text-center"><i class="fa-solid fa-circle-check"></i>Ride Completed Successfully</h2>
                <p class="pay-price text-light"><i class="fa-solid fa-indian-rupee-sign"></i>{{$booking_details['total_amount']}}</p>
            </div>
            <div class="modal-body rating-body "> 
                <div class="rating-star">
                    <div class="rating-user-profile overflow-hidden">
                        <img src="https://medcab.in/appdata/{{$booking_details['driver_image']}}" alt="Driver Profile" class="h-100 w-100">
                    </div>    
                    <p>How was your ride with {{$booking_details['driver_name']}}?</p>     
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
                <textarea name="" id="rating-textarea" cols="30" rows="1" class="rating-message" name="other-reason" placeholder="Write here if you have anything in our mind" id="rating-textarea"></textarea>  
            </div>
            <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="rating-submit-btn btn-trans w-70"  >Submit</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Rating Modal end -->

<script>

window.onload=function(){
    // document.getElementById("other-reason").addEventListener("change", toggleContent); 
    if("{{$booking_details['c_to_d_r_status']}}"==1){
        setTimeout(function(){
        $('#rating-modal').modal('show');
    },2000);
    }
    // Rating Star
    $('.r-star').click(function(){
                if(!$(this).hasClass('fa-solid') && $(this).prevAll().length>0 ){
                    $(this).prevAll().attr('class','fa-solid fa-star r-star stared');
					$(this).attr('class','fa-solid fa-star r-star stared');
					
                }
                else if($(this).hasClass('fa-solid') && $(this).nextAll().hasClass('fa-solid'))
                {
                    $(this).nextAll().attr('class','fa-regular fa-star r-star');
                	$(this).attr('class','fa-regular fa-star r-star');
                }
             
                       
    });

    // Rating option toggler
    $('.rating-option-btn').click(function(){
        $(this).toggleClass('rated-option');
    });

    $('.rating-submit-btn').click(function(){
        if($('.r-star').hasClass('fa-solid')){
            ratingText='';
            $('.rating-option-btn').each(function(){
                if( $(this).hasClass('rated-option')){
                    console.log($('.rating-option-btn').hasClass('rated-option'));
                    ratingText=ratingText+$(this).text()+',';
                }
                
            })
            var otherRatingText=$('#rating-textarea').val();
            if(otherRatingText!='')
            {
                ratingText=ratingText+otherRatingText;
            }
            alert('rated..'+ratingText);
            var driver_id='{{$booking_details["driver_id"]}}';
            var booking_id='{{$booking_details["booking_id"]}}';
            var ratingStars=$('.r-star.fa-solid').length;
             $.ajax({
            url: '{{url("/driver/consumer-rating")}}',
            method: 'POST',
            data:{driver_id:driver_id,ratingStars:ratingStars,ratingText:ratingText,booking_id:booking_id
            },
            success: function(response) {
                if(response.status==0){
                    alert(response.message);
                    $('#rating-modal').modal('hide');
                    // window.location.replace('https://medcab.in/');
                }
                else{
                    alert(response.message);
                    // alert('Failed to rate');
                }

            },
            error:function(response){
                alert('request failed');

            },

        });
     
        }
        else{
            alert('please rate');
            
        }
    });
}


    async function generatePDF() {
            document.getElementById("downloadButton").innerHTML = "Currently downloading, please wait";

            //Downloading
            var downloading = document.getElementById("invoice");
            // var doc = new jsPDF({
            //     orientation : 'p',
            // unit: 'px',
            // format: [500, 750],
            // putOnlyUsedFonts:true
            // });
            const doc = new jsPDF('p', 'px', 'a4');
            await html2canvas(downloading, {
                allowTaint: true,
                useCORS: true,
                width: 500,
            }).then((canvas) => {
                //Canvas (convert to PNG)
                const pageWidth = doc.internal.pageSize.width;
                const pageHeight = doc.internal.pageSize.height;
                doc.addImage(canvas.toDataURL("image/png"), 'JPEG', 20, 20, pageWidth, pageHeight);
                // doc.output('dataurlnewwindow');
            })
            doc.save("Document.pdf");
            //End of downloading
            document.getElementById("downloadButton").innerHTML = "Click to download";
        }


        // Function to print and download a webpage section as PDF
        function printAndDownloadSection() {
        // Specify the section you want to print and download
        alert('Downloading...');
        const sectionToPrint = document.getElementById('invoiceId');

        // Create a new html2pdf instance
        const element = sectionToPrint.cloneNode(true);
        const opt = {
            margin: [0, 0, 0, 0],
            filename: 'Invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
        }
        // add click event to download btn
        document.getElementById('download').addEventListener('click',function(){
        printAndDownloadSection();

        });
  
        
</script>
@endsection