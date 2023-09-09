@extends('layouts.adminlayout')
@section('title',"Blog | MedCab")
@section('description',"MedCab is India’s future of emergency medical transport. Need emergency/non - emergency
ambulance? Call MedCab at 18008-908-208.")
@section('keywords',"MedCab, MedCab Blog, MedCab Latest News")
@section('main')


<?php $base_url = "https://medcab.in/" ?>
<!-- Start Blog Banner Section -->
<!-- blogs -->
<div class="blogs-container padding">
    <section class="blog-one">
        <div class="first-image">
            <h3>Read Our Achievements</h3>
        </div>
        <div class="filter-blogs">
            <button class="btn border rounded-4 active">View All</button>
            <button class="btn border rounded-4">Healthcare</button>
            <button class="btn border rounded-4">Ambulances</button>
            <button class="btn border rounded-4">Technology</button>
            <button class="btn border rounded-4">Business</button>
            <button class="btn border rounded-4">Experience</button>
        </div>
        <div class="article-section d-flex">
            <div class="left d-flex flex-column gap-5">
                <div class="label w-100 border ">
                    <h3>Our Latest Articles</h3>
                </div>
                <div class="articles d-flex flex-column">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="article d-flex">
                            <div class="image">
                                <img src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="article" />
                            </div>
                            <div class="desc d-flex flex-column align-items-start justify-content-between">
                                <h4>{{$blogs[$i]->blog_title}}</h4>
                                <p>
                                    {{$blogs[$i]->blog_meta_desc}}
                                </p>
                                <p>{{$blogs[$i]->blog_post_date}}</p>
                                <a href="{{URL::route('Blog-Detail',['title'=>$blogs[$i]->blog_sku])}}" class="more">Read more...</a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="right d-flex flex-column justify-content-between">
                <div class="most-read">
                    <div class="label">
                        <p>Most Read</p>
                    </div>
                    <div class="news">
                        <?php for ($i = 4; $i < 9; $i++) { ?>
                            <div class="news-item d-flex gap-3 p">
                                <div class="dp">
                                    <img class="rounded-circle border border-dark mt-2" src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="dp" />
                                </div>
                                <div class="content">
                                    <p>
                                        {{$blogs[$i]->blog_title}}
                                    </p>
                                    <p>&rarr;</p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="news-letter shadow px-5 py-5">
                    <form class="d-flex flex-column gap-5">
                        <div class="mb-3 d-flex flex-column gap-5">
                            <h2 class="text-center primary-text fw-bold">Stay Updated</h2>
                            <label for="exampleInputEmail1" class="form-label text-center w-100 primary-text">Subscribe to Medcab newsletter</label>
                            <input type="email" class="form-control primary-text" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email id" />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 primary-text text-white">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="article-section article-section-more d-flex flex-column align-items-center justify-content-center">
            <div class="articles d-flex flex-row">
                <?php for ($i = count($blogs) - 1; 0 <= $i; $i--) { ?>
                    <div class="article d-flex">
                        <div class="image">
                            <img src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="article" />
                        </div>
                        <div class="desc d-flex flex-column align-items-start justify-content-evenly">
                            <h4>{{$blogs[$i]->blog_title}}</h4>
                            <p>
                                {{$blogs[$i]->blog_meta_desc}}
                            </p>
                            <p>Posted on {{$blogs[$i]->blog_post_date}}</p>
                            <a class="more">Read more...</a>
                        </div>
                    </div>
                <?php
                    if (count($blogs) - 3 == $i) {
                        break;
                    }
                }
                ?>
            </div>
            <div class="read-more-blog d-flex-center mt-5 d-done">
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
</div>
<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner -->

<!-- End Blog Banner Section -->
@endsection