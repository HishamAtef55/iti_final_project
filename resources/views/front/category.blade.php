@extends('layouts.front.master')


@section('content')
    <div id="hero-area">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="contents-ctg">
                        <div class="search-bar">
                            <div class="search-inner">
                                <form class="search-form" method="POST" action="{{ route('search_form') }}">
                                    @csrf
                                    <div class="form-group inputwithicon">
                                        <i class="lni-tag"></i>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Product Keyword">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group inputwithicon">
                                        <i class="lni-target"></i>
                                        <div class="select">
                                            <select name="city_id">
                                                <option disabled value="none">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group inputwithicon">
                                        <i class="lni-menu"></i>
                                        <div class="select">
                                            <select name="category_id">
                                                <option disabled value="none">Select Categories</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                @endforeach

                                            </select>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-common" type="submit"><i class="lni-search"></i> Search
                                        Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="main-container section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
                    <aside>

                        <div class="widget_search">
                            <form role="search" method="POST" action="{{ route('search_name') }}" id="search-form">
                                @csrf
                                <input type="search" class="form-control" autocomplete="off" name="name"
                                    placeholder="Search..." id="search-input" value="">
                                <button type="submit" id="search-submit" class="search-btn"><i
                                        class="lni-search"></i></button>
                            </form>
                        </div>

                        <div class="widget categories">
                            <h4 class="widget-title">All Categories</h4>
                            <ul class="categories-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('category-page', $category['id']) }}">
                                            <i class="lni-dinner"></i>
                                            {{ $category['name'] }}
                                            <!--<span class="category-counter">(5)</span>-->
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        {{-- <div class="widget">
                            <h4 class="widget-title">Advertisement</h4>
                            <div class="add-box">
                                <img class="img-fluid" src="{{ URL::asset('assets/front/img/img1.jpg') }}" alt="">
                            </div>
                        </div> --}}
                    </aside>
                </div>
                <div class="col-lg-9 col-md-12 col-xs-12 page-content">

                    <div class="product-filter">
                        <div class="short-name">
                            <span>Showing (1 - 12 products of 7371 products)</span>
                        </div>
                        {{-- <div class="Show-item">
                            <span>Show Items</span>
                            <form class="woocommerce-ordering" method="post">
                                <label>
                                    <select name="order" class="orderby">
                                        <option selected="selected" value="defulte">order</option>
                                        <option value="newness">newness</option>
                                        <option value="price">price</option>
                                    </select>
                                </label>
                            </form>
                        </div> --}}
                        {{-- @dd( route('category.order',['id'=>$id,'order'=>'newness']) ) --}}
                        <div class="Show-item">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort Option
                            </a>

                            @php
                                if ($id == null) {
                                    $id = 0;
                                }
                            @endphp
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item"
                                    href="{{ route('category.order', ['order' => 'newness', 'id' => $id]) }}">newness</a>
                                <a class="dropdown-item"
                                    href="{{ route('category.order', ['order' => 'oldness', 'id' => $id]) }}">oldness</a>
                                <a class="dropdown-item"
                                    href="{{ route('category.order', ['order' => 'price_low', 'id' => $id]) }}">price_low</a>
                                <a class="dropdown-item"
                                    href="{{ route('category.order', ['order' => 'price_high', 'id' => $id]) }}">price_high</a>


                            </div>

                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#grid-view"><i class="lni-grid"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#list-view"><i class="lni-list"></i></a>
                            </li>
                        </ul>
                    </div>


                    <div class="adds-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade">
                                <div class="row">
                                    @if ($ads)
                                        @foreach ($ads as $ad)
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="featured-box">
                                                    <figure>
                                                        <!--  <span class="price-save">
                                                                                                                                                                                                                    30% Save
                                                                                                                                                                                                                </span>-->
                                                        <div class="icon">
                                                            <span class="bg-green"><i class="lni-heart"></i></span>
                                                            <span><i class="lni-bookmark"></i></span>
                                                        </div>
                                                        <a href="#"><img class="img-fluid"
                                                                src="{{ URL::asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                                                alt=""></a>
                                                    </figure>
                                                    <div class="feature-content" style="width:100%">
                                                        <div class="product">
                                                            <a>{{ $ad['parent_name'] }} > </a>
                                                            <a href="#">{{ $ad['category']['name'] }}</a>
                                                        </div>
                                                        <h4><a
                                                                href="{{ route('adDetails', $ad['id']) }}">{{ $ad['name'] }}</a>
                                                        </h4>
                                                        <div class="meta-tag">
                                                            <span>
                                                                <a href="#"><i class="lni-user"></i>
                                                                    {{ $ad['user']['name'] }}</a>
                                                            </span>
                                                            <span>
                                                                <a href="#"><i class="lni-map-marker"></i>
                                                                    {{ $ad['city']['name'] }}</a>
                                                            </span>
                                                            <!--  <span>
                                                                                                                                                                                                                <a href="#"><i class="lni-tag"></i> Apple</a>
                                                                                                                                                                                                            </span>-->
                                                        </div>
                                                        <p class="dsc">{{ $ad['description'] }}</p>
                                                        <div class="listing-bottom">
                                                            <h3 class="price float-left">${{ $ad['price'] }}</h3>

                                                            <a href="{{ route('adDetails', $ad['id']) }}"
                                                                class="btn btn-common float-right nav-link">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p style="text-align: center;width:100%">No categories found
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane fade active show">
                                <div class="row">
                                    @if ($ads)
                                        @foreach ($ads as $ad)
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="featured-box">
                                                    <figure>
                                                        <!--   <span class="price-save">
                                                                                                                                                                                                                                                            10% Save
                                                                                                                                                                                                                                                        </span>-->
                                                        <div class="icon">
                                                            <span class="bg-green"><i class="lni-heart"></i></span>
                                                            <span><i class="lni-bookmark"></i></span>
                                                        </div>
                                                        <a href="#"><img class="img-fluid"
                                                                src="{{ URL::asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                                                alt=""></a>
                                                    </figure>
                                                    <div class="feature-content">
                                                        <div class="product">
                                                            <a href="#">{{ $ad['parent_name'] }} > </a>
                                                            <a href="#">{{ $ad['category']['name'] }}</a>
                                                        </div>
                                                        <h4><a
                                                                href="{{ route('adDetails', $ad['id']) }}">{{ $ad['name'] }}</a>
                                                        </h4>
                                                        <div class="meta-tag">
                                                            <span>
                                                                <a href="#"><i
                                                                        class="lni-user"></i>{{ $ad['user']['name'] }}
                                                                </a>
                                                            </span>
                                                            <span>
                                                                <a href="#"><i
                                                                        class="lni-map-marker"></i>{{ $ad['city']['name'] }}</a>
                                                            </span>
                                                            <!--  <span>
                                                                                                                                                                                                                                                                    <a href="#"><i class="lni-tag"></i> Apple</a>
                                                                                                                                                                                                                                                                </span>-->
                                                        </div>
                                                        <p class="dsc">{{ $ad['description'] }}</p>
                                                        <div class="listing-bottom">
                                                            <h3 class="price float-left">${{ $ad['price'] }}</h3>

                                                            <a href="{{ route('adDetails', $ad['id']) }}"
                                                                class="btn btn-common float-right">
                                                                View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p style="text-align: center;width:100%">No categories found
                                        </p>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="pagination-bar">
                        {{-- <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav> --}}
                        {{ $ads->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>




    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
@endsection
