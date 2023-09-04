<!-- Our Services -->
<section class="services section-padding">
    <div class="container">
        <div class="services-container">
            <h1 class="title-text m-auto text-center text-white" >Our Services</h1>
            <h3 class="p-text text-center text-white mt-4">
            Choose the ambulance that best fits your needs
            </h3>
            <?php $i=9;
            $ser_caty=DB::table('ambulance_category')->where('ambulance_category_status','0')->get();
            
            ?>
            <div class=" service-types gy-4 owl-carousel ">
                <?php if(!empty($ser_caty)){
                        foreach($ser_caty as $ser_cat){
                ?>
                
                    <div class="service-box ">
                    <span class="ser-title">{{$ser_cat->ambulance_category_name}}</span>
                        
                        <div class="ser-detail">
                    <img src="{{url($ser_cat->ambulance_category_icon)}}" alt="Basic Ambulance" class="ser-type-img">

                            <p class="ser-desc">{{$ser_cat->ambulance_catagory_desc}}</p>
                            <div class="ser-facility">
                            <?php if(Session::has('ambu_equips')){
                                foreach(Session::get('ambu_equips') as $ambu_equip){
                                if($ser_cat->ambulance_category_type==$ambu_equip->	ambulance_facilities_category_type){
                                ?>      
                                <img src="{{url($ambu_equip->ambulance_facilities_image)}}" alt="Ambulance kit" class="ser-facility-icon">
                                
                            <?php
                                }
                                }
                            }
                            ?>    
                            </div>
                        </div>
                        <a href="" class="btn read-link-btn">Read More</a>
                    </div>
                
                <?php
                    $i--;
                    }
                }
                ?>
                
                
            
        </div>
        
    </div>
</section>
<!-- Our Services -->