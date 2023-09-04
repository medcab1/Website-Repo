
@extends('layouts.configLayout')
@section('title',"Ambuance-booking")
@section('main')
<?php
    if(Session::has('users')){
        $users=session()->get('users');
    
    }
    // echo '<pre/>';
    // dd($booking_data);
    $cat_type=$booking_data['ambu_cat'];
    $ambu_case=$booking_data['ambu_case'];
    $ambu_facilities=$booking_data['ambu_facilities'];
    $ambu_support=$booking_data['ambu_support']
?>

<style>
    .ambu-type-box:hover{
        background-color: none!important;
    }
    .ambu-type-box{
        background-color: #e0f2f1cf!important;
    }
    .ambu-types-img{
        border:none!important;
        display:flex;
        justify-content:center;
        align-items:center;
    }
</style>
<div class="container ambulance-search ">
    
    <div class="ambulance-search-body">
        <div class="container-body h-100" >
            <a href="{{route('Home')}}" class="move-page-btn"><i class="fa-solid fa-arrow-left-long"></i>
                @if($users['booking-type']==0)
                    Emergency Ambulance Booking
                @elseif($users['booking-type']==1)
                    Rental Ambulance Booking
                @elseif($users['booking-type']==2)
                    Bulk Ambulance Booking
                @endif
                {{Session::get('booking_id')}}
            </a>
            <div class="ambulance-search-body">
                <div class="row justify-content-center ambulance-search-body-row  m-0 p-0 gy-3">
                    <div class="col-lg-5 ambu-detail-col ambu-search-left ml-auto booking-page-left">
                        <div class="search-form">
                            <form class="booking-form" id="forms">
                                @csrf    
                                <div class="form-group">
                                    <label>PickUp Location</label>
                                    <div class="input-group pick-group justify-content-center align-items-center bg-light-gray">
                                        <img src="{{url('/assets/image/pickup-icon.png')}}" alt="Pickup address icon" style="margin-left:10px;" >
                                        <input type="text" class="form-control pick b-none input-focus-none p-0 pr-2"  name="pick"  id="pickup" value="{{$users['pick']}}KM"  disabled>
                                    </div>
                                </div>
                                
                               
                        @if($users['booking-type']==0 ||$users['booking-type']==2)
                        <div class="form-group p-relative ">
                            <label>Drop Location</label>
                            <div class="input-group drop-group justify-content-center align-items-center bg-light-gray gx-2">
                                <img src="{{url('/assets/image/drop-icon.png')}}" alt="Drop address icon" style="height:16px;width:16px;">
                                <input type="text" class="form-control b-none input-focus-none" id="drop" name="drop" value="{{$users['drop']}}" disabled >
                            </div>
                            
                        </div>
                        @endif
                        @if($users['booking-type']==1)
                                <div class="form-group p-relative ">
                                    <label>Duration</label>
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
                        @endif
                        @if($users['booking-type']!=1)
                        <div class="form-group p-relative ">
                                    <label>Distance</label>
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
                    <div class="col-lg-7 ambu-detail-col ambu-search-right booking-page-right w-"  >
                        <div class="ambu-types">
                            <div class="ambu-types-body booking-for-body h-100">
                                <h5 class="type-heading"> Booking For</h5>
                                <div class="ambu-types-list h-100 d-flex flex-column">
                                    <div class="ambu-facilities-list">
                                        <div class="ambu-type-box p-relative p-0 border border-0">
                                            <div class="ambu-types-img d-block p-1" style="width:fit-content;border:1px solid gray;">
                                                <img src="{{$cat_type->ambulance_category_icon}}" alt="{{$cat_type->ambulance_category_name}}" >
                                            </div>
                                            <div class="ambu-types-detail">
                                                <h4 class="ambu-type-heading">
                                                {{$cat_type->ambulance_category_name}}
                                                </h4>
                                                <a class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#basic"> Read more</a>
                                            </div>
                                            <div class="ms-auto ambu-type-price-detail">
                                                <span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign mr-1"></i>
                                                    @if(Session::has('selAmbuData'))
                                                    @if($users['booking-type']==2)
                                                    {{Session::get('selAmbuData')['total_price']/Session::get('selAmbuData')['total_ambu'].'*'.Session::get('selAmbuData')['total_ambu']}}
                                                    @else
                                                    {{Session::get('selAmbuData')['total_price']}}
                                                    @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="total-amount">
                                        <span>Total Amount</span>
                                        <span class="t-amount">
                                            <i class="fa-solid fa-indian-rupee-sign ml-3"></i> &nbsp;{{Session::get('selAmbuData')['total_price']}}
                                        </span>
                                    </div>
                                    <div class="add-on">
                                        <div class="add-support-toggler">
                                            <div class="toggle-text">
                                                <i class=" fa fa-light fa-circle-plus"></i>
                                                &nbsp;&nbsp;<span>Add Support Specialists</span>
                                            </div>
                                            <div class="toggle-icon">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="add-support flex-wrap">
                                            @if(Session::has('support_list'))
                                            <?php $i=0;
                                            $supports=Session::get('support_list');
                                            ?>
                                            @foreach($ambu_support as $support_list)
                                            <?php $i++;?>
                                            @if($i<=3)
                                            <div class="add-support-item flex-basis-50">
                                                <span class="support-header">
                                                    <span class="support-name" support-icon="{{env('APP_BASE_URL').$support_list->ambulance_support_specialists_image_circle}}">{{$support_list->ambulance_support_specialists_name}}</span>
                                                    <span class="support-price"><i class="fa-solid fa-indian-rupee-sign ml-3"></i>{{$support_list->ambulance_support_specialists_amount}}</span>
                                                </span>
                                                
                                                <p class="support-des">
                                                    Need an ambulance support. Book Now!.
                                                </p>
                                                <div class="support-control-btn">
                                                    <button class="addon-btn add-btn">Add</button>
                                                    <button class="addon-btn added-btn"><i class="fa-solid fa-check"></i>Added</button>
                                                    <button class="addon-btn remove-btn">Remove</button>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="payment">
                                        <span class=" form-heading">
                                            Select payment Type: 
                                        </span>
                                        <div class="payment-type">
                                            <div class="payment-type-item">
                                                <input type="radio" name="pay_method" value="1" class="full_pay" id="pay_full_radio">
                                                <span class="payment-type-name" id="pay_full">Full payment<br/>
                                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;<span>00</span>
                                                </span>
                                            </div>
                                            <div class="payment-type-item">
                                                <input type="radio" name="pay_method" value="2" class="full_pay" id="pay_advance" >
                                                <span class="payment-type-name" >Pay Advance<br/>
                                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                                    &nbsp;<span id="adv"></span>
                                                </span>
                                            </div>
                                            <div class="payment-type-item">
                                                <input type="radio" name="pay_method" value="3" class="full_pay" id="cash-radio" >
                                                
                                                <span class="payment-type-name" id="pay_cash">Pay Cash<br/>
                                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;<span></span>
                                                </span>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="alert alert-warning payment-alert gx-1 mt-2" role="alert" style="display:none;">
                                        <i class="fa-solid f-2x fa-circle-exclamation m-1"></i>
                                        <div class="payment-notice-mess w-100">
                                            <div class="p-notice-header d-flex" style="justify-content:space-between;">
                                                <span class="notice-heading">
                                                    Remaining Amount
                                                </span>
                                                <span class="notice-amount">
                                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;
                                                </span>
                                            </div>
                                            <p class="notice-des">
                                                You have to pay remaining amount after <br/> complitions of the ride.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="consumer-form   flex-shrink-0">
                                        <span class="consumer-form-heading form-heading">
                                            Add Customer Details 
                                        </span>
                                        <div class="consumer-form  ">               
                                            <form  id="consumer-detail-form h-100" >
                                                @csrf
                                                <div class="form-field">
                                                    <div class="form-group p-relative">
                                                        @if($message = Session::get('consumer_name'))
                                                            <label >Customer Name</label>
                                                            <input type="text" class="form-control"  id="c_name" value="{{session('consumer_name')}}" name="c_name" placeholder="Enter Your Name">
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="pay_type" id="pay_type" value="">
                                                    <div class="form-group p-relative">
                                                        @if($message = Session::get('consumer_mob'))
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control"  id="c_mob" value="{{session('consumer_mob')}}" name="c_mob" placeholder="Enter Mobile Number">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="proceed-btn-outer">
                                                    <button type="submit"  id="cust-btn" disabled>
                                                        Proceed
                                                    </button>
                                                </div>
                                          
                                            </form>    
                                        </div>
                                    </div>
                                    <!-- Read MOre model start -->
                                    <div class="modal p-3" id="basic" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h6 class="modal-title text-secondary" >{{Session::get('ambu_type')}}</h6>
                                                            <button type="button" class="modal-close close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="epuipment">
                                                                <span class="equip-sub-heading">Facilities</span>
                                                                <div class="equipment-type-list">
                                                                @if(Session::has('ambu_data'))
                                                                            @foreach(session('ambu_data')['ambu_facilities'] as $facility)
                                                                            <div class="equipment-type">
                                                                                <div class="equipment-img">
                                                                                    <img src="{{$facility->ambulance_facilities_image}}" alt=" {{$facility->ambulance_facilities_name}}">
                                                                                </div>
                                                                                <span class="equipment-name" style="font-size:10px;"> 
                                                                                {{$facility->ambulance_facilities_name}}
                                                                                </span>
                                                                            </div>
                                                                            @endforeach
                                                                        @endif
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="case-list mt-4">
                                                                <span class="equip-sub-heading">For case like:</span>
                                                                <div class="case-list-items">
                                                                    <ul>
                                                                        
                                                                            
                                                                        @if(Session::has('ambu_data'))
                                                                            @foreach(session('ambu_data')['ambu_case'] as $case)
                                                                                <li>{{$case}}</li>
                                                                            @endforeach
                                                                        @endif
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
                                            <!-- ambu-type end -->
                                            <div class="payment-method flex-column">
                                                    <span class="form-heading">Select Payment Method</span>
                                                    <div class="payment-group cc-pay" id="pay" >
                                                        
                                                        <div class="payment-group-left" >
                                                            <img src="assets/icons/card.png" alt="CCAvenue Pay" class="payment-icon" >
                                                            <span class="payment-method-name">CCAvenue Pay </span>
                                                        </div>
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                                    <span class="pay-option text-gray">Pay Via UPI</span>

                                                    <div class="payment-group">
                                                        <div class="payment-group-left">
                                                            <img src="assets/icons/Gpay.png" alt="Gpay" class="payment-icon">
                                                            <span class="payment-method-name">Gpay</span>
                                                        </div>
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                                    <div class="payment-group">
                                                        <div class="payment-group-left">
                                                            <img src="assets/icons/paytm.png" alt="Paytm" class="payment-icon">
                                                            <span class="payment-method-name">Paytm</span>
                                                        </div>
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                                    <div class="payment-group">
                                                        
                                                        <div class="payment-group-left">
                                                            <img src="assets/icons/upi.jpg" alt="Bhim UPI" class="payment-icon">
                                                            <span class="payment-method-name">Bhim UPI</span>
                                                        </div>
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                            </div>  
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <form action="https://medcab.in/assets/cc_pay_soni/ccavRequestHandler.php" method="post" id="pay-form" hidden>
                            <input type="text" name="consumer_id" hidden value="{{session('consumer_id')}}">
                            <input type="text" name="booking_id" hidden value="{{session('booking_id')}}">
                            <input type="text" name="merchant_id" hidden value="2566639">
                            <input type="text" name="order_id" hidden value="MEDCAB{{session('booking_id').rand(100,999)}}">
                            <input type="text" name="amount" id="pay-amount" hidden value="1">
                            <input type="text" name="merchant_param4" hidden value="0">
                            <input type="text" name="currency" hidden value="INR">
                            <input type="text" name="merchant_param1" hidden value="{{session('consumer_id')}}">
                            <input type="text" name="merchant_param2" hidden value="{{session('booking_id')}}">
                            <input type="text" name="redirect_url" value="https://medcab.in/assets/cc_pay_soni/ccavResponseHandler.php" hidden/>
                            <input type="text" name="cancel_url" value="https://medcab.in/assets/cc_pay_soni/ccavResponseHandler.php" hidden/>
                            <button type="submit" class="pay-now btn-click-effect">Pay Now</button>
                        </form>                      
                           
