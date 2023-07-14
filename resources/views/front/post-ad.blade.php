@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Ad Details</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Ad Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <form method="POST" action="{{ url('/ads/attributes/createad') }}" enctype="multipart/form-data">
            <div class="row">
                <input type="text" style="display: none;" value="{{ $x }}" name="category_id">
                @csrf
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <div class="mb-1">
                        <label for="exampleInputname" class="form-label">Name</label>
                        <input value="{{ old('name') }}" type="text" name="name" required
                            @error('name') is-invalid @enderror class="form-control" id="exampleInputEname"
                            aria-describedby="emailHelp">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label for="exampleInputprice" class="form-label">price</label>
                        <input type="number" value="{{ old('price') }}" name="price" required
                            @error('price') is-invalid @enderror aria-describedby="emailHelp" class="form-control"
                            id="exampleInputprice">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    @foreach ($atributes as $attr)
                        <div class="col-md-8" style="padding-left: 0px; !important">
                            <div class="mb-1">
                                <label for="exampleInputname" class="form-label">{{ $attr['name'] }}</label>
                                <input type="text" style="display: none;" value="{{ $attr['id'] }}"
                                    name="attribute_id">
                                <input type="text" name="{{ $attr['id'] }}" class="form-control" id="exampleInputEname"
                                    required aria-describedby="emailHelp">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <label for="exampleInputname" class="form-label">Description</label>
                    <textarea type="text" required value="{{ old('description') }}" name="description"
                        @error('description') is-invalid @enderror class="form-control" rows="4" cols="50" id="exampleInputEname"
                        aria-describedby="descHelp"> </textarea>

                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
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
                </div>

                <div class="col-md-4">
                    <div class="mb-1">
                        <label for="exampleInputcity" class="form-label">city</label>
                        <select disabled class="form-control" id="city_id" name="city_id">

                        </select>
                        @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label for="exampleInputlocation" class="form-label">location</label>
                                <input required type="text" value="{{ old('location') }}" name="location"
                                    class="form-control" id="exampleInputlocation">
                                @error('location')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" id="submitads" class="btn btn-primary">submit</button>

                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <label class="tg-fileuploadlabel" for="tg-photogallery">
                        <span>Drop files anywhere to upload</span>
                        <span>Or</span>
                        <span class="btn btn-common">Select Files</span>
                        <span>Maximum upload file size: 500 KB</span>

                        <input required class="tg-fileinput" id="tg-photogallery" type="file" id="formFile"
                            name="fileimage[]" multiple= />
                        @error('fileimage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </label>
                </div>
            </div>




        </form>
    </div>


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
