@extends('layouts.front.master')


@section('content')
    <div id="hero-area">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9 col-xs-12 text-center pt-5">
                    <div class="contents">
                        <h1 class="head-title">Welcome to The Largest <span class="year">Marketplace</span></h1>
                        <p>Buy and sell everything from used cars to mobile phones and computers, or search for
                            property, jobs and more</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section id="categories">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-xs-12">

                    @if ($categories)
                        <div id="categories-icon-slider" class="categories-wrapper owl-carousel owl-theme">
                            @foreach ($categories as $category)
                                <div class="item">
                                    <a href="{{ route('category-page', $category['id']) }}">
                                        <div class="category-icon-item">
                                            <div class="icon-box">
                                                <div class="icon">
                                                    <h4>{{ $category->name }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="text-align: center;width:100%">No categories found</p>
                    @endif

                    <div id="categories-icon-slider" class="categories-wrapper owl-carousel owl-theme">
                        @foreach ($categories as $category)
                            <div class="item">
                                <a href="{{ route('category-page', $category['id']) }}">
                                    <div class="category-icon-item">
                                        <div class="icon-box">
                                            <div class="icon">

                                                <h4>{{ $category->name }}</h4>

                                                @if ($categories)
                                                    <div id="categories-icon-slider"
                                                        class="categories-wrapper owl-carousel owl-theme">
                                                        @foreach ($categories as $category)
                                                            <div class="item">
                                                                <a href="{{ route('category-page', $category['id']) }}">
                                                                    <div class="category-icon-item">
                                                                        <div class="icon-box">
                                                                            <div class="icon">

                                                                                <h4>{{ $category->name }}</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p style="text-align: center;width:100%">No categories found</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>



    @if (\Session::has('success'))
        <div id="alert" class="w-25 float-right alert alert-success" role="alert">
            {!! \Session::get('success') !!}
        </div>
    @endif
    @if (\Session::has('exsists'))
        <div id="alert" class="w-25 float-right alert alert-warning" role="alert">
            {!! \Session::get('exsists') !!}
        </div>
    @endif
    <section class="featured section-padding">
        <div class="container">
            <h1 class="section-title">Latest Ads</h1>

            <div class="row">
                {{-- @if ($ads[0]['status'] == 'pending') --}}
                @if ($ads)
                    @foreach ($ads as $ad)
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                            <div class="featured-box">
                                <figure>
                                    <div class="icon">
                                        <a href="{{ route('wishlist.store', ['ad' => $ad['id']]) }}"><span
                                                class="bg-green"><i class="lni-heart"></i></span></a>

                                    </div>
                                    <a href="#"><img class="img-fluid"
                                            style="    max-height: 200px;
                                        object-fit: contain;"
                                            src="{{ URL::asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                            alt=""></a>
                                </figure>
                                <div class="feature-content" style="width:100%">
                                    <div class="product">
                                        <a href="#">{{ $ad['parent_name'] }} > </a>
                                        <a href="#">{{ $ad['category']['name'] }}</a>
                                    </div>
                                    <h4><a href="{{ route('adDetails', $ad['id']) }}">{{ $ad['name'] }}</a></h4>
                                    <div class="meta-tag">
                                        <span><a><i class="lni-alarm-clock"></i>{{ $ad['start_date'] }}</a></span>

                                        <span>
                                            <a><i class="lni-user"></i> {{ $ad['user']['name'] }}</a>
                                        </span>
                                        <span>
                                            {{-- <a><i class="lni-map-marker"></i> {{ $ad['city']['name'] }}</a> --}}
                                        </span>


                                    </div>
                                    <p class="dsc">{{ $ad['description'] }}</p>
                                    <div class="listing-bottom">
                                        <h3 class="price float-left">${{ $ad['price'] }}</h3>
                                        <a href="{{ route('adDetails', $ad['id']) }}"
                                            class="btn btn-common float-right">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="text-align: center;width:100%">No Approved ads found</p>
                @endif
            </div>
        </div>
    </section>


    <section class="works section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title">How It Works?</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="works-item">
                        <div class="icon-box">
                            <i class="lni-users"></i>
                        </div>
                        <p>Create an Account</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="works-item">
                        <div class="icon-box">
                            <i class="lni-bookmark-alt"></i>
                        </div>
                        <p>Post Free Ad</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="works-item">
                        <div class="icon-box">
                            <i class="lni-thumbs-up"></i>
                        </div>
                        <p>Deal Done</p>
                    </div>
                </div>
                <hr class="works-line">
            </div>
        </div>
    </section>


    <section class="services bg-light section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title">Key Features</h3>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.2s">
                        <div class="icon">
                            <i class="lni-leaf"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>Elegant Design</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.4s">
                        <div class="icon">
                            <i class="lni-display"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>Responsive Design</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
                        <div class="icon">
                            <i class="lni-color-pallet"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>Clean UI</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="0.8s">
                        <div class="icon">
                            <i class="lni-emoji-smile"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>UX Friendly</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="1s">
                        <div class="icon">
                            <i class="lni-pencil-alt"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>Easily Customizable</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xs-12">
                    <div class="services-item wow fadeInRight" data-wow-delay="1.2s">
                        <div class="icon">
                            <i class="lni-headphone-alt"></i>
                        </div>
                        <div class="services-content">
                            <h3><a>Security Support</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="pricing-table" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Browse our Category</h2>
                </div>
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="table">
                            <div class="icon">
                                <i class="lni-gift"></i>
                            </div>
                            <div class="pricing-header">
                                <p class="price-value">{{ $package['price'] }}</p>
                            </div>
                            <div class="title">
                                <h3>{{ $package['name'] }}</h3>
                            </div>

                            <ul class="description">
                                <li>Category : {{ $package['categories'][0]['name'] }}</li>
                                <li>Free ad posting up to {{ $package['num_of_ads'] }} ads</li>
                                <li>ad will remain available for a period of {{ $package['days'] }} days</li>
                                <li>this package is valid for {{ $package['validity_days'] }}days</li>
                                </li>
                            </ul>

                        </div>
                    </div>
                @endforeach


            </div>
            <button class="btn btn-common"><a style="color:#fff" href="{{ route('userCategory.create') }}">Browse
                    Packages</a></button>

        </div>
    </section>



    <!-- <section id="blog" class="section-padding">

                                                                                                <div class="container">
                                                                                                    <h2 class="section-title">
                                                                                                        Blog Post
                                                                                                    </h2>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-4 col-md-6 col-xs-12 blog-item">

                                                                                                            <div class="blog-item-wrapper">
                                                                                                                <div class="blog-item-img">
                                                                                                                    <a href="single-post.html">
                                                                                                                        <img src="assets/img/blog/img-1.jpg" alt="">
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                                <div class="blog-item-text">
                                                                                                                    <div class="meta-tags">
                                                                                                                        <span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By
                                                                                                                                Admin</a></span>
                                                                                                                        <span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
                                                                                                                    </div>
                                                                                                                    <h3>
                                                                                                                        <a href="single-post.html">Recently Launching Our Iphone X</a>
                                                                                                                    </h3>
                                                                                                                    <p>
                                                                                                                        Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt
                                                                                                                        reiciendis, molestias omnis soluta.
                                                                                                                    </p>
                                                                                                                    <a href="single-post.html" class="btn btn-common">Read More</a>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-6 col-xs-12 blog-item">

                                                                                                            <div class="blog-item-wrapper">
                                                                                                                <div class="blog-item-img">
                                                                                                                    <a href="single-post.html">
                                                                                                                        <img src="assets/img/blog/img-2.jpg" alt="">
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                                <div class="blog-item-text">
                                                                                                                    <div class="meta-tags">
                                                                                                                        <span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By
                                                                                                                                Admin</a></span>
                                                                                                                        <span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
                                                                                                                    </div>
                                                                                                                    <h3>
                                                                                                                        <a href="single-post.html">How to get more ad views</a>
                                                                                                                    </h3>
                                                                                                                    <p>
                                                                                                                        Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt
                                                                                                                        reiciendis, molestias omnis soluta.
                                                                                                                    </p>
                                                                                                                    <a href="single-post.html" class="btn btn-common">Read More</a>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                        <div class="col-lg-4 col-md-6 col-xs-12 blog-item">

                                                                                                            <div class="blog-item-wrapper">
                                                                                                                <div class="blog-item-img">
                                                                                                                    <a href="single-post.html">
                                                                                                                        <img src="assets/img/blog/img-3.jpg" alt="">
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                                <div class="blog-item-text">
                                                                                                                    <div class="meta-tags">
                                                                                                                        <span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By
                                                                                                                                Admin</a></span>
                                                                                                                        <span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
                                                                                                                    </div>
                                                                                                                    <h3>
                                                                                                                        <a href="single-post.html">Writing a better product description</a>
                                                                                                                    </h3>
                                                                                                                    <p>
                                                                                                                        Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt
                                                                                                                        reiciendis, molestias omnis soluta.
                                                                                                                    </p>
                                                                                                                    <a href="single-post.html" class="btn btn-common">Read More</a>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </section>-->


    <!--<section class="subscribes section-padding">
                                                                                            <div class="container">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                                        <div class="subscribes-inner">
                                                                                                            <div class="icon">
                                                                                                                <i class="lni-pointer"></i>
                                                                                                            </div>
                                                                                                            <div class="sub-text">
                                                                                                                <h3>Subscribe to Newsletter</h3>
                                                                                                                <p>and receive new ads in inbox</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                                        <form>
                                                                                                            <div class="subscribe">
                                                                                                                <input class="form-control" name="EMAIL" placeholder="Enter your Email" required=""
                                                                                                                    type="email">
                                                                                                                <button class="btn btn-common" type="submit">Subscribe</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </section>-->





    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
@endsection
@section('scripts')
    <script>
        var alrt = document.getElementById('alert');
        setTimeout(() => {
            console.log(alrt);
            alrt.style.display = 'none'
        }, 2000);
    </script>
@endsection
