@extends('layouts.adminlayout')
@section('title', $our_services->our_services_meta_titles)
@section('description', $our_services->our_services_meta_desc)
@section('keywords', $our_services->our_services_meta_keyword)
@section('main')
<!-- Start our_services Banner Section -->
<section class="our_services-section our_services-detail">
    <div class="container">
        <p class="mt-5"><span class="me-3"></span>{!!$our_services->our_services_post_date!!}</p>
        <div class="our_services-detail-img mt-5 mb-5">
        <img src="{{ asset($our_services->our_Services_thumbnails) }}" alt="{{ $our_services->our_services_titles }}" class="w-100">
        </div>
        <div class="d-flex">
            <div class="our_services-content-text">
                {!! $our_services->our_services_desc!!}
            </div>

            <!-- most read part -->
            
        </div>
        <!-- read more our_servicess -->
        <!-- read more blogs -->
    </div>
</section>
<!-- download banner -->
@include('include.download_banner')
<!-- download banner -->

<!-- End Blog Banner Section -->
@endsection