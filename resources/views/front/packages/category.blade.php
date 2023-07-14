@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title"> Buy Package </h2>
                        <ol class="breadcrumb">
                            <li><a href="#"> Home /</a></li>
                            <li class="current"> Buy Package </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">

        <h2 style="text-align: center; padding: 15px;" class="mt-4 mb-4">Select Category</h2>
        <form method="POST" action="{{route('userPackage.create')}}">
            <div class="row">
                @csrf
                <div class="col-md-6">
                    <select class="form-control select2-no-search"  id="category_id" name="category_id"
                        onchange="handleChange(value)">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" {{old('category_id') == $category['id'] ? 'selected':''}}>
                                {{ $category['name'] }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select disabled class="form-control select2-no-search @error('subCategory') is-invalid @enderror" id="subCategory" name="subCategory">
                    </select>
                    @error('subCategory')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="row form-group mt-5 text-right">
                <div class="col-md-12">
                    <input disabled name="submit_category" id="submit_category" type="submit" value="Next"
                        class="btn btn-common">
                </div>
            </div>
        </form>
    </div>

    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <script>
        function handleChange(value) {
            let html = `<option value=""></option>`;
            if (value) {
                fetch('/category/child/' + value) //api for the get request
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(element => {
                            html += `<option value="${element.id}">${element.name}</option>`;
                        })
                        document.querySelector("#subCategory").innerHTML = (html);
                        console.log(value);
                        if (value) {
                            $('#submit_category').prop('disabled', false);
                            $('#subCategory').prop('disabled', false);
                        } else {
                            $('#submit_category').prop('disabled', true);
                            $('#subCategory').prop('disabled', true);
                        }
                    });
            } else {
                $('#submit_category').prop('disabled', true);
                $('#subCategory').prop('disabled', true);
            }
        }
    </script>
@endsection