<!-- Read MOre model start -->
<script>
    window.onload = function() {
        $('.cc-pay').click(function() {
            $('#pay-form').submit();
        });
        var tp=parseInt($('.ambu-price').text());
        // $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign mr-1"></i>'+$('.ambu-price').text());
        $('#adv').html(($('.t-amount').text()*10)/100);
        if("{{$users['booking-type']}}"==1){
            createMapFun("{{$users['pick_lat']}}","{{$users['pick_lng']}}",'https://medcab.in/assets/image/pick-icon.png',"Your pickup location",'map')
        }else{
            polyline_display("{{$users['pick']}}","{{$users['drop']}}","map");
        }

        $('.add-support-toggler').click(function(){
            $(".add-support").toggleClass('show');   
            $('.toggle-icon .fa-chevron-down').toggleClass('move'); 
        }); 
        
  
        $('.full_pay').click(function(){
            $('#cust-btn').prop('disabled', false);
            $('#cust-btn').css('opacity','1');
            $('#pay_type').val($(this).val());     
        let check=$('#pay_advance').is(':checked');
        if(check==true){
            $('.payment-alert').css('display','flex');
        }
        else{
            $('.payment-alert').css('display','none');
        }
        });
        //remaining payment calculation
        var full_pay=parseInt($('#pay_full span').text());
        var adv_pay=parseInt($('#adv').text());
        $('#pay_full span').text($('.t-amount').text());
        $('#pay_cash span').text($('.t-amount').text());
        $('.notice-amount').html(' <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+($('.t-amount').text()-adv_pay));
        $('.t-amount').on('DOMSubtreeModified',function(){

            var full_pay=parseInt($('.t-amount').text());
            // console.log(full_pay);
            // console.log(adv_pay);
            $('#adv').html((full_pay*10)/100);
            var adv_pay=parseInt($('#adv').text());
            $('.notice-amount').html(' <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+(full_pay-adv_pay));
            $('#pay_full span').text(full_pay);
            $('#pay_cash span').text(full_pay);

            })
        
        $('.add-btn').click(function(){
                const addThis=$(this);
                addThis.closest('.add-support-item').attr('addonsStatus','added');
                var addons_div=addThis.closest('.add-support-item').attr('addonsStatus');
                var supportName=addThis.closest('.add-support-item').find('.support-header').find('.support-name').text();
                var supportPrice=addThis.closest('.add-support-item').find('.support-header').find('.support-price').text();
                var support_icon=addThis.parent().siblings('.support-header').children('.support-name').attr('support-icon');
                $.ajax({
                    type:'POST',
                    url:"{{ route('Addons_Session_Save') }}",
                    data:{supportName:supportName,supportPrice:supportPrice},
                    success:function(data){
                        
                        if(data.booking_addons_status==0){
                            addThis.css("display","none");
                            addThis.siblings('.added-btn').css("display","block");
                            addThis.siblings('.remove-btn').css("display","block");
                                let s_name=addThis.parent('.support-control-btn').siblings('.support-header').children('.support-name').html();
                                let s_price=addThis.parent('.support-control-btn').siblings('.support-header').children('.support-price').text();
                                // console.log(s_name+s_price);
                                var t_amount=parseInt($('.t-amount').text())+(parseInt(s_price)*"{{session('selAmbuData')['total_ambu']}}");
                                $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+t_amount);
                                var add_on='<div class="ambu-type-box p-relative p-0 border border-0">'+
                                                                    '<div class="ambu-types-img overflow-hidden" style="height:50px;width:50px;border:1px solid gray;"><img src="'+support_icon+'" alt="'+supportName+'" class="h-100"></div><div class="added-support-detail"><div class="ambu-types-detail">'+
                                                                    '<h4 class="ambu-type-heading">'+s_name+'</h4>'+
                                                                       
                                                                    '</div>'+
                                                                    '<div class="ambu-type-price-detail">'+
                                                                        '<span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+ 
                                                                            <?php if($users['booking-type']==2){?>
                                                                            s_price+"*{{session('selAmbuData')['total_ambu']}}"+'</span></div></div></div>';
                                                                            <?php }else{ ?>
                                                                            s_price+'</span></div></div></div>';
                                                                            <?php }?>
                                                                       
                            
                                $('.ambu-facilities-list').append(add_on);  
                        }
                        else{
                            alert(data.booking_addons_status+" Else Condition statment!");
                        }
                    
                    },
                    error:function(data){
            
                    }
                });
        });
        <?php
        if (Session::has('addons_status'))
        {
           ?>
                    // alert("{{Session::get('addons_status').Session::get('error').Session::get('booking_id')}}");
         <?php     
            }
         ?>
        $('.remove-btn').click(function(){
            $(this).closest('.add-support-item').attr('addonsStatus','removed');
            var addons_div=$(this).closest('.add-support-item').attr('addonsStatus');
            var supportName=$(this).closest('.add-support-item').find('.support-header').find('.support-name').text();
            var supportPrice=$(this).closest('.add-support-item').find('.support-header').find('.support-price').text();
              
            $.ajax({
                    type:'POST',
                    url:"{{route('Remove_Addon')}}",
                    data:{supportName:supportName,supportPrice:supportPrice},
                    success:function(data){
                    // console.log(data.addons_status);
                    },
                    error:function(data){
                    // console.log(data.addons_status);
                    }
                });
            // window.location.replace("{{url('/remove_addon')}}"+"/"+supportName+"/"+supportPrice);
            $(this).css("display","none");
            $(this).siblings('.add-btn').css("display","block");
            $(this).siblings('.added-btn').css("display","none");
            let s_price=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-price').text();
            var n1=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-name').html();
            $(".ambu-type-box").each(function() {
                var nn1=$(this).children('.added-support-detail').find('.ambu-type-heading').html();
                if(n1==nn1){
                    $(this).css('display','none');
                }
            
            });
            var t_amount=parseInt($('.t-amount').text())-parseInt(s_price*"{{session('selAmbuData')['total_ambu']}}");
            $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+(t_amount));
            
        });
    


        $('#cust-btn').on('click',function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    var c_name=$('#c_name').val();
    var c_mob=$('#c_mob').val();
     var full_amount=$('.t-amount').text(); 
     var adv_amount=(full_amount*10)/100; 
    var pay_type=$('#pay_type').val();
    $.ajax({
     
                type:'POST',
                url:"{{ route('Booking_Process') }}",
                data:{c_mob:c_mob,c_name:c_name,total:$('.t-amount').text(),full_amount:full_amount,adv_amount:adv_amount,pay_type:pay_type,total_ambu:"{{session('selAmbuData')['total_ambu']}}",},
               
                success:function(resData){
                    // console.log(resData);
                    $('#pay-amount').val(resData.pay_amount);
                    // console.log($('.t-amount').text());
                    // console.log($('#consumer-detail-form').serialize());
                if($.isEmptyObject(resData.error)){
                    // location.reload();
                    // console.log(resData.code);
                    if(resData.code==3){
                        if("{{session('users')['booking-type']}}"==2){
                            window.location.replace('/bulk_booking/save_bulk_booking_details');
                        }
                        else{
                            window.location.replace('/driver/search-driver');
                        }
                    }
                    else{
                        $('.payment-method').css('display','flex');
                        $('.payment-type-item').addClass('disabled');
                        $('.consumer-form').hide();

                    }
                 
                }else{
                    console.log(resData.consumer);
                }
                },
            error:function(resData){
            console.log(resData.status+"wrong");
            }
        });
});

