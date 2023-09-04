
//..............public/ custom.js
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}});
	
function reloadCss()
{
    var links = document.getElementsByTagName("link");
    for (var cl in links)
    {
        var link = links[cl];
        if (link.rel === "stylesheet")
            link.href += "";
    }
}
(function ($) {
	
	// "use strict"
	$(window).scroll(function() {
	var scroll = $(window).scrollTop();
	var box = $('#top').height();
	var header = $('header').height();

	if (scroll >= box - header) {
	$("header").addClass("background-header");
	} else {
	$("header").removeClass("background-header");
	}
	});
	mobileNav();
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	// $('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
	// 	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	// 		var target = $(this.hash);
	// 		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	// 		if (target.length) {
	// 			var width = $(window).width();
	// 			if(width < 991) {
	// 				$('.menu-trigger').removeClass('active');
	// 				$('.header-area .nav').slideUp(200);	
	// 			}				
	// 			$('html,body').animate({
	// 				scrollTop: (target.offset().top) - 80
	// 			}, 700);
	// 			return false;
	// 		}
	// 	}
	// });



	$(document).ready(function () {
		

	    // $(document).on("scroll", onScroll);
	    // //smoothscroll
	    // $('.scroll-to-section a[href^="#"]').on('click', function (e) {
	    // e.preventDefault();
	    // $(document).off("scroll");
	    // $('.scroll-to-section a').each(function () {
	    // $(this).removeClass('active');
	    // })
	    // $(this).addClass('active');
		// var target = this.hash,
	    // menu = target;
	    // var target = $(this.hash);
	    // $('html, body').stop().animate({
        //     scrollTop: (target.offset().top) - 79
	    //     }, 500, 'swing', function () {
	    //     window.location.hash = target;
	    //     $(document).on("scroll", onScroll);
	    //     });
	    // });
	});

	// function onScroll(event){
	//     var scrollPos = $(document).scrollTop();
	//     $('.nav a').each(function () {
	//         var currLink = $(this);
	//         var refElement = $(currLink.attr("href"));
	// 		// alert(refElement.position());
	//         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	//             $('.nav ul li a').removeClass("active");
	//             currLink.addClass("active");
	//         }
	//         else{
	//             currLink.removeClass("active");
	//         }
	//     });
	// }


	// Page loading animation
	$(window).on('load', function() {
		// if($('.cover').length){
		// 	$('.cover').parallax({
		// 		imageSrc: $('.cover').data('image'),
		// 		zIndex: '1'
		// 	});
		// }

		// $("#preloader").animate({
		// 	'opacity': '0'
		// }, 600, function(){
		// 	setTimeout(function(){
		// 		$("#preloader").css("visibility", "hidden").fadeOut();
		// 	}, 300);
		// });
	});


	// Window Resize Mobile Menu Fix
	$(window).on('resize', function() {
		mobileNav();
	});


	// Window Resize Mobile Menu Fix
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 1200) {
				$('.submenu ul').removeClass('active');
				$(this).children('ul').toggleClass('active');
        $('.submenu ul').toggle();
			}
		});
	}

})(window.jQuery);



