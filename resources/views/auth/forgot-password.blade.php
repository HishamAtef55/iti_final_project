@extends('layouts.front.master')
@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Forgot Password</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Forgot Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="forgot login-area">
                        <h3>
                            Forgot Password
                        </h3>

                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form action="{{ route('forget.password.post') }}" method="post" class="login-form">
                            @csrf

                            <div class="form-group">
                                <div class="input-icon">
                                    <input type="text" id="email" name="email" placeholder="Email"
                                        class="form-control @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-common log-btn"> Send Password Reset Link
                                </button>
                            </div>
                            <div class="form-group mt-4">
                                <ul class="form-links">
                                    <li class="float-left"><a href="{{ route('register') }}">Don't have an account?</a></li>
                                    <li class="float-right"><a href="{{ route('login') }}">Back to Login</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
@endsection
