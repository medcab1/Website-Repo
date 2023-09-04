@extends('layouts.configLayout')
@extends('layouts.header')
@section('title',"Waiting for ambulance..")
@section('main')
<style>  
.loading {
    display: flex;
    justify-content: center;
    margin: 100px 0;
}

.loading div,.dot {
    font-size:20px;
    font-weight: bold;
    animation-name: word-loading;
    animation-duration: 2.7s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-direction: normal;

}
.dot{
    display:flex;
    justify-content: center;
    align-items:center;
}
.dot span{
    display:block;
    height:5px;
    width:5px;
    background-color: white;
    margin-left:5px;
}
@keyframes word-loading {
    0% {
        margin: 0;
        color: white;
    }

    100% {
        margin: 0;
        color: transparent;
    }


}
</style>
<!-- Waiting Screen -->
<div class="loader-page h-100 w-100 header-top-margin">
        <div class="container h-100 w-100 d-flex flex-column gy-5">
            <div class="back-link">
                <a href="{{URL::route('Home')}}" class="move-page-btn"><i class="fa-solid fa-arrow-left-long "></i>Booking </a>
            </div>
            <div class="loader-content py-4 w-100">
                <div class="loader-body">
                    <h2 class="loader-text">
                        Finding Best Ambulance Near You
                    </h2>
                    <div class="linePreloader"></div>
                    <div class="loader-mapp">
                        <div class="loader-mapp-content bg-light rounded-circle"  id="waiting-map" style="height:250px;width:250px; background-color:rgba(225,225,225,.8);">

                        </div>
                    </div>
                    
                    <button class="ride-cancel-btn btn-click-effect p-cancel-btn"  data-bs-toggle="modal" data-bs-target="#cancelRide" cancel-ride-id="">
                        <i class="fas fa-times"></i> Cancel Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- Waiting Screen -->


<!-- Cancellation start-->
<x-cancellation/>
<!-- Cancellation end -->
<div id="toastContainer">
    <div id="toast" class="alert alert-success hidden">
      This is a notification message.
    </div>
</div>
  
<script>

    function submitAjaxRequest(){
        // console.log('waiting');
        var url=window.location.href;
        var booking_id=url.split('/')[url.split('/').length-1];
        $('.ride-cancel-btn').attr('cancel-ride-id', booking_id);
            $.ajax({
            url: '{{url('/driver/waiting-for-driver')}}',
            method: 'POST',
            data:{booking_id:booking_id},
            success: function(response) {
                // console.log(response);
                if(response.status==2){
                    showToast("Your Booking has been accepted. Please wait for a for some time, Driver will reach out to you soon.");
                    // alert("{{url('/driver/driver-assigned')}}/"+booking_id);
                    window.location.replace("{{url('/driver/driver-assigned')}}/"+booking_id) ;
                }
                else{
                    console.log(response.status);
                    setTimeout(submitAjaxRequest, 2000);

                }
                //setTimeout(submitAjaxRequest, 2000);
            },
            error: function(xhr) {
                alert('failed to submit');
                // Handle any errors that occurred during the request
                console.error(xhr);
            }
            });   
        }

    window.onload = function() {
		setTimeout(submitAjaxRequest, 4000);
        // alert('loading');
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            console.log("Latitude: " + latitude);
            console.log("Longitude: " + longitude);
            var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
        	mapp = new google.maps.Map(document.getElementById('waiting-map'), {
        	center: pyrmont,//latlng
        	zoom: 15
            });
             marker = new google.maps.Marker({
	
            		position:pyrmont,
            		zoom:18,
            		title:"Your location",
                    
            	});
        createMapFun(latitude,longitude,'waiting-map');
        });
        } else {
        console.log("Geolocation is not supported by this browser.");
        }
        createMapFun("{{session('users.pick_lat')}}","{{session('users.pick_lng')}}",'waiting-map');
    }
</script>
@endsection