@extends('layouts.dashbord.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Packages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Update
                    Package</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <a class="btn btn-primary btn-block" href="{{ route('packages.index') }}">All Packages</a>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Update Package
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('packages.update', $package->id) }}" method="POST"
                                class="bg-gray-200 p-4">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="name">Package Name</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control @error('name') is-invalid @enderror" 
                                            required type="text" name="name" value="{{ $package->name}}">
                                            @error('name')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="category_id">Select Categories</label>
                                        </div>
                                        <div class="col-md-10">
                                            <select class="form-control select2-no-search " id="category_id" @error('category_id') is-invalid @enderror
                                                 name="category_id[]" multiple>
                                                 @foreach ($categories as $category)
                                                 <option value="{{ $category->id }}"
                                                     @foreach ($package->categories as $packageCategory)
                                                             {{ $packageCategory->pivot->category_id == $category->id ? 'selected' : '' }} @endforeach>
                                                     {{ $category->name }}</option>
                                                @endforeach                                            
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="free_ads_days">Package Price</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control @error('price') is-invalid 
                                            @enderror" 
                                            type="number" name="price" min="1" required value="{{ $package->price }}">
                                        </div>
                                        @error('price')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="validity_days">Package Validity Days</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control @error('validity_days') is-invalid @enderror" 
                                            type="number" name="validity_days" 
                                            id="validity_days" required min="1"
                                            value="{{ $package->validity_days }}">
                                        </div>
                                        @error('validity_days')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="num_of_ads">Number of Ads</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input  id="num_of_ads" class="form-control 
                                             @error('num_of_ads') is-invalid @enderror" 
                                             value="{{ $package->num_of_ads }}"
                                             type="number" name="num_of_ads" min="1" required>
                                        </div>
                                        @error('num_of_ads')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="days">Number of Ad Days</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input class="form-control @error('days') is-invalid @enderror" 
                                            type="number" name="days" 
                                            id="days" required min="1"
                                            value="{{ $package->days }}">
                                        </div>
                                        @error('days')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label > Choose Availability</label>
                                        </div>
                                        <div class="col-md-10">
                                            <label for="available">Available</label>
                                            <input type="radio" {{ $package->available == 'available' ? 'checked' : '' }}
                                            id="available" name="available" value="available">
                                            <label for="unavailable">Unavailable</label>
                                            <input type="radio" {{ $package->available == 'unavailable' ? 'checked' : '' }}
                                            id="unavailable" name="available" value="unavailable">                                        </div>
                                        @error('available')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-main-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Form-layouts js -->
    <script src="{{ URL::asset('assets/js/form-layouts.js') }}"></script>
@endsection
