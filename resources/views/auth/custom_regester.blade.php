@extends('layouts.front.master')
@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Join Us</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Register</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="register section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="register-form login-area">
                        <h3>
                            Register
                        </h3>
                        <form class="login-form" method="POST" action="{{ route('register') }}">
                            @csrf


                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="name" type="text"
                                        class="form-control  @error('name') is-invalid @enderror" placeholder="Username"
                                        name="name" required autocomplete="name" autofocus pattern="^[a-zA-Z ]{3,}$"
                                        title="name must be at least 3 charactaers">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- *************************** --}}
                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        name="email" required autocomplete="email"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="emaile must contain '@' ">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- ************************** --}}
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
                            </div>
                            {{-- *************************** --}}
                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="password-confirm" type="password" class="form-control"
                                        placeholder="Confirm password" name="password_confirmation" required
                                        autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="
                                        password must be 8 charachters & contain numbers,capital & small letters">


                                </div>
                            </div>
                            {{-- ********************** --}}
                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="datebirth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        placeholder="Date of birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                        required autocomplete="date_of_birth" autofocus>
                                    <i class="fas fa-calendar input-prefix" tabindex=0></i>


                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- ************************** --}}
                            <div class="form-group">
                                <div class="input-icon">
                                    <input id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                                        placeholder="Whatsapp" name="whatsapp" required pattern="01[0125][0-9]{8}"
                                        title="number should be 11 numbers and start with 010 or 011 or 012 or 015">

                                    @error('whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- ************************** --}} <div class="form-group">
                                <div class="form-group">
                                    <div class="input-icon">
                                        <input id="whatsapp" class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="phone" name="phone" required pattern="01[0125][0-9]{8}"
                                            title="number should be 11 numbers and start with 010 or 011 or 012 or 015">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ************************** --}} <div class="form-group">
                                    <div class="input-icon">
                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Address" name="address" required autocomplete="address"
                                            autofocus pattern="^[a-zA-Z ]{3,}$"
                                            title="address should be more than 3 characters">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- update --}}
                                {{-- <div class="col-md-4"> --}}
                                <div class="mb-1">
                                    <label for="exampleInputcity" class="form-label">country</label>
                                    <select class="form-control" id="country" name="country_id">
                                        <option value="">Select Country</option>
                                        @foreach ($country as $country)
                                            <option value="{{ $country->id }}" name="country_id">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </select>
                                </div>
                                {{-- </div> --}}

                                {{-- <div class="col-md-4"> --}}
                                <div class="mb-1">
                                    <label for="exampleInputcity" class="form-label">city</label>
                                    <select disabled class="form-control" id="city_id" name="city_id">

                                    </select>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </select>
                                </div>
                                {{-- </div> --}}



                                {{-- end update --}}
                                {{-- ************************** <div class="form-group">
                                    <div class="input-icon">
                                        <input id="city" type="text"
                                            class="form-control @error('city') is-invalid @enderror" placeholder="City"
                                            name="city" required autocomplete="city" autofocus
                                            pattern="^[a-zA-Z ]{3,}$" title="city should be more than 3 characters">

                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- ************************** <div class="form-group">
                                    <div class="input-icon">
                                        <input id="country" type="text"
                                            class="form-control @error('country') is-invalid @enderror"
                                            placeholder="Country" name="country" required autocomplete="country"
                                            autofocus pattern="^[a-zA-Z ]{3,}$"
                                            title="country should be more than 3 characters">

                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- ************************** --}}
                                {{-- <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkedall">
                                    <label class="custom-control-label" for="checkedall">By registering, you accept
                                        our Terms & Conditions</label>
                                </div>
                            </div> --}}
                                {{-- ******************** --}}
                                <div class="text-center">
                                    <button class="btn btn-common log-btn btn-success" type="submit">SUBMIT</button>
                                </div>
                        </form>

                        <h6
                            style="  width: 100%;text-align: center;border-bottom: 1px solid #e5e5e5;line-height: 0.1em;margin: 40px 0 40px;">
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
            name: /^[a-zA-Z ]{3,}$/,
            password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/,
            phone: /01[0125][0-9]{8}$/,
            whatsapp: /01[0125][0-9]{8}$/,
            email: /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/,
            // password-confirm: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/,
            address: /^[a-zA-Z ]{3,}$/,
            city: /^[a-zA-Z ]{3,}$/,
            country: /^[a-zA-Z ]{3,}$/,

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
            confirm_password = document.getElementById("password-confirm");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
                confirm_password.className = "form-control is-invalid";

            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $('document').ready(function() {
            $('#country').change(function() {
                let idcountry = this.value;

                $('#city_id').html('');

                $.ajax({
                    url: '/api/fetch/state',
                    type: "POST",
                    datatype: 'json',
                    data: {
                        country_id: idcountry,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#city_id').html('<option  value="">Select city</option>')
                        $.each(response.states, function(index, val) {
                            $('#city_id').prop('disabled', false).append(
                                '<option  value="' + val.id + '">' +
                                val.name +
                                '</option>')
                        });
                        $('#city-id').html('<option value="">Select City</option>');

                    }
                })
            });

        })
    </script>
@endsection
