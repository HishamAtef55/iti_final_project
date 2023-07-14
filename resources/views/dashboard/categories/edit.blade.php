@extends('layouts.dashbord.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Edit Category</h4>
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
                    <form method="post" action="{{ route('categories.update', $category['id']) }}"
                        class=" needs-validation was-validated">
                        @csrf
                        @method('PUT')
                        <input type="text" hidden name="idx" value="{{ $category['id'] }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"
                                        value="{{ old('name') ?? $category['name'] }}" id="name" name="name"
                                        required="" pattern="[a-zA-Z 0-9]+"
                                        oninvalid="setCustomValidity('Please enter alphabets only. ')">
                                </div>
                                @error('name')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="free_ads_days">free ads days</label>
                                </div>
                                <div class="col-md-9">

                                    <input type="number" min="1" class="form-control" id="free_ads_days"
                                        name="free_ads_days"
                                        value="{{ old('free_ads_days') ?? $category['free_ads_days'] }}" required="">
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
                                    <label for="max_number_free_ads">Max number of free ads</label>
                                </div>
                                <div class="col-md-9">

                                    <input type="number" min="1" class="form-control" id="max_number_free_ads"
                                        name="max_number_free_ads"
                                        value="{{ old('max_number_free_ads') ?? $category['max_number_free_ads'] }}"
                                        required="">
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
                                    <label for="category_id">Parent Category</label>
                                </div>
                                <div class="col-md-9">

                                    <select class="form-control select2-no-search" id="category_id" name="category_id">
                                        <option value="{{ old('parent_id') ?? $category['parent_id'] }}">
                                            {{ $category['parent_name'] }}
                                        </option>
                                        <option value="">
                                            No Parent
                                        </option>
                                        @foreach ($categories as $cat)
                                            @if ($category['id'] != $cat->id && $category['parent_id'] != $cat->id)
                                                <option value="{{ $cat->id }}"> {{ $cat->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-primary btn-block " href="{{ route('categories.index') }}">Sbmit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($category['parent_id'])
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Attributes</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                            <a class="btn btn-success" href="{{ route('add-attribute', ['id' => $category['id']]) }}">Add
                                Attribute</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($category['attributes'])
                                        @foreach ($category['attributes'] as $attribute)
                                            <tr>
                                                <th scope="row">@php
                                                    echo $i;
                                                    $i++;
                                                @endphp
                                                </th>
                                                <td>{{ $attribute['name'] }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('attributes.edit', ['attribute' => $attribute['id']]) }}">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('attributes.destroy', ['attribute' => $attribute['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="odd">
                                            <td valign="top" colspan="6" class="dataTables_empty">No data available in
                                                table</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Packages</h4>
                            <i class="mdi mdi-dots-horizontal text-gray">
                                <a class="btn btn-success" href="{{ route('packages.create') }}">Add
                                    Package</a>
                            </i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>AVAILABLITY'S DAYS </th>
                                        <th>NUMBER OF ADS </th>
                                        <th>PRICE</th>
                                        <th>Days </th>
                                        <th>Availability </th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($category['packages'])
                                        @foreach ($category['packages'] as $package)
                                            <tr>

                                                <td>{{ $package['id'] }}</td>
                                                <td>{{ $package['name'] }}</td>
                                                <td>{{ $package['availablity_days'] }}</td>
                                                <td>{{ $package['num_of_ads'] }}</td>
                                                <td>{{ $package['price'] }}</td>
                                                <td>{{ $package['days'] }}</td>

                                                <td>{{ $package['available'] }}</td>


                                                <td>
                                                    <form
                                                        action="{{ route('packages.edit', ['package' => $package['id']]) }}">
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('packages.destroy', ['package' => $package['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="odd">
                                            <td valign="top" colspan="9" class="dataTables_empty">No data available
                                                in
                                                table</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
        </div>
    @endif
@endsection
