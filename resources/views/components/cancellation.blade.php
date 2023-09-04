
<?php
    $cancel_reason_list=DB::table('booking_cancel_reasons')->where(['booking_cancel_reasons_status'=>'0','cancel_reason_type'=>'1'])->get();
?>
<!-- Cancel Ride Modal Start -->
<div class="modal p-3" id="cancelRide" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-box b-0">
            <div class="modal-body cancel-box-body ">
                <div class="sqr" style="background-color:#F9E5D7;color:#D8712A;">
                    <span class="circle-alert">
                        <i class="fa-regular fa-exclamation"></i>
                    </span>
                </div>
                
                <h2>Are you sure you want to Cancel<br/> your Booking?</h2>
            </div>
             <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="cancel-back-btn btn-trans"  data-bs-dismiss="modal">Back</button>
                <button type="button" class="cancel-yes-btn btn-trans" data-bs-toggle="modal" data-bs-target="#reasonForCancelRide" >Yes</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Cancel Ride Modal End -->

<!-- Cancelation reason modal start -->
<div class="modal p-5" id="reasonForCancelRide" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-reason b-0">
            <div class="modal-header cancel-reason-header">
                <h2 class="modalHeading text-center m-auto">Select Reason for Cancellation</h2>
            </div>
            <div class="modal-body cancel-reason-body ">
                    <div class="cancel-reason-list">
                         @if(!empty($cancel_reason_list))
                            @foreach($cancel_reason_list as $cancel_reason)
                            <div class="cancel-reason-item">
                                <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="{{$cancel_reason->booking_cancel_reasons_id}}">
                                <p class="cancel-text">{{$cancel_reason->booking_cancel_reasons_text}}</p>
                            </div>
                             @endforeach
                             <div class="cancel-reason-item">
                                <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn cancel-reason-radio-other-btn" target_id="other-reason" id="other-reason" data-id="10">
                                <p class="cancel-text">Alternative option/Different issue/Other</p>
                            </div>
                       @endif
                        <textarea name=""  cols="30" rows="10" class="chat-input-box" id="other-reason-textarea" placeholder="Please specify cancellation reasoon"></textarea>    

                        
                </div>
            </div>
            <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class=" btn-trans w-50"  data-bs-dismiss="modal">Back</button>
                <button type="button" class="btn-solid w-50 disabled-item"  data-bs-toggle="modal" data-bs-target="#cancelSuccessfull" id="ride-cancel-btn" onclick="cancelRide()" >Cancel Ride</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Cancelation reason modal end -->

<!-- Cancelation successfull modal start -->
<div class="modal p-3" id="cancelSuccessfull" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-box b-0">
            <div class="modal-body cancel-box-body ">
                <div class="sqr" style="background-color:#FFD0D0;">
                    <span class="circle-xmark">
                    <i class="fa-regular fa-x"></i>
                    </span>
                </div>
                <h2>Ride Cancelled Successfully</h2>
            </div>
             <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="btn-trans w-100" data-bs-toggle="modal" >Done</button>
            </div>
            
        </div>
    </div>
</div>

<!-- Cancelation successfull modal end -->

