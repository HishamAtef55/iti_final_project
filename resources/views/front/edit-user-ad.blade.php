@extends('layouts.front.master')

@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Ad Edit</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Ad Edit</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <table>
                    <thead>
                        {{-- <tr>
                            <th></th>
                        </tr> --}}
                    </thead>
                    <tbody class="w-100 h-100">
                        @foreach ($ad['image'] as $photo)
                            <tr id="aid{{ $photo['id'] }}" class="container-image-delete">
                                <td>
                                    <figure>
                                        <img class="w-100" src="{{ asset('ads/image/' . $photo['fileimage']) }}"
                                            alt="">
                                        <figcaption>
                                            <button class="btn btn-danger" name="image_id" data-id="{{ $photo['id'] }}"
                                                id="deleteid">delete</button>
                                        </figcaption>
                                    </figure>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>





            <div class="col-md-8 mt-2">
                <form method="post" action="{{ route('UserAdUpdate', $ad->id) }}" enctype="multipart/form-data">

                    @method('PUT')
                    <input type="text" style="display: none;" value="{{ $ad->category->id }}" name="category_id">
                    @csrf
                    <div class="row">
                        {{-- first row --}}
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="exampleInputname" class="form-label">Name</label>
                                <input
                                    @error('name')
                            value="{{ old('name') }}"
                            @enderror
                                    value="{{ $ad['name'] }}" required type="text" name="name" class="form-control"
                                    id="exampleInputEname" aria-describedby="emailHelp">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="exampleInputprice" class="form-label">price</label>
                                <input type="number" required value="{{ $ad->price }}"
                                    @error('price') value="{{ old('price') }}" @enderror name="price"
                                    aria-describedby="emailHelp" class="form-control" id="exampleInputprice">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- second row --}}
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($ad->attributes as $attr)
                                <div class="col-md-8" style="padding-left: 0px; !important">
                                    <div class="mb-1">
                                        <label for="exampleInputname" class="form-label">{{ $attr['name'] }}</label>
                                        <input type="text" style="display: none;" value="{{ $attr['id'] }}"
                                            name="attribute_id">
                                        <input type="text" required value="{{ $attr->pivot->value }}"
                                            name="{{ $attr['id'] }}" class="form-control" id="exampleInputEname"
                                            aria-describedby="emailHelp">

                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="col-md-6">
                            <label for="exampleInputname" class="form-label">Description</label>
                            <textarea type="text" required
                                @error('description')
                        is-invalid
                    value="{{ old('description') }}"
                    @enderror
                                name="description" class="form-control" rows="4" cols="50" id="exampleInputEname"
                                aria-describedby="descHelp">

                        {{ $ad['description'] }}</textarea>

                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    {{-- third row --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <label for="exampleInputcity" class="form-label">country</label>
                                <select class="form-control" id="country" name="country_id">
                                    {{-- <option value="">{{ $ad->country['name'] }}</option> --}}
                                    @foreach ($country as $country)
                                        <option value="{{ $ad->country->id }}" name="country_id">
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
                                <label for="exampleInputcity" class="form-label">city</label>
                                <select disabled class="form-control" required id="city_id" name="city_id">
                                    <option value="{{ $ad->country->id }}">{{ $ad->city->name }}</option>
                                    @error('city_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>

                        </div>
                    </div>
                    {{-- forth row --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputlocation" class="form-label">location</label>
                            <input type="text" required value="{{ $ad->location }}"
                                @error('location') value="{{ old('price') }}" @enderror name="location"
                                aria-describedby="locationHelp" class="form-control" id="exampleInputprice">
                            @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-4">
                            <button type="submit" id="submitads" class="btn btn-danger">Update</button>

                        </div>
                    </div>
                    {{-- fifth row --}}
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label class="tg-fileuploadlabel" for="tg-photogallery">
                                <span>Drop files anywhere to upload</span>
                                <span>Or</span>
                                <span class="btn btn-common">Select Files</span>
                                <span>Maximum upload file size: 500 KB</span>

                                <input class="tg-fileinput" id="tg-photogallery" type="file" id="formFile"
                                    name="fileimage[]" multiple= />
                                @error('fileimage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </label>
                        </div>
                        <div class="col-md-4 mt-5">
                        </div>
                    </div>
            </div>

        </div>
        </form>
    </div>


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
