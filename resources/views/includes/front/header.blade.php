<header id="header-wrap">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-xs-12">

                    <ul class="list-inline">
                        <li><i class="lni-phone"></i> +0123 456 789</li>
                        <li><i class="lni-envelope"></i> <a href="http://preview.uideck.com/cdn-cgi/l/email-protection"
                                class="__cf_email__"
                                data-cfemail="5e2d2b2e2e312c2a1e39333f3732703d3133">[email&#160;protected]</a></li>
                    </ul>

                </div>
                <div class="col-lg-5 col-md-7 col-xs-12">
                    <div class="roof-social float-right">
                        <a class="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                        <a class="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                        <a class="instagram" href="#"><i class="lni-instagram-filled"></i></a>
                        <a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a>
                        <a class="google" href="#"><i class="lni-google-plus"></i></a>

                    </div>
                    <div class="header-top-right float-right">


                    </div>


                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-white fixed-top mt-0 pt-0 scrolling-navbar ">
        <div class="container">
            <a href="{{ route('home') }}" style="width: 80px;height: 80px;" class="navbar-brand mt-0 pt-0"><img
                    class="pt-0 d-lg-none" style="width: 70px;height: 70px;"
                    src="{{ URL::asset('assets/img/logo.png') }}" alt=""></a>

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
                    aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="lni-menu"></span>
                    <span class="lni-menu"></span>
                    <span class="lni-menu"></span>
                </button>
                <a href="{{ route('home') }}" class="navbar-brand "><img style="width: 100px;height: 100px;"
                        class="d-none d-lg-block " src="{{ URL::asset('assets/img/logo.png') }}" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav mr-auto w-100 justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('home') }}" aria-haspopup="true"
                            aria-expanded="false">
                            Home
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category-page') }}">
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userCategory.create') }}">
                            Packages
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wishlist.show') }}">
                            <span> Favourites</span>
                        </a>
                    </li>



                </ul>

                <div class="custom-ull">
                    <div class="post-btn">
                        <a class="btn btn-common" href="{{ route('ads.create') }}"><i class="lni-pencil-alt"></i> Post
                            an
                            Ad</a>
                    </div>
                    <ul>
                        @guest
                            @if (Route::has('login'))
                                <li class=" row nav-item">
                                    <a class="col-sm text-white nav-link btn btn-common ml-3 w-75"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                    <ul>
                        @guest
                            @if (Route::has('register'))
                                <li class=" nav-item">
                                    <a class=" text-white nav-link btn btn-common m-3 w-75"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest

                    </ul>


                    <ul class="">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="text-white nav-link dropdown-toggle btn btn-common "
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class=" dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a href="{{ route('profile', Auth::user()) }}" class="dropdown-item">Profile
                                        Details</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </div>

        <ul class="mobile-menu">
            <li>
                <a class="active" href="{{ route('home') }}">
                    Home
                </a>

            </li>
            <li>
                <a href="category">Categories</a>
            </li>
            <li>
                <a href="#">
                    Listings
                </a>
                <ul class="dropdown">
                    <li><a href="adlistinggrid">Ad Grid</a></li>
                    <li><a href="adlistinglist">Ad Listing</a></li>
                    <li><a href="ads-details">Listing Detail</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Pages</a>
                <ul class="dropdown">
                    <li><a href="about">About Us</a></li>
                    <li><a href="services">Services</a></li>
                    <li><a href="ads-details">Ads Details</a></li>
                    <li><a href="post-ads">Ads Post</a></li>
                    <li><a href="pricing">Packages</a></li>
                    <li><a href="testimonial">Testimonial</a></li>
                    <li><a href="faq">FAQ</a></li>
                    <li><a href="404">404</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Blog</a>
                <ul class="dropdown">
                    <li><a href="blog">Blog - Right Sidebar</a></li>
                    <li><a href="blog-left-sidebar">Blog - Left Sidebar</a></li>
                    <li><a href="blog-grid-full-width"> Blog full width </a></li>
                    <li><a href="single-post">Blog Details</a></li>
                </ul>
            </li>


            {{-- *********************** --}}
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="text-white nav-link btn btn-common m-2"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="text-white nav-link btn btn-common m-2"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown ">
                    {{-- <a id="navbarDropdown" class="text-white nav-link dropdown-toggle " href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a> --}}

                    <div class=" dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a></li>
                <li><a href="{{ route('profile', Auth::user()) }}" class="dropdown-item">Profile Details</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>
                </li>
            @endguest
            <li>
                <div class="post-btn">
                    <a class="btn btn-primary" href="{{ route('ads.create') }}" style="color: whitesmoke"><i
                            class="lni-pencil-alt"></i> Post
                        an
                        Ad</a>
                </div>
            </li>
        </ul>

    </nav>
</header>
