
@extends('layouts.adminlayout')
@section('title',"Blog | MedCab")
@section('description',"MedCab is India’s future of emergency medical transport. Need emergency/non - emergency
ambulance? Call MedCab at 18008-908-208.")
@section('keywords',"MedCab, MedCab Blog, MedCab Latest News")
@section('main')

<!-- Start Blog Banner Section -->
<section class="blogs">
    <div class="blog-banner">
    <div class="container ">
        <div class="row gy-4">
            <div class="col-md-6 d-flex-center">
                <div class="banner-text-left">
                    <h1 class="banner-heading">
                        Welcome To<br/> MedCab Blogs
                    </h1>
                    <p class="banner-text">
                    Here we talk about our recent developments in technology, product, services and our achievements
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex-center">
                <div class="banner-img-right">
                    <img src="{{url('/assets/image/blog-img.png')}}" alt="">
                </div>
            </div>
        </div>
    </div> 
    </div>
    <div class="container top-60 p-relative"> 
        <div class="row banner-poster  p-realtive flex-row-reverse ">
            
           
            <div class="col-lg-7 col-md-6 d-flex-center p-0">
                <div class="banner-poster-right w-100 h-100">
                    <h3><b class="">I Must Read</b></h3>
                    <H4>26 Health Tips: An Ultimate Guide to a Healthy Lifestyle</H4>
                    <p class="p-text">
                    Transform your life in 2023 with our Ultimate Guide to 26 Health Tips. Prioritize your well-being
                    and start your journey to a happier, healthier you today. 
                    </p>
                    <span>Posted on 14 february, 2023</span><br/>
                    <a href="" class="read-more text-color-red">Read More</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 p-0 poster-img-left">
                <div class="poster-img">
                        <img src="{{url('/assets/image/banner-ambu.png')}}" alt="" class="w-100 h-100">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="blog-list mt-5">
            <div class="row d-flex-center align-items-start  ">
                <div class="col-lg-5 col-md-12 ">
                    <h1 class="title-text ">Our Latest Articles</h1>
                </div>
            </div>
            <?php  foreach($blogs as $blog){ ?>
                <div class="row d-flex-center align-items-start  w-auto">
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-img">
                            <img src="https://madmin.cabmed.in/{{$blog->blog_thumbnail}}" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 d-flex align-items-start flex-direction-column">
                        <div class="blog-text">
                        
                            <H4 class="sub-heading">{{$blog->blog_title}}</H4>
                            <p class="p-text">
                            {!!$blog->blog_meta_desc!!}
                            </p>
                            <span class="post-date-text"><i>Posted on{{ $blog->blog_post_date}}</i></span><br/>
                            <a href="" class="read-more text-color-red">Read More..</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <div class="read-more-blog w-100 d-flex-center">
                <a href="" class="more-blog">Load More..</a>
            </div>
        </div>
    </div>
</section>
<!-- dowmload banner -->
@include('include.download_banner');
<!-- dowmload banner --> 

<!-- End Blog Banner Section -->







@endsection
