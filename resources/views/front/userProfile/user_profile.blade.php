@extends('layouts.front.master')
@section('content')
    <div id="content" class="section-padding">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar pt-5">
                    <aside>
                        <div class="sidebar-box">
                            <div class="user">
                                {{-- <figure>
                                    <a href="#"><img src="assets/img/author/img1.jpg" alt=""></a>
                                </figure> --}}
                                <div class="usercontent">
                                    <h3>Hello {{ auth()->user()->name }}</h3>
                                </div>
                            </div>
                            <nav class="navdashboard">
                                <ul>

                                    <li>

                                        <a class="active" href="{{ route('profile', Auth::user()) }}">
                                            <i class="lni-cog"></i>
                                            <span>Profile Settings</span>
                                        </a>

                                    </li>
                                    <li>
                                        {{-- <form action="{{ route('po', Auth::user()) }}" method="GET">
                                            @csrf
                                            <button>
                                                ads
                                            </button>
                                        </form> --}}
                                        <a href="{{ route('po', Auth::user()) }}">
                                            <i class="lni-layers"></i>
                                            <span>My Ads</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('userCategory.create') }}">
                                            <i class="lni-wallet"></i>
                                            <span>Buy Package</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('MyOrders')}}">
                                            <i class="lni-wallet"></i>
                                            <span>My Orders</span>
                                        </a>
                                    </li>                                        
                                    <li>
                                        <a href="{{ url('/chatify') }}">
                                            <i class="lni-wallet"></i>
                                            <span>message</span>
                                        </a>
                                    </li>
                                    <li>
                                        {{-- <form action="{{ route('po', Auth::user()) }}" method="POST">
                                            @csrf

                                            <button>
                                                ads
                                            </button>
                                        </form> --}}
                                        {{-- <a href="{{ route('user.myPackages') }}">
                                            <i class="lni-wallet"></i>
                                            <span>My Packages</span>
                                        </a> --}}
                                    </li>
                                    <li>
                                        <a href="{{ route('wishlist.show') }}">
                                            <i class="lni-heart"></i>
                                            <span>My Favourites</span>
                                        </a>
                                    </li>

                                    {{-- <li>
                                        <a href="#">
                                            <i class="lni-enter"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </nav>
                        </div>
                        {{-- <div class="widget">
                            <h4 class="widget-title">Advertisement</h4>
                            <div class="add-box">
                                <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                            </div>
                        </div> --}}
                    </aside>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9 pt-5">
                    <div class="col page-content">




                        <form action="{{ route('profileUpdate', Auth::user()) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                                <div class="inner-box ">
                                    <div class="tg-contactdetail">
                                        <div class="dashboard-box">
                                            <h2 class="dashbord-title">Contact Details</h2>
                                        </div>
                                        <div class="dashboard-wrapper">



                                            <div class="form-group mb-3">
                                                @auth
                                                    {{-- <label class="control-label">Name</label> --}}
                                                    <input class="form-control input-md" name="name" type="text"
                                                        value="{{ auth()->user()->name }}">


                                                </div>
                                                <div class="form-group mb-3">
                                                    {{-- <label class="control-label">Email</label> --}}
                                                    <input class="form-control input-md" name="email" type="text"
                                                        value="{{ auth()->user()->email }}" readonly>
                                                </div>
                                                {{-- ************************** --}}
                                                @if (auth()->user()->google_id == null && auth()->user()->facebook_id == null)
                                                    <div class="form-group">
                                                        <div class="input-icon">
                                                            {{-- <label class="control-label">Password</label> --}}

                                                            <input id="password" type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                placeholder="Password" name="password" required
                                                                autocomplete="new-password"
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
                                                            {{-- <label class="control-label">Confirm Password</label> --}}

                                                            <input id="password-confirm" type="password" class="form-control"
                                                                name="password_confirmation" required
                                                                autocomplete="new-password"
                                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                                title="
                                        password must be 8 charachters & contain numbers,capital & small letters">


                                                        </div>
                                                    </div>
                                                @endif


                                                {{-- ********************** --}}
                                                <div class="form-group mb-3">
                                                    {{-- <label class="control-label">Birth Date</label> --}}
                                                    <input class="form-control input-md" name="date_of_birth " type="date"
                                                        value="{{ auth()->user()->date_of_birth }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    {{-- <label class="control-label">Whatsaap</label> --}}
                                                    <input class="form-control input-md" name="whatsapp" type="text"
                                                        value="{{ auth()->user()->whatsapp }}">
                                                </div>
                                                <div class="form-group mb-3 tg-inputwithicon">
                                                    {{-- <label class="control-label">Phone</label> --}}
                                                    <input class="form-control input-md" name="phone" type="text"
                                                        value="{{ auth()->user()->phone }}">


                                                </div>
                                                <div class="form-group mb-3 tg-inputwithicon">
                                                    {{-- <label class="control-label">Address</label> --}}
                                                    <input class="form-control input-md" name="address" type="text"
                                                        value="{{ auth()->user()->address }}">

                                                </div>

                                                {{-- ////////////////////////////////////////////////// --}}



                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="exampleInputcity" class="form-label">curent
                                                                country</label>
                                                            <input readonly class="form-control"
                                                                value="{{ auth()->user()->country ? auth()->user()->country->name : '' }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="exampleInputcity" class="form-label">curent
                                                                city</label>
                                                            <input readonly class="form-control"
                                                                value="{{ auth()->user()->city ? auth()->user()->city->name : '' }}">
                                                        </div>


                                                    @endauth

                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-1">
                                                        <label for="exampleInputcity" class="form-label">chose new
                                                            country</label>
                                                        <select required class="form-control" id="country"
                                                            name="country_id">
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
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-1">
                                                        <label for="exampleInputcity" class="form-label"> chose new
                                                            city</label>
                                                        <select required disabled class="form-control" id="city_id"
                                                            name="city_id">

                                                        </select>
                                                        @error('city')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- /////////////////////////////////////////////////////////// --}}

                                            {{-- <div class="mb-1">
                                                    <label for="exampleInputcity" class="form-label">country</label>
                                                    <select class="form-control" id="country" name="country_id">

                                                        <option value="{{ auth()->user()->country->id }}">
                                                            {{ auth()->user()->country->name }}
                                                        </option>

                                                        @foreach ($country as $country)
                                                            <option value=" "name="country_id">
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('country')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    </select>
                                                </div> --}}
                                            {{-- </div> --}}

                                            {{-- <div class="col-md-4"> --}}

                                            {{-- <div class="mb-1">
                                                    <label for="exampleInputcity" class="form-label">city</label>

                                                    <select required class="form-control" required id="city_id"
                                                        name="city_id">

                                                        <option value="{{ auth()->user()->country->id }}">
                                                            {{ auth()->user()->city->name }}
                                                        </option>

                                                    </select>
                                                    @error('city')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    </select>
                                                </div> --}}
                                            {{-- <div class="form-group mb-3 tg-inputwithicon">
                                                    <label class="control-label">City</label>
                                                    <input class="form-control input-md" name="city" type="text"
                                                        value="{{ auth()->user()->city }}">

                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="control-label">Country</label>
                                                    <input class="form-control input-md" name="country" type="text"
                                                        value="{{ auth()->user()->country }}">
                                                </div> --}}
                                            <div class="tg-checkbox">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="tg-agreetermsandrules">
                                                    {{-- <label class="custom-control-label" for="tg-agreetermsandrules">I
                                                    agree to all <a href="javascript:void(0);">Terms of Use &amp;
                                                        Posting Rules</a></label> --}}
                                                </div>
                                            </div>
                                            <button class="btn btn-common" type="submit">UPDATE </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
