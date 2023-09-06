
@extends('layouts.adminlayout')
@section('title',"Blog | MedCab")
@section('description',"MedCab is India’s future of emergency medical transport. Need emergency/non - emergency
ambulance? Call MedCab at 18008-908-208.")
@section('keywords',"MedCab, MedCab Blog, MedCab Latest News")
@section('main')


<?php $base_url="https://medcab.in/" ?>
<!-- Start Blog Banner Section -->
<section class="blog-section">
    <div class="container">
        <!-- <h1 class="page-heading">Read Our New Achievements</h1> -->
        
        <div class="blog-top-banner">
            <img src="{{asset('assets/image/blog-top-banner.png')}}" alt="Blog Top Banner" class="h-100 w-100">
        </div>
        <div class="blog-types justify-content-center">
            <a href="{{URL::route('Blog-Filter',['search_key'=>'all'])}}" class="blog-type-btn active">View All</a>
            <a href="{{URL::route('Blog-Filter',['search_key'=>'Ambulances'])}}" class="blog-type-btn">Ambulances </a>
            <a href="{{URL::route('Blog-Filter',['search_key'=>'experience'])}}" class="blog-type-btn">User experience</a>
            <a href="{{URL::route('Blog-Filter',['search_key'=>'Technology'])}}" class="blog-type-btn">Technology</a>
            <a href="{{URL::route('Blog-Filter',['search_key'=>'Business'])}}" class="blog-type-btn">Business</a>
            <a href="{{URL::route('Blog-Filter',['search_key'=>'Healthcare'])}}" class="blog-type-btn">Healthcare</a>
        </div>
        <div class="blog-outer">
            <div class="row m-0 d-flex justify-content-around">
                <div class="col-lg-7 col-md-12 mb-lg-0 mb-5">
                    <div class="blog-list">
                    <h3 class="">Our Latest Articles</h3>
                    <div class="blog-items">
                        <?php  for($i=0;$i<5;$i++) { ?>
                        <div class="blog-box d-flex row">
                            <div class="col-lg-5 col-md-6">
                                <img src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="{{$blogs[$i]->blog_title}}" >
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="blog-text">
                                    <H4 class="sub-heading text-break">{{$blogs[$i]->blog_title}}</H4>
                                    <p class="p-text text-wrap w-100">
                                    {!!$blogs[$i]->blog_meta_desc!!}
                                    </p>
                                    <span class="post-date-text">{{$blogs[$i]->blog_post_date}}</span><br/>
                                    <a href="{{URL::route('Blog-Detail',['title'=>$blogs[$i]->blog_sku])}}" class="read-more text-color-red">Read More..</a>
                                </div>
                            </div>
                        </div>
                        <?php 
                          }?>
                    </div>
                    <span class="hr-line"></span>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-10 text-break p-0">
                    <div class="blog-right ">
                        <h3>Must Read</h3>
                        <div class="read-blog-list">        
                            @for($c=5;$c<=10;$c++)
                            <div class="read-blog-item">
                                <img src="{{$base_url.$blogs[$c]->blog_thumbnail}}" alt="{{$blogs[$i]->blog_title}}">
                                <a href="{{URL::route('Blog-Detail',['title'=>$blogs[$c]->blog_sku])}}">{{$blogs[$c]->blog_title}}
                                    <br/><p><i class="fa-solid fa-arrow-right-long"></i></p>
                                </a>
                            </div>
                            @endfor
                        </div>
                        <div class="subscribe">
                           <img src="{{URL::to('assets/image/corner.png')}}" alt="Corner BG" class="corner-img" alt=""> 
                            <h4>Stay Updated</h4>
                            <h5>Subscribe to Medcab newsletter</h5>
                            <form action="">
                                <input type="email" placeholder="Enter your email id">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="more-blog-list">
            <div class="row d-flex-center align-items-start gy-3">

            <?php for ($i = count($blogs) - 1; 0 <= $i; $i--) {?>
                <div class="col-lg-4">
                    <div class="more-blog-item">
                        <img src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="{{$blogs[$i]->blog_title}}" class="w-100" style="height:160px;">
                        <div class="more-blog-text">
                                    <H4 class="sub-heading text-break">{{$blogs[$i]->blog_title}}</H4>
                                    <p class="p-text text-wrap h-100">
                                    {!!$blogs[$i]->blog_meta_desc!!}
                                    <a href="{{URL::route('Blog-Detail',['title'=>$blogs[$i]->blog_sku])}}" class="read-more text-color-red">Read More..</a>
                                    </p>
                        </div>
                    </div>
                </div>
                <?php 
                if(count($blogs)-3==$i){
                break;
                }
                 }
                 ?>
            </div>
        </div>
        <div class="read-more-blog w-100 d-flex-center mt-5 d-done">
                <!-- <a href="" class="more-blog">Load More..</a> -->
                <!-- {{$blogs->links()}} -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <!-- <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a> -->
                    </li>
                    @foreach($links as $link)
                    <li class="page-item"><a class="page-link" href="{{$link['url']}}">{!!$link['label']!!}</a></li>
                    @endforeach
        
                    <li class="page-item">
                    <!-- <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a> -->
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner --> 

<!-- End Blog Banner Section -->
@endsection
