<section class="our-services w-100 padding">
  <h1 class="our-services-heading text-center">Our Services</h1>

  @php
  $ser_caty = DB::table('ambulance_category')->where('ambulance_category_status', '0')->get();
  @endphp

  <div class="our-servicesCards owl-carousel owl-carousel-services owl-themez">
    @if (!empty($ser_caty))
      @foreach ($ser_caty as $ser_cat)
        <div class="our-servicesCard item">
          <h2>{{ $ser_cat->ambulance_category_name }}</h2>
          <div class="our-servicesCard-image">
            <img src="{{ url($ser_cat->ambulance_category_icon) }}" alt="{{ $ser_cat->ambulance_category_name }}" />
          </div>
          <p>
            {{ $ser_cat->ambulance_catagory_desc }}
          </p>
          <div class="service-icons">
            <div class="icon">
              @if (Session::has('ambu_equips'))
                @foreach (Session::get('ambu_equips') as $ambu_equip)
                  @if ($ser_cat->ambulance_category_type == $ambu_equip->ambulance_facilities_category_type)
                    <img src="{{ url($ambu_equip->ambulance_facilities_image) }}" alt="{{ $ambu_equip->ambulance_facilities_name }}" />
                  @endif
                @endforeach
              @endif
            </div>
          </div>
          @if(!empty($ser_cat->ambulance_category_sku))
          <a href="{{ route('Services-Detail', ['title' => $ser_cat->ambulance_category_sku]) }}" class="read-more">Read More</a>
          @else
          <a href="#" class="read-more">Read More</a>
          @endif
        </div>
      @endforeach
    @endif
  </div>

  <div class="btn-view">
    <a href="{{ route('OurServices') }}">View All
      <svg class="mb-1 ms-1" width="18" height="14" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20.7071 8.7071C21.0976 8.31658 21.0976 7.68342 20.7071 7.29289L14.3431 0.928931C13.9526 0.538407 13.3195 0.538407 12.9289 0.928931C12.5384 1.31946 12.5384 1.95262 12.9289 2.34314L18.5858 8L12.9289 13.6569C12.5384 14.0474 12.5384 14.6805 12.9289 15.0711C13.3195 15.4616 13.9526 15.4616 14.3431 15.0711L20.7071 8.7071ZM8.74227e-08 9L20 9L20 7L-8.74227e-08 7L8.74227e-08 9Z" fill="white" />
      </svg>
    </a>
  </div>
</section>
