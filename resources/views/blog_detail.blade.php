@extends('layouts.adminlayout')
@section('title', $blog->blog_meta_title)
@section('description', $blog->blog_meta_desc)
@section('keywords', $blog->blog_meta_keyword)
@section('main')
<!-- Start Blog Banner Section -->
<section class="blog-section blog-detail">
    <div class="container">
        <p class="mt-5"><span class="me-3"><a href="{{route('Blogs')}}">&larr;</a></span>{!!$blog->blog_post_date!!}</p>
        <!-- <h1 class="title-text text-center">{{ $blog->blog_title }}</h1> -->
        <div class="blog-detail-img mt-5 mb-5">
            <img src="{{asset($blog->blog_thumbnail)}}" alt="{{ $blog->blog_title }}" class="w-100">
        </div>
        <div class="d-flex">
            <div class="blog-content-text">
                {!! $blog->blog_desc !!}
            </div>

            <!-- most read part -->
            
        </div>
        <!-- read more blogs -->
        <!-- read more blogs -->
    </div>
</section>
<!-- download banner -->
@include('include.download_banner')
<!-- download banner -->

<!-- End Blog Banner Section -->
@endsection