$('#consumer-detail-form').on('submit',function(e){
    e.preventDefault();
});

$('.support-header').each(function(){
    var supportName=$(this).find('.support-name').text();
    <?php 
    if(Session::get('booking_addons')){
        foreach(Session::get('booking_addons') as $addon){
            ?>
            if('{{$addon->booking_addons_name}}'==supportName && '{{$addon->booking_addons_status}}'=='0' ){
                    $(this).siblings('.support-control-btn').find('.add-btn').click();
                    // alert("add"+'{{$addon->booking_addons_status}}'=='0');
               
            }
           
            <?php
        }
    }
        
    ?>

})


};




    
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var total=document.getElementsByClassName('t-amount')[0].innerText;
var payMethod = document.getElementsByClassName('payment-group');

Array.prototype.forEach.call(payMethod, function(element) {
    element.addEventListener('click', function(e) {
    var amt=$("input[id=pay_full_radio]").siblings('span').children('span').text();
    if($('#pay_advance').is(':checked')){
        var amt=$("input[id=pay_advance]").siblings('span').children('span').text();
        // console.log($("input[id=pay_advance]").prop("checked", true));
        // $('#pay-amount').val(amt);
        console.log($('#pay-amount').val());
        console.log("Payment Amount:"+amt);
    }
    // if($('#pay_full').is(':checked')){
       
    // }

    // payment script

    if($('input[id="pay_full_radio"]').is(':checked')){
        $('input[id="pay_full_radio"]').click();
        var amt=$("input[id=pay_full_radio").siblings('span').children('span').text();
        // console.log($("input[id=pay_advance]").prop("checked", true));
        // $('#pay-amount').val(amt);
        console.log($('#pay-amount').val());
        console.log("Full Payment Amount:"+amt);

    }
    else if($('input[id="pay_advance"]').is(':checked')){
        $('input[id="pay_advance"]').click();
    }
    else{
        console.log("Payment Method not selected!");
    }
    $('#pay-form').submit();
    // Razor pay payment gateway integration for furthur use  start---

        // e.preventDefault();
        // var amount = $('#payment').val();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': '{{csrf_token()}}',
        //     }
        // });
        // $.ajax({
        //     type: "post",
        //     url: "orderid-generate",
        //     data: {price:amt},
        //     success: function (data) {
        //         var order_id = '';
        //         if (data.order_id) {
        //             order_id = data.order_id;
        //         }

        //         var options = {
        //             "key": "{{ config('app.razorpay_api_key') }}", // Enter the Key ID generated from the Dashboard
        //             "amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        //             "currency": "{{ config('app.currency') }}",
        //             "name": "{{ config('app.account_name') }}",
        //             "description":"Your Ride Payment:",
        //             "image": "{{ asset('images/logo-black.svg') }}",
        //             "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        //             "handler": function (response) {
                        
        //                 // $('#razorpay_payment_id').val(response.razorpay_payment_id);
        //                 // $('#razorpay_order_id').val(response.razorpay_order_id);
        //                 // $('#razorpay_signature').val(response.razorpay_signature);
        //                 // $('#addPaymentForm').submit();
        //                 // window.location.replace("{{url('/payment')}}"+"/"+response.razorpay_payment_id+"/"+response.razorpay_order_id+"/"+response.razorpay_signature);
        //                 alert("payment ID:"+response.razorpay_payment_id);
        //             },
                   
        //             "modal": {
        //             "ondismiss": function () {
        //                 if (confirm("Are you sure, you want to close the form?")) {
        //                 txt = "You pressed OK!";
        //                 console.log("Checkout form closed by the users");
        //                 } else {
        //                 txt = "You pressed Cancel!";
        //                 console.log("Complete the Payment")
        //                 }
        //             }
        //         }
        //             ,
        //             "prefill": {
        //                 "name": "{{ session('consumer_name') }}",
        //                 "email": "webdevelopermedcab@gmail.com",
        //                 "contact": "{{session('consumer_mob')}}"
        //             },
        //             "notes": {
        //                 "address": "Gomati Nagar, Lucknow, Uttar Pradesh"
        //             },
        //             "theme": {
        //                 "color": "#c5354f"
        //             }
        //         };
        //         var rzp1 = new Razorpay(options);
        //         rzp1.on('payment.failed', function (response) {
        //                 alert("Payment Failded:"+response);
        //         });

        //         rzp1.open();


        //     },

        // });
    
    // Razor pay payment gateway integration for furthur use end---
    

    //end payment script
    
    // var options = {
    //         "key": "rzp_test_O4rVxqV6XkdI2A", // Enter the Key ID generated from the Dashboard
    //         "amount":amt*100 , //
    //         "currency": "INR",
    //         "description": "MED CAB",
    //         "image": "assets/icons/red logo.png",
    //         "prefill":
    //         {
    //         "email": "medcab@gmail.com",
    //         "contact": "9876543210",
    //         },
    //         "theme":{
    //             "color":"#c5354f"
    //         },
    //         config: {
    //         display: {
    //             blocks: {
    //             utib: { //name for Axis block
    //                 name: "Pay using Axis Bank",
    //                 instruments: [
    //                 {
    //                     method: "card",
    //                     issuers: ["UTIB"]
    //                 },
    //                 {
    //                     method: "netbanking",
    //                     banks: ["UTIB"]
    //                 },
    //                 ]
    //             },
    //             other: { //  name for other block
    //                 name: "Other Payment modes",
    //                 instruments: [
    //                 {
    //                     method: "card",
    //                     issuers: ["ICIC"]
    //                 },
    //                 {
    //                     method: 'netbanking',
    //                 }
    //                 ]
    //             }
    //             },
    //             hide: [
    //             {
    //             method: "upi"
    //             }
    //             ],
    //             sequence: ["block.utib", "block.other"],
    //             preferences: {
    //             show_default_blocks: false // Should Checkout show its default blocks?
    //             }
    //         }
    //         },
    //     
    });
});
</script>
@endsection