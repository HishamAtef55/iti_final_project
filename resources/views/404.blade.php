@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">404</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">404</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="error section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="error-content">
                        <div class="error-message">
                            <h2>404</h2>
                            <h3>We're sorry, but we can't find the page you were looking for.</h3>
                            <p>It's probably some thing we've done wrong but now we know about it and we'll try to fix it.
                                In the meantime, try one of these options</p>
                        </div>
                        <form class="form-error-search">
                            <input type="search" name="search" class="form-control" placeholder="Search Here">
                            <button class="btn btn-common btn-search" type="button">Search Now</button>
                        </form>
                        <div class="description">
                            <span>Or Goto <a href="#">Homepage</a></span>
                        </div>
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