$(document).ready(function(){

	// Login script start
const inputs = document.querySelectorAll(".otp-input");
var button = document.querySelector("#otp-btn");

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
      return;
    }
    button.classList.remove("active");

  });
});

 //login submit
 $('#phone').on('change keydown paste input',function(){
    if($(this).val()!="" && $(this).val().length==10) {
        $("#verify-btn").removeClass('disable-item'); // enable button
    }
    else{
        $("#verify-btn").addClass('disable-item'); // enable button
    }
 });

 $('#name').on('change keydown paste input',function(){
    
    if($(this).val()!="" && $(this).val().length>=3) {
        $("#proceed-btn").removeClass('disable-item'); // enable button
    }
    else{
        $("#proceed-btn").addClass('disable-item'); // enable button
    }
 });
 
 $('#loginForm').on('submit',function(e){
	e.preventDefault();
	let phone = $('#phone').val();
	// alert(phone);
	token=$('#tokens').attr('content');
   
	if(phone!="")
	{
		
		var jsonData = {
			phone:phone,
			};
		$.ajax({
			url: "/medcab/booking/login",
			type:"POST",
			data:jsonData,
			beforeSend: function() { 
				$("#verify-btn").prop('disabled', true); // disable button
			},
			success:function(response){ 
				$("#phone").focus();
				if(response.code==0){
					$('#loginForm').css('display','none');
					countdown(30);
					$('#otpForm').css('display','flex');
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
				$("#verify-btn").removeClass('disable-item'); // enable button
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
	let input_otp=parseInt(otpValues);
	
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
					$("#otp-btn").removeClass('disable-item'); // enable button
					$("#otpForm").html(data.message);
					$('#welcome-user').append("<b>"+data.consumer_name+"</b>");
					alert(data.message);
					window.location.replace('https://book.cabmed.in/');
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
		url:'{{URL::to("/login/resend_otp/{mob?}")}}',
		type:'post',
		data:{mob:"{{session('consumer_mob')}}",},
		success:function(response){
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
	token=$('#reg_tokens').attr('content');
	if(name!="")
	{
		$.ajax({
			url: "/medcab/booking/registration",
			type:"POST",
			data:{_token:token,name:name},
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

// Login script end



function codeAddress() {
	var loc = window.location.href; // location.href;
	var locNavs = document.getElementsByClassName("menu-item");
	$(".menu-item a").removeClass("active");
	for (var i = 0; i < locNavs.length; i++) {
		if(locNavs[0].getElementsByTagName('a')[0].getAttribute("href")+'/' == loc ){
			locNavs[0].getElementsByTagName('a')[0].className += " active";
			}
	    else if (locNavs[i].getElementsByTagName('a')[0].getAttribute("href") == loc) {
				locNavs[i].getElementsByTagName('a')[0].className += " active";
			}
	}
}
codeAddress();

	$('.modal').modal({
		backdrop: 'static',
		keyboard: false
	},'show');
	$('#ModalCenter').modal('hide');
	
	$("#datepicker").on("change", function() {
		this.setAttribute(
			"data-date",
			moment(this.value, "YYYY-MM-DD")
			.format( this.getAttribute("data-date-format") )
		)
	}).trigger("change");

		
function setBookingTime(){
		let current = new Date();
		let dateTime=current.toLocaleString('en-US',{
			weekday: 'short', // long, short, narrow
			day: 'numeric', // numeric, 2-digit
			year: 'numeric', // numeric, 2-digit
			month: 'long', // numeric, 2-digit, long, short, narrow
			hour: 'numeric', // numeric, 2-digit
			minute: 'numeric', // numeric, 2-digit
			second: 'numeric', // numeric, 2-digit
		});
		var dt=current.toLocaleString('hi-IN');
		console.log(dt);
		$('#txtDate').val(dt);
		$('#txtDate').attr("title",dateTime);   	
		$('#book-now-time').html(dateTime);   	
} 
setBookingTime();
	$('#confirm-btn').click(function(){

        date=$('#datepicker').val();
        time=$('#timepicker').val();
        if(date!="" && time!="" ){
			var newdate=moment(date, "YY/MM/DD").format("DD/MM/YY");
			$('#confirm-btn').prop('disabled', true);
			$('#book-now span').hide();
            $('#txtDate').show();
            $('#txtDate').val(date+" | "+time);
			$('#txtDate').attr("title",  $('#txtDate').val());
			$('#ModalCenter').modal('hide');
			$('#schedule-box').css('display', 'flex');
        }
		
		else{
			setBookingTime();
			alert("Please select date and time!");
			$('#confirm-btn').prop('disabled', false);
		}
    });

	$('.currDateTime').click(function() { 
			$('#ModalCenter').modal('show');
	});




	$('.open-btn').click(function(){
		$('.open-btn').removeClass('hide');
		$(this).addClass('hide');
		$('.close-btn').removeClass('show');
		$(this).siblings('.close-btn').addClass('show');
        $('.faq-ans').removeClass('show');
        $(this).parent().parent().children('.faq-ans').addClass('show');    
    });
    $('.close-btn').click(function(){
        $(this).parent().parent().children('.faq-ans').removeClass('show');
        $(this).removeClass('show');
        $(this).siblings('.open-btn').removeClass('hide');
        $(this).siblings('.open-btn').addClass('show');
    });
    
    

    
    //   Cancellation 
 	// Another reason for cancellation
	 $('.cancel-reason-radio-btn').click(function(){
		
		$(this).parent('.cancel-reason-item').click();
		if($('#other-reason').is(':checked')){
			$("#other-reason-textarea").hide();
		}
		else{
			$("#other-reason-textarea").show();
		}
	 });
	 
	$('.cancel-reason-item').click(function(){
		var i=0;
		var cancel_reason=$('.cancel-reason-item');
		
		checkRadio=$(this).find('.cancel-reason-radio-btn').prop('checked');
		console.log('cancel reason clicked'+checkRadio);
		if($(this).find('.cancel-reason-radio-btn').attr('id')=='other-reason'){
			if(checkRadio){
				alert("hide textarea");
				$("#other-reason-textarea").hide();
			}
			else{
				alert('show textarea');
				$("#other-reason-textarea").show();
			}
		}
		else{
			$("#other-reason-textarea").hide();

		}
		if(checkRadio){
			$(this).find('.cancel-reason-radio-btn').prop('checked',false);
			$(this).css({'border':'1px solid #E5DDDD','background-color':'#FFFFFF'});
			$('#ride-cancel-btn').addClass('disabled-item');

		}
		else{
		    $(this).find('.cancel-reason-radio-btn').prop('checked',true);
			$('.cancel-reason-item').css({'border':'1px solid #E5DDDD','background-color':'#FFFFFF'});
			$(this).css({'border':'1px solid #159d89','background-color':'#D3e8e4'});
			$('#ride-cancel-btn').removeClass('disabled-item');

		}
		
	});
        $("#other-reason-textarea").hide();
        document.getElementById("other-reason").addEventListener("change", toggleContent);

        
 	var elements = document.getElementsByClassName('cancel-reason-radio-btn');
	console.log(elements[4]);
	for (var i = 0 ; i < elements .length; i++) {
   		elements [i].addEventListener('change' , function(){
			$("#other-reason-textarea").css('display', 'none');
			//  document.getElementById('ride-cancel-btn').disabled = false;
			$('#ride-cancel-btn').removeClass('disabled-item');

	  		
		} ) ; 
	}
       
        // Function to toggle the display of the content div
        function toggleContent() {
		alert("cancel");
		$("#other-reason-textarea").css('display', 'block');
		document.getElementById('ride-cancel-btn').disabled = false;
         
        }
		var other=document.getElementById('other-reason');
		var otherTextBox=document.getElementById('cancel-reason-textarea');
		if(other.checked) {
			otherTextBox.style.display='block';
        } else {
            otherTextBox.style.display = 'none';
        }
// cancel bookng
                
// Rating
var starts = document.getElementsByClassName('r-star');
	for (var i = 0 ; i < starts .length; i++) {
		starts [i].addEventListener('click ' , rating()) ; 
	}
       
    function rating(){
                if($(this).prevAll().length>0){
                    $(this).prevAll().attr('class','fa-solid fa-star r-star stared');
					$(this).attr('class','fa-solid fa-star r-star stared');
					$(this).toggleClass('stared');
                }
               
                if($(this).nextAll().hasClass('stared')){
                    $(this).nextAll().attr('class','fa-regular fa-star r-star');
                	$(this).attr('class','fa-regular fa-star r-star');
					$(this).removeClass('stared');
                }
          }
});
$('.booking-type')
	// Toggle booking type button
	function toggleRadio(radioId) {
		if(radioId == 'rental'){
            $('.drop-form-group').hide();
            $('.duration-group').css('display', 'flex');
		}else{
            $('.drop-form-group').show();
            $('.duration-group').css('display', 'none');
		}
		var radio = document.getElementById(radioId);
		var labelElement=radio.nextElementSibling;
		document.querySelectorAll('.booking-type-btn').forEach((userItem) => {
			userItem.classList.remove('booking-type-active');
		});
		labelElement.classList.add('booking-type-active');
		radio.checked = true;
	}
	
	$('#duration-btn').click(function(){
		var type=$("input[name='booking-period']:checked").val();;
		if(type=='24'){
			var timeTypeBoxClass='select-hours';
		}
		else if(type=='31'){
			var timeTypeBoxClass='select-days';

		}
		else{
			alert('Wrong booking period type!');
		}
		var status=$('.'+timeTypeBoxClass).find('.select-items div').hasClass('same-as-selected');
		// console.log($('.'+timeTypeBoxClass));
		if(status==true){
			var timePeriod=$('.'+timeTypeBoxClass).find('.select-selected').html();
			// console.log(timePeriod);
			$('.duration-group').find('input').val(timePeriod);
			$('.duration-group').css('display','flex');
			$('#rentalTimePeriod').modal('hide');
		}
		else{
			alert('Please select a duration');
		}
		
	});
	
function cancelRide(event) {
			var booking_id=$('.ride-cancel-btn').attr('cancel-ride-id');
            var formData = $(this).serialize(); // Serialize form data
            var reason=$('.cancel-reason-radio-btn').is(':checked');
            var other_reason=$('.cancel-reason-radio-other-btn').is(':checked');
            if(reason){
                var reason_id=$('.cancel-reason-radio-btn:checked').attr('id');
                var reason_text=$('.cancel-reason-radio-btn:checked').siblings('.cancel-text').html();
            }
            var other_id=$('.cancel-reason-radio-other-btn:checked').attr('data-id');
            if(other_reason){
                reason_id=other_id;
                reason_text=$('#other-reason-textarea').val();
                if(reason_text==''){
                    reason_text=$('.cancel-reason-radio-btn:checked').siblings('.cancel-text').html();
                }
            }
                let getLocationPromise = new Promise((resolve, reject) => {
                if(navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        lat = position.coords.latitude
                        long = position.coords.longitude
                        resolve({latitude: lat, 
                                longitude: long})
                    })

                } else {
                    reject("your browser doesn't support geolocation API")
                }
            })
            getLocationPromise.then((location) => {
                console.log(location.latitude)

                $.ajax({
                    url: "/booking/cancel-booking",
                    method: 'POST',
                    data: {lat:location.latitude,lng:location.longitude,reason_id:reason_id,reason_text:reason_text,booking_id:booking_id},
                    success: function(response) {
                        console.log(response);
                        if(response.c_status==0){
                            window.location.replace('https://book.cabmed.in/');
                        }
                        else{
                            // alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                    });
                    
            }).catch((err) => {
                console.log(err)
            })
       

        }



function onlyNumberKey(evt) {
	// Only ASCII character in that range allowed
	var ASCIICode = (evt.which) ? evt.which : evt.keyCode
	if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
		return false;
	return true;
}

function inputCharacterOnly(inputId){
	var input = inputId.value;
	var errorMessage =  inputId.nextElementSibling;
	var pattern = /^[A-Za-z\s]+$/;

	if (pattern.test(input)) {
		errorMessage.textContent = "";
	} else {
		errorMessage.textContent = "Please enter only letters and spaces.";
	}
	if(input=="") {
		errorMessage.textContent = "";
	}
	errorMessage.style.color="#c5354f";
  }


  function onlyCharacters(event) {
    var key = event.keyCode || event.which;
    var errorMessage =  event.target.nextElementSibling;

    // Allow special keys like backspace, delete, arrow keys, etc.
    if (key == 8 || key == 9 ||key==32|| key == 37 || key == 39 || key == 46) {
      return true;
    }

    // Check if the pressed key is a character
    var char = String.fromCharCode(key);
    var pattern = /^[A-Za-z\s]+$/;

    if (pattern.test(char)) {
		errorMessage.textContent= "";
	} else {

        errorMessage.textContent="Please enter only letters and spaces.";
	}
	errorMessage.style.color="#c5354f";
        return pattern.test(char);

  }

function polyline_display(origin,destination,map_id) {
	
	var map = new google.maps.Map(document.getElementById(map_id), {
	zoom: 16,
	center: {lat: 26.863302, lng: 81.0015002}
	});
	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer({
		polylineOptions: {
			strokeColor: '#2196f3' // Set the desired color here
			},
			map: map,
			suppressMarkers: true ,
	});
	// directionsDisplay.setMap(map);
	calculateAndDisplayRoutes(directionsService, directionsDisplay,origin,destination,map);
}
function decodePolyline(polyline){
	console.log(polyline);
	if (!polyline) {
		return [];
	}
	var poly = [];
	var index = 0, len = polyline.length;
	var lat = 0, lng = 0;

	while (index < len) {
		var b, shift = 0, result = 0;

		do {
			b = polyline.charCodeAt(index++) - 63;
			result = result | ((b & 0x1f) << shift);
			shift += 5;
		} while (b >= 0x20);

		var dlat = (result & 1) != 0 ? ~(result >> 1) : (result >> 1);
		lat += dlat;

		shift = 0;
		result = 0;

		do {
			b = polyline.charCodeAt(index++) - 63;
			result = result | ((b & 0x1f) << shift);
			shift += 5;
		} while (b >= 0x20);

		var dlng = (result & 1) != 0 ? ~(result >> 1) : (result >> 1);
		lng += dlng;

		var p = {
			lat: lat / 1e5,
			lng: lng / 1e5,
		};
		poly.push(p);
	}
	return poly;
}

function drawPolyline(poly,mapId)
{
    // var poly=polyline.replace("\",'/');
	var coordinates=decodePolyline(poly);
	// console.log(coordinates[coordinates.length%2]);
	// console.log(coordinates.length%2+coordinates[8])
	midCord=coordinates[Math.floor(coordinates.length / 2)]
	var map = new google.maps.Map(document.getElementById('show-map'), {
        center: midCord, // Set your desired center coordinates
        zoom: 16 // Set your desired zoom level
      });

      // Define the coordinates for the polyline
    //   var coordinates = [
    //     {lat: 40.7128, lng: -74.0060}, // Example coordinate 1
    //     {lat: 40.7123, lng: -74.0055}, // Example coordinate 2
    //     {lat: 40.7120, lng: -74.0050}, // Example coordinate 3
        // Add more coordinates as needed
    //   ];

      // Create the polyline
      var polyline = new google.maps.Polyline({
        path: coordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 4,
        map: map
      });
	const drop = document.createElement("div");
  	drop.className = "dropIcon";
	const pick = document.createElement("div");
  	pick.className = "pickIcon";

	  polyline.setMap(map);
      // Get the midpoint of the polyline
      var path = polyline.getPath();
      var startPoint = path.getAt(0);
      var endPoint = path.getAt(Math.floor(path.getLength()-1));
	  var marker =  new google.maps.Marker({
        position: startPoint,
        map: map,
        
		icon: {
			url: 'https://medcab.in/assets/image/pickup-icon.png', // Replace with the path to your image
			scaledSize: new google.maps.Size(20, 20) // Set the desired size of the image
		  }
		,
        title: 'PickUp Location',
      });
	  var marker =  new google.maps.Marker({
        position: endPoint,
        map: map,
		icon: {
			url: 'https://medcab.in/assets/image/drop-icon.png', // Replace with the path to your image
			scaledSize: new google.maps.Size(20, 20) // Set the desired size of the image
		  }
		,
        title: 'Drop Location'
      });
	// Create the marker at the start point
	createMarkerFun('26.86341,81.00152','PickUp Location');
	// Create the marker at the start point
	createMarkerFun(endPoint,'Driver Location');
	
}
function calculateAndDisplayRoutes(directionsService, directionsDisplay,origin,destination,map) {           
	directionsService.route({
	origin:origin,
	destination:destination,
	travelMode: 'DRIVING'
	}, function(response, status) {
	if (status === 'OK') {
		directionsDisplay.setDirections(response);
		var steps = response.routes[0].legs[0].steps;
		// console.log(steps);

		// Place custom marker overlays for each step
		for (var i = 0; i < steps.length; i++) {
		  var step = steps[i];
			if(i==0){
				// console.log(steps[i]);

				var marker = new google.maps.Marker({
					position: step.start_location,
					map: map,
					title: "Consumer Pickup location",
					icon: {
					url: 'https://medcab.in/assets/image/pick-icon.png', // Replace with the path to your image
					scaledSize: new google.maps.Size(25, 25), // Set the desired size of the image
					},
				});
			}
			if(i == steps.length-1){
				// console.log(steps[i]);
				var marker = new google.maps.Marker({
					position: step.end_location,
					map: map,
					title: "Consumer Drop location",
					icon: {
					url: 'https://medcab.in/assets/image/drop-icon.png', // Replace with the path to your image
					scaledSize: new google.maps.Size(25, 25), // Set the desired size of the image
					},
				});
			}
			
		}
	} else {
		window.alert('Directions request failed due to ' + status);
	}
	});
}


//map creator
  //create map
  function createMapFun(latitude,longitude,icon,title,id){
	var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
	mapp = new google.maps.Map(document.getElementById(id), {
	center: pyrmont,//latlng
	zoom: 15,
	});
	createMarkerFun(pyrmont,icon,title);
}


//create map marker
function createMarkerFun(latLng,icon,name){
	var marker = new google.maps.Marker({
		map: mapp,
		position:latLng,
		title:name,
		icon: {
			url: icon, // Replace with the path to your image
			scaledSize: new google.maps.Size(20, 20), // Set the desired size of the image
			},
		
	});
}

//   //create map
//   function createMapFun(latitude,longitude,id){
// 	var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
// 	mapp = new google.maps.Map(document.getElementById(id), {
// 	center: pyrmont,//latlng
// 	zoom: 15
// 	});

// 	createMarkerFun(pyrmont);
// }


// //create map marker
// function createMarkerFun(latLng,title='',icn=''){
// 	var marker = new google.maps.Marker({
	
// 		position:latLng,
// 		icon:icn,
// 		title:title,
		
// 	});
// }


//Get Current location lat Long
 function getLiveLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
function showPosition(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;console.log(position);
  return position.coords;
}


//Resend OTP for consumer verification
	function countdown(sec) {
        var seconds = sec;
        function tick() {
          var counter = document.getElementById("otp-timer");
          seconds--;
          counter.innerHTML =
            "0:" + (seconds < 10 ? "0" : "") + String(seconds);
          if (seconds > 0) {
            setTimeout(tick, 1000);
          } else {
            document.getElementById("resend-otp").innerHTML = `
               Resend OTP
            `;
            document.getElementById("counter").innerText = "";
          }
        }
        tick();
      }
      
	  function moveToNext(input) {
		if(input.value != ""){
			input.style.border="1px solid #159D89";
		}
		else{
			input.style.border="1px solid #e2e2e2";
		}
		if (input.value.length === input.maxLength) {
			const nextInput = input.nextElementSibling;
			if (nextInput !== null) {
			nextInput.focus();
			}
		}
		}
function focusInputElement(id){
	document.getElementById(id).focus();
}
function handleInput(event, currentIndex) {
        const input = event.target;
        const nextIndex = (currentIndex + 1) % 6;
        const previousIndex = (currentIndex - 1 + 6) % 6;
        
        if (input.value) {
          // If the input has a value, move the focus to the next input box
	
          if (nextIndex === 0) {
            // If it's the last input box, blur it to prevent further input
            input.blur();
          } 
	   else {
		
            	    document.getElementsByClassName('otp-input')[nextIndex].focus();
		
          }
	 input.style.border="1px solid #159D89";
         }
         else {
          // If the input is empty, move the focus to the previous input box
	  input.blur();
          document.getElementsByClassName('otp-input')[previousIndex].focus();
        }
      }


    //Resend OTP for Consumer verification

	  

$('.testimonial-content').owlCarousel({
    loop:true,
    margin:45,
    nav: false,
    mouseDrag: true,
    touchDrag:true,
    autoplay: true,
    autoplayTimeout: 4000,
    smartSpeed: 800,
    stagePadding:0,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false,
            loop:true,
            stagePadding:0,
            margin:50,
            dots:false,
        },
        1200:{
            items:2,
            nav:false,
            loop:true,
        },
        1450:{
            items:2,
            nav:true,
            loop:true
        },
    },
});


var $owl = $('.service-types');
$owl.children().each( function( index ) {
	$(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
  });
  
  $owl.owlCarousel({
	mouseDrag: true,
    	touchDrag:true,
	autoplay: true,
	autoplayTimeout: 3000,
	smartSpeed: 2000,
	loop: true,
	nav:true,
	items: 3,
	responsiveClass:true,
    	responsive:{
        0:{
            items:1,
            nav:false,
            loop:true,
            stagePadding:0,
            margin:50,
            dots:false,
        },
        600:{
            items:1,
            nav:false,
            loop:true,
        },
        1000:{
            items:2,
            nav:true,
            loop:true
        },
    },
  });
  
  $(document).on('click', '.owl-item>div', function() {
	var $speed = 300;  // in ms
	$owl.trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
  });
  
  	// hour and days selection box
	var hourSelectBox = document.getElementById("hours").getElementsByTagName("select")[0];
	var daySelectBox = document.getElementById("days").getElementsByTagName("select")[0];
		// for hourse
        for (var i = 1; i <= 24; i++) {
            var option = document.createElement("option");
            option.text = i + " Hours";
            option.value = i;
            hourSelectBox.add(option);
        }

		// for days
		for (var i = 1; i <= 30; i++) {
            var option = document.createElement("option");
            option.text = i + " Days";
            option.value = i;
            daySelectBox.add(option);
        }

// $('.duration-select-box').children('select').click(function(){
// 	var dataId=$(this).parent('.duration-select-box').attr('data-class');
// 	alert(dataId);
// 	createSelectBox(dataId);
// })
createSelectBox('select-hours');
createSelectBox('select-days');
// -----Select box styling script
	function createSelectBox(class_name){
		var x, i, j, l, ll, selElmnt, a, b, c;
		x = document.getElementsByClassName(class_name);		
		l = x.length;
		// console.log(l);
		for (i = 0; i < l; i++) {
			// console.log(l+2);
		selElmnt = x[i].getElementsByTagName("select")[0];
		ll = selElmnt.length;
		/*for each element, create a new DIV that will act as the selected item:*/
		a = document.createElement("DIV");
		a.setAttribute("class", "select-selected");
		a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
		x[i].appendChild(a);
		/*for each element, create a new DIV that will contain the option list:*/
		b = document.createElement("DIV");
		b.setAttribute("class", "select-items select-hide");
		for (j = 1; j < ll; j++) {
			/*for each option in the original select element,
			create a new DIV that will act as an option item:*/
			c = document.createElement("DIV");
			c.innerHTML = selElmnt.options[j].innerHTML;
			c.addEventListener("click", function(e) {
				/*when an item is clicked, update the original select box,
				and the selected item:*/
				var y, i, k, s, h, sl, yl;
				s = this.parentNode.parentNode.getElementsByTagName("select")[0];
				sl = s.length;
				h = this.parentNode.previousSibling;
				for (i = 0; i < sl; i++) {
				if (s.options[i].innerHTML == this.innerHTML) {
					s.selectedIndex = i;
					h.innerHTML = this.innerHTML;
					y = this.parentNode.getElementsByClassName("same-as-selected");
					yl = y.length;
					for (k = 0; k < yl; k++) {
					y[k].removeAttribute("class");
					}
					this.setAttribute("class", "same-as-selected");
					break;
				}
				}
				h.click();
			});
			b.appendChild(c);
		}
		x[i].appendChild(b);
		a.addEventListener("click", function(e) {
			/*when the select box is clicked, close any other select boxes,
			and open/close the current select box:*/
			e.stopPropagation();
			closeAllSelect(this);
			this.nextSibling.classList.toggle("select-hide");
			this.classList.toggle("select-arrow-active");
			});
		}
		function closeAllSelect(elmnt) {
		/*a function that will close all select boxes in the document,
		except the current select box:*/
		var x, y, i, xl, yl, arrNo = [];
		x = document.getElementsByClassName("select-items");
		y = document.getElementsByClassName("select-selected");
		xl = x.length;
		yl = y.length;
		for (i = 0; i < yl; i++) {
			if (elmnt == y[i]) {
			arrNo.push(i)
			} else {
			y[i].classList.remove("select-arrow-active");
			}
		}
		for (i = 0; i < xl; i++) {
			if (arrNo.indexOf(i)) {
			x[i].classList.add("select-hide");
			}
		}
		}
		/*if the user clicks anywhere outside the select box,
		then close all select boxes:*/
		document.addEventListener("click", closeAllSelect);

	}
// -------select box styling script end

// Focus input on load
$("#login").on('shown.bs.modal', function () {
    $('#phone').focus();
    $('#name').focus();
});

function notificationToast(message) {
	alert(message);
	var newElement = document.createElement('div');
    newElement.textContent = message;
	console.log(newElement);
    newElement.classList.add('alert', 'alert-primary','hidden'); // Add a class to the element
    newElement.id = 'toast'; // Set the ID of the element
	console.log($('#toast').html());
	showToast();
	
}

function showToast(message){
	$('#toast').html(message);
	// alert(message);
	$('#toast').removeClass('hidden').fadeIn(400);
	console.log($('#toast'));
    setTimeout(function() {
      $('#toast').fadeOut(400, function() {
        $(this).addClass('hidden');
      });
    }, 3000); // Hide after 3 seconds
}











