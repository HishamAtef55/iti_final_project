@extends('layouts.front.master')







@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">User Ads</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">User Ads</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-4 col-xs-4 page-sidebar  pl-12 pt-5">
        <aside>

            @if ($userads)
                <div>

                    {{-- <h3 class="section-title">{{ $user->name }} Ads</h3> --}}
                    {{-- <h5 style="color: black"> {{ $user->name }} Ads</h5> --}}
                    {{-- <div class="add-box">
                        <img class="img-fluid" src="{{ URL::asset('assets/front/img/img1.jpg') }}" alt="">
                    </div> --}}
                </div>
            @endif

        </aside>
    </div>
    <div class="container">
        <div class="row">



            {{-- <div class="details-box"> --}}
            {{-- <div class="feature-content w-50"> --}}
            @foreach ($userads as $ad)
                <div class="col-xs-7 col-sm-9 col-md-9 col-lg-4 ">
                    <div class="featured-box  ">
                        <figure>

                            <!--  <span class="price-save">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    30% Save
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </span>-->
                            <div class="icon">
                                {{-- <span class="bg-green"><i class="lni-heart"></i></span>
                    <span><i class="lni-bookmark"></i></span> --}}
                            </div>

                        </figure>
                        <div class="feature-content" style="width:100%">

                            <img src="{{ asset('ads/image/' . $ad['image'][0]['fileimage']) }}" class="d-block w-100"
                                alt="...">
                            <h4> {{ $ad->name }}
                            </h4>
                            <div class="meta-tag">

                                <span>
                                    <i class="lni-user"></i>
                                    {{ $ad->user->name }}
                                </span>
                                <span>
                                    <i class="lni-map-marker"></i>
                                    {{ $ad->location }}
                                </span>
                                <!--  <span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="#"><i class="lni-tag"></i> Apple</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </span>-->
                            </div>
                            <p class="dsc">{{ $ad->description }}</p>
                            <div class="listing-bottom">
                                <h3 class="price float-left">${{ $ad->price }}</h3>

                                <a href="{{ route('adDetails', $ad['id']) }}" class="btn btn-common float-right">
                                    View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="fixed-bottom">{{ $userads->links() }}</div> --}}

        </div>

    </div>




    {{-- <div class="details-box"> --}}
    {{-- <div class="feature-content w-50"> --}}


    <!--<section class="featured section-padding">
                        <div class="container">

                            <div class="row">test
                                {{-- @if ($ads[0]['status'] == 'pending') --}}
                                @if ($userads)
    @foreach ($userads as $ad)
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                                            <div class="featured-box">
                                                <figure>
                                                    <div class="icon">
                                                        <a href="{{ route('wishlist.store', ['ad' => $ad->id]) }}"><span class="bg-green"><i
                                                                    class="lni-heart"></i></span></a>
                                                        <span><i class="lni-bookmark"></i></span>
                                                    </div>
                                                    <a href="#"><img class="img-fluid"
                                                            style="    max-height: 200px;
                                            object-fit: contain;"
                                                            src="{{ URL::asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                                            alt=""></a>
                                                </figure>
                                                <div class="feature-content" style="width:100%">
                                                    <div class="product">
                                                        <a href="#">{{ $ad->parent_name }} > </a>
                                                        <a href="#">{{ $ad->category->name }}</a>
                                                    </div>
                                                    <h4><a href="{{ route('adDetails', $ad->id) }}">{{ $ad->name }}</a></h4>
                                                    <div class="meta-tag">
                                                        <span><a><i class="lni-alarm-clock"></i>{{ $ad->start_date }}</a></span>

                                                        <span>
                                                            <a><i class="lni-user"></i> {{ $ad->user->name }}</a>
                                                        </span>
                                                        <span>
                                                            {{-- <a><i class="lni-map-marker"></i> {{ $ad['city']['name'] }}</a> --}}
                                                        </span>


                                                    </div>
                                                    <p class="dsc">{{ $ad->description }}</p>
                                                    <div class="listing-bottom">
                                                        <h3 class="price float-left">${{ $ad->price }}</h3>
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
                    </section>-->


@endsection
