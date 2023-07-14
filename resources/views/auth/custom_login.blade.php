@extends('layouts.front.master')
@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Login</h2>
                        <ol class="breadcrumb">
                            <li><a href="index-2.html">Home /</a></li>
                            <li class="current">Login</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="login section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="login-form login-area pb-3">
                        <h3>
                            Login Now
                        </h3>
                        <form role="form" class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- <div class="form-group">

                                <div class="form-group">
                                    <div class="input-icon">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                            name="email" required autocomplete="email"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                            title="emaile must contain '@' ">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        name="password" required autocomplete="new-password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="
                                        password must be 8 charachters & contain numbers,capital & small letters">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="emaile must contain '@' ">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="
                                        password must be 8 charachters & contain numbers,capital & small letters">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                {{-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkedall">
                                    <label class="custom-control-label" for="checkedall">Keep me logged in</label>
                                </div> --}}
                                <a class="forgetpassword" href="{{ route('forget.password.get') }}"
                                    style="float: none">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-common log-btn">Submit</button>
                            </div>
                        </form>
                        <h6
                            style="  width: 100%;text-align: center;border-bottom: 1px solid #e5e5e5;line-height: 0.1em;margin: 5px 0 40px;">
                            <span style="  background:#fff;
                            padding:0 10px; ">OR</span>
                        </h6>
                        <div class="mt-4 mb-4" style="text-align: center">
                            <a href="{{ route('google-auth') }}">
                                <img src="{{ URL::asset('assets/img/google.png') }}" style="width:200px">
                            </a>
                            <a href="{{ route('facebook.login') }}">
                                <img src="{{ URL::asset('assets/img/facebook.png') }}" style="width:200px">
                            </a>
                        </div>
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
@section('scripts')
    <script>
        console.log('ddd');
        const elementRegex = {
            name: /^[a-zA-Z]{3,}$/,
            password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/,
            phone: /01[0125][0-9]{8}$/,
            whatsapp: /01[0125][0-9]{8}$/,
            email: /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/,
            confirm_password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/,
            address: /^[a-zA-Z]{3,}$/,
            city: /^[a-zA-Z]{3,}$/,
            country: /^[a-zA-Z]{3,}$/,

            // datebirth: /^(0[1-9]|1[012])[-/.](0[1-9]|[12][0-9]|3[01])[-/.](19|20)\\d\\d$/,
        };

        window.onload = function() {

            const elements = document.querySelectorAll("input")
            // console.log(elements);
            elements.forEach(element => {
                element.oninput = (e) => {


                    if (e.target.value.match(elementRegex[element.id])) {
                        element.className = "form-control is-valid"
                    } else {
                        element.className = "form-control is-invalid"
                    }
                }
            })
        };

        ////////////////////////////////////////////

        var password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

    <script></script>
@endsection
