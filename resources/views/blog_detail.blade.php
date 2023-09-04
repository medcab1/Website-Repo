@extends('layouts.adminlayout')
@section('title', $blog->blog_meta_title)
@section('description', $blog->blog_meta_desc)
@section('keywords', $blog->blog_meta_keyword)
@section('main')
<!-- Start Blog Banner Section -->
<section class="blog-section">
    <div class="container">
        
        <h1 class="title-text text-center">{{ $blog->blog_title }}</h1>
        <div class="bg-light blog-detail-img">
            <img src="{{ asset($blog->blog_thumbnail) }}" alt="{{ $blog->blog_title }}" class="h-100 w-100">
        </div>
        <div class="blog-content-text">
            {!! $blog->blog_desc !!}
        </div>
     
        <div class="more-blog-list">
            <div class="row d-flex-center align-items-start gy-3">

            @foreach ($blogs as $otherBlog)
                <div class="col-lg-4">
                    <div class="more-blog-item">
                        <img src="{{ asset($otherBlog->blog_thumbnail) }}" alt="{{ $otherBlog->blog_title }}" class="w-100" style="height: 160px;">
                        <div class="more-blog-text">
                            <h4 class="sub-heading text-break">{{ $otherBlog->blog_title }}</h4>
                            <p class="p-text text-wrap h-100">
                                {!! $otherBlog->blog_meta_desc !!}
                                <a href="{{ route('Blog-Detail', ['title' => $otherBlog->blog_sku]) }}" class="read-more text-color-red">Read More..</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </div>

        <div class="read-more-blog w-100 d-flex-center mt-5 d-done">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        {{ $blogs->links('pagination::bootstrap-4') }}
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
<!-- download banner -->
@include('include.download_banner')
<!-- download banner --> 

<!-- End Blog Banner Section -->
@endsection
