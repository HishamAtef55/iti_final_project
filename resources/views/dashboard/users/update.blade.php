@extends('layouts.dashbord.master')

@section('content')
    <table class="table text-md-nowrap">

        <tbody>



            <td>

                <form action="{{ route('user.update', $u->id) }}" method="POST">

                    @method('PUT')

                    @csrf

                    <div class="form-group">

                        <label>Name</label>
                        <input required id="name" pattern="^[a-zA-Z ]{3,}" id="name" pattern="^[a-zA-Z ]{3,}"
                            class="form-control" name="name" value="{{ $u->name }}" type="text">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input required id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" class="form-control"
                            name="email" value="{{ $u->email }}" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <label>birth date</label>

                        <input required id="birthdate" class="form-control" name="date_of_birth"
                            value="{{ $u->date_of_birth }}" type="date">
                    </div>
                    <div class="form-group">
                        <label> role</label>
                        {{-- {{ in_array($item->name, $userRole) ? 'selected' : '' }} --}}

                        @if ($u->role == 'admin')
                            <select class="form-control" name="role">
                                <option value="admin" selected>admin</option>
                                <option value="user">user</option>

                            </select>
                        @endif

                        @if ($u->role == 'user')
                            <select class="form-control" name="role">
                                <option value="user" selected>user</option>
                                <option value="admin">admin</option>

                            </select>
                        @endif

                        {{-- <input required id="name" pattern="^[a-zA-Z ]{3,}" class="form-control" name="role" value="{{ $u->role }}" type="text"> --}}

                    </div>
                    <div class="form-group">
                        <label>whatsapp</label>

                        <input required id="whatsapp" pattern="01[0125][0-9]{8}" class="form-control" name="whatsapp"
                            value="{{ $u->whatsapp }}" type="text">
                    </div>
                    <div class="form-group">
                        <label>phone</label>

                        <input required id="phone" pattern="01[0125][0-9]{8}" class="form-control" name="phone"
                            value="{{ $u->phone }}" type="text">
                    </div>
                    <div class="form-group">
                        <label>address</label>

                        <input required id="address" pattern="^[a-zA-Z ]{3,}" class="form-control" name="address"
                            value="{{ $u->address }}" type="text">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <label for="exampleInputcity" class="form-label">curent country</label>
                                <input readonly class="form-control" value="{{ $u->country ? $u->country->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label for="exampleInputcity" class="form-label">curent city</label>
                                <input readonly class="form-control" value="{{ $u->city ? $u->city->name : '' }}">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="exampleInputcity" class="form-label">chose new country</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="exampleInputcity" class="form-label"> chose new city</label>
                                <select disabled class="form-control" id="city_id" name="city_id">

                                </select>
                                @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- <input required name="name" value="{{ $u->name }}" type="text">
                        <input name="name" value="{{ $u->name }}" type="text"> --}}
                    <button class="btn btn-danger">update</button>
                </form>

            </td>

        </tbody>

    </table>
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
            // confirm: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/,
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
        //////////////////////////
        var password = document.getElementById("password"),
            confirm_password = document.getElementById("password-confirm");

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

            $(document).on('click', '#deleteid', function() {
                const id = $(this).data('id');

                swal({
                        title: 'Delete !',
                        text: 'Are you sure you want to delete this image" ?',
                        type: 'warning',
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        confirmButtonColor: '#5cb85c',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes',
                    },
                    function() {
                        $.ajax({
                            url: '/delete/image',
                            type: 'delete',
                            DataType: 'json',
                            data: {

                                image_id: id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {

                                swal({
                                    title: 'Deleted!',
                                    text: 'image has been deleted.',
                                    type: 'success',
                                    timer: 2000,

                                });
                                $('#aid' + id).remove();

                            },
                            error: function(error) {
                                swal({
                                    title: 'Error!',
                                    text: error.responseJSON.message,
                                    type: 'error',
                                    timer: 5000,
                                })
                            }
                        });
                    });
            });


        })
    </script>
@endsection
