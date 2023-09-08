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
        <div class="filter-blogs d-flex justify-content-center">
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
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <div class="article d-flex">
                            <div class="image">
                                <img src="{{$base_url.$blogs[$i]->blog_thumbnail}}" alt="article" />
                            </div>
                            <div class="desc d-flex flex-column align-items-start justify-content-evenly">
                                <h4>{{$blogs[$i]->blog_title}}</h4>
                                <p>
                                    {{$blogs[$i]->blog_meta_desc}}
                                </p>
                                <p>{{$blogs[$i]->blog_post_date}}</p>
                                <a class="more">Read more...</a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="right d-flex flex-column">
                <div class="most-read">
                    <div class="label">
                        <p>Most Read</p>
                    </div>
                    <div class="news">
                        <div class="news-item d-flex gap-3 p">
                            <div class="dp">
                                <img src="{{asset('assets/website-images/dp-blog.png')}}" alt="dp" />
                            </div>
                            <div class="content">
                                <p>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                    Esse, adipisci?
                                </p>
                                <p>&rarr;</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-letter shadow px-5 py-5">
                    <form class="d-flex flex-column gap-5">
                        <div class="mb-3 d-flex flex-column gap-5">
                            <h2 class="text-center primary-text fw-bold">Stay Updated</h2>
                            <label for="exampleInputEmail1" class="form-label text-center w-100 secondary-text">Subscribe to Medcab newsletter</label>
                            <input type="email" class="form-control secondary-text" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email id" />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 secondary-text text-white">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="article-section article-section-more d-flex">
            <div class="articles d-flex flex-row">
                <div class="article d-flex">
                    <div class="image">
                        <img src="{{asset('assets/website-images/article.png')}}" alt="article" />
                    </div>
                    <div class="desc d-flex flex-column align-items-start justify-content-evenly">
                        <h4>Lorem ipsum dolor sit amet consectetur adipisicing.</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptatibus, voluptates repudiandae explicabo architecto quo
                            quos ullam illum. Aut praesentium aliquid accusamus
                            architecto, libero nulla cum ipsam.
                        </p>
                        <p>Posted on 14 February, 2022</p>
                        <a class="more">Read more...</a>
                    </div>
                </div>
                <div class="article d-flex">
                    <div class="image">
                        <img src="{{asset('assets/website-images/article.png')}}" alt="article" />
                    </div>
                    <div class="desc d-flex flex-column align-items-start justify-content-evenly">
                        <h4>Lorem ipsum dolor sit amet consectetur adipisicing.</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptatibus, voluptates repudiandae explicabo architecto quo
                            quos ullam illum. Aut praesentium aliquid accusamus
                            architecto, libero nulla cum ipsam.
                        </p>
                        <p>Posted on 14 February, 2022</p>
                        <a class="more">Read more...</a>
                    </div>
                </div>
                <div class="article d-flex">
                    <div class="image">
                        <img src="{{asset('assets/website-images/article.png')}}" alt="article" />
                    </div>
                    <div class="desc d-flex flex-column align-items-start justify-content-evenly">
                        <h4>Lorem ipsum dolor sit amet consectetur adipisicing.</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptatibus, voluptates repudiandae explicabo architecto quo
                            quos ullam illum. Aut praesentium aliquid accusamus
                            architecto, libero nulla cum ipsam.
                        </p>
                        <p>Posted on 14 February, 2022</p>
                        <a class="more">Read more...</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- dowmload banner -->
@include('include.download_banner')
<!-- dowmload banner -->

<!-- End Blog Banner Section -->
@endsection