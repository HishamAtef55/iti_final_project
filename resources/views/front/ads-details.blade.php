@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Details</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section-padding">
        <div class="container">

            <div class="product-info row">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="ads-details-wrapper">
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            @foreach ($ad['image'] as $img)
                                <div class="item">
                                    <div class="product-img">
                                        <img class="img-fluid" src="{{ URL::asset('ads/image/' . $img['fileimage']) }}"
                                            alt="">
                                    </div>
                                    <span class="price">${{ $ad['price'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="ads-details-info">
                            <h2>{{ $ad['name'] }}</h2>
                            <div class="details-meta">
                                <span><a><i class="lni-alarm-clock"></i>{{ $ad['start_date'] }}</a></span>
                                <span><a><i class="lni-map-marker"></i>{{ $ad['city']['name'] }}</a></span>
                                <!-- <span><a href="#"><i class="lni-eye"></i> 299 View</a></span>-->
                            </div>
                            <p class="mb-4">{{ $ad['description'] }}</p>

                            @if ($ad['status'] == 'Sold')
                                <h3 class="btn btn-danger mt-2">{{ $ad['status'] }}</h3>
                            @endif

                            @if ($ad['attributes'])
                                <h4 class="title-small mb-3">More details:</h4>
                                <ul class="list-specification">
                                    @foreach ($ad['attributes'] as $attr)
                                        <li><i class="lni-check-mark-circle"></i><strong>{{ $attr['name'] }} : </strong>
                                            {{ $attr['pivot']['value'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="tag-bottom">
                            <div class="float-left">
                                <ul class="advertisement">
                                    <li>
                                        <p><strong><i class="lni-folder"></i> Categories:</strong> <a
                                                href="{{ route('category-page', $ad['category_id']) }}">

                                                {{ $ad['parent_name'] }}</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p><strong><i class="lni-archive"></i> Condition:</strong> New</p>
                                    </li>

                                </ul>
                            </div>
                            <!--  <div class="float-right">
                                            <div class="share">
                                                <div class="social-link">
                                                    <a class="facebook" data-toggle="tooltip" data-placement="top" title="facebook"
                                                        href="#"><i class="lni-facebook-filled"></i></a>
                                                    <a class="twitter" data-toggle="tooltip" data-placement="top" title="twitter"
                                                        href="#"><i class="lni-twitter-filled"></i></a>
                                                    <a class="linkedin" data-toggle="tooltip" data-placement="top" title="linkedin"
                                                        href="#"><i class="lni-linkedin-fill"></i></a>
                                                    <a class="google" data-toggle="tooltip" data-placement="top" title="google plus"
                                                        href="#"><i class="lni-google-plus"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">

                    <aside class="details-sidebar">
                        <div class="widget">
                            <div style="text-align: center; font-weight:bold;">
                                <span>Ad Posted By </span>
                                <span> &nbsp;&nbsp;{{ $ad['user']['name'] }}</span>
                            </div>

                            <div class="agent-inner" style="text-align: center;">
                                <div class="agent-title">
                                    {{-- <div class="agent-photo">
                                        <a href="#"><img
                                                src="{{ URL::asset('assets/front/img/productinfo/agent.jpg') }}"
                                                alt=""></a>

                                    </div> --}}
                                    <div>

                                        <a href="{{ route('users_posts', $ad['user']['id']) }}">


                                            {{-- @dd($ad['user']['id']) --}}

                                            <h3 class="btn btn-common fullwidth mt-4"> more about owner ads </h3>
                                        </a>

                                        @guest
                                            <span><i class="lni-phone-handset"></i>01* *** *** <br>login first to see seller
                                                number</span>

                                        @endguest

                                        @auth

                                            <div>
                                                <span><i class="lni-phone-handset"></i>{{ $ad['user']['phone'] }}</span>
                                            </div>
                                        @endauth

                                    </div>
                                </div>

                                <button class="btn btn-common fullwidth mt-4">
                                    <a href="{{ route('sendmessage', $ad['user']['id']) }}" style="color: white;">Send
                                        Message</a>
                                </button>
                            </div>
                        </div>

                        <div class="widget">
                            <h4 class="widget-title">Advertisment</h4>
                            <img width="300" src="{{ URL::asset('assets/img/brand/img0.jpg') }}" alt="">
                            <!-- <ul class="posts-list">
                                                                            <li>
                                                                                <div class="widget-thumb">
                                                                                    <a href="#"><img src="{{ URL::asset('assets/front/img/details/img1.jpg') }}"
                                                                                            alt="" /></a>
                                                                                </div>
                                                                                <div class="widget-content">
                                                                                    <h4><a href="#">Little Harbor Yacht 38</a></h4>
                                                                                    <div class="meta-tag">
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-user"></i> Smith</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-map-marker"></i> New Your</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-tag"></i> Radio</a>
                                                                                        </span>
                                                                                    </div>
                                                                                    <h4 class="price">$480.00</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="widget-thumb">
                                                                                    <a href="#"><img
                                                                                            src="{{ URL::asset('assets/front/img/details/img2.jpg') }}"
                                                                                            alt="" /></a>
                                                                                </div>
                                                                                <div class="widget-content">
                                                                                    <h4><a href="#">Little Harbor Yacht 38</a></h4>
                                                                                    <div class="meta-tag">
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-user"></i> Smith</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-map-marker"></i> New Your</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-tag"></i> Radio</a>
                                                                                        </span>
                                                                                    </div>
                                                                                    <h4 class="price">$480.00</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="widget-thumb">
                                                                                    <a href="#"><img
                                                                                            src="{{ URL::asset('assets/front/img/details/img3.jpg') }}"
                                                                                            alt="" /></a>
                                                                                </div>
                                                                                <div class="widget-content">
                                                                                    <h4><a href="#">Little Harbor Yacht 38</a></h4>
                                                                                    <div class="meta-tag">
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-user"></i> Smith</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-map-marker"></i> New Your</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-tag"></i> Radio</a>
                                                                                        </span>
                                                                                    </div>
                                                                                    <h4 class="price">$480.00</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="widget-thumb">
                                                                                    <a href="#"><img
                                                                                            src="{{ URL::asset('assets/front/img/details/img4.jpg') }}"
                                                                                            alt="" /></a>
                                                                                </div>
                                                                                <div class="widget-content">
                                                                                    <h4><a href="#">Little Harbor Yacht 38</a></h4>
                                                                                    <div class="meta-tag">
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-user"></i> Smith</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-map-marker"></i> New Your</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-tag"></i> Radio</a>
                                                                                        </span>
                                                                                    </div>
                                                                                    <h4 class="price">$480.00</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="widget-thumb">
                                                                                    <a href="#"><img
                                                                                            src="{{ URL::asset('assets/front/img/details/img5.jpg') }}"
                                                                                            alt="" /></a>
                                                                                </div>
                                                                                <div class="widget-content">
                                                                                    <h4><a href="#">Little Harbor Yacht 38</a></h4>
                                                                                    <div class="meta-tag">
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-user"></i> Smith</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-map-marker"></i> New Your</a>
                                                                                        </span>
                                                                                        <span>
                                                                                            <a href="#"><i class="lni-tag"></i> Radio</a>
                                                                                        </span>
                                                                                    </div>
                                                                                    <h4 class="price">$480.00</h4>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </li>
                                                                        </ul>-->
                        </div>
                    </aside>

                </div>
            </div>

        </div>
    </div>


    <!--  <section class="subscribes section-padding">
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
