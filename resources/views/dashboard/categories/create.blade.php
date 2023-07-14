@extends('layouts.dashbord.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Add Category</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <a class="btn btn-primary btn-block" href="{{ route('categories.index') }}">All Categories</a>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
    <!-- row opened -->

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-info">{{ $errors->first() }}</div>
                    @endif
                    <form method="post" action="{{ route('categories.store') }}" class="needs-validation was-validated">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" required="" name="name"
                                        pattern="[a-zA-Z 0-9]+"
                                        oninvalid="setCustomValidity('Please enter alphabets only. ')">
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
                                <div class="col-md-3">
                                    <label for="max_number_free_ads">Max number of ads</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="max_number_free_ads" required=""
                                        name="max_number_free_ads" min="1">
                                </div>
                                @error('max_number_free_ads')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="free_ads_days">Num of days for free ads</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="free_ads_days" required=""
                                        name="free_ads_days" min="1">
                                </div>
                                @error('free_ads_days')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="category_id">Parent Category</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2-no-search" id="category_id" name="category_id">
                                        <option label="no parent">
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
