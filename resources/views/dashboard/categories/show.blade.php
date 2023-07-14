@extends('layouts.dashbord.master')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <a class="btn btn-primary btn-block" href="{{ route('categories.index') }}">All Categories</a>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row">

        <div class="col-12 col-md-6">
            <div class="card card-primary">
                <div class="card-header pb-0">
                    <h3 class=" mb-0 pb-0"> {{ $category['name'] }}
                    </h3>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                        <strong>Parent:</strong>
                        @if ($category['parent'])
                            {{ $category['parent'] }}
                        @else
                            No parent
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Max number of free ads:</strong>
                        {{ $category['max_number_free_ads'] }}
                    </div>
                    <div class="form-group">
                        <strong>Num of days for free ads:</strong>
                        {{ $category['free_ads_days'] }}
                    </div>

                </div>
                <div class="card-footer">
                    <div class="btn-icon-list">
                        <form action="{{ route('categories.edit', $category['id']) }}" class="mr-3">
                            <button class="btn btn-success">Edit</button>
                        </form>
                        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST" class="mr-3">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        @if ($category['parent'])
                            <a class="btn btn-warning" href="{{ route('add-attribute', ['id' => $category['id']]) }}">Add
                                Attribute</a>
                            <a class="btn btn-primary" href="{{ route('packages.create') }}">Add
                                Package</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row opened -->
    @if ($category['parent'])
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Attributes</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
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
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>VALIDITY'S DAYS </th>
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
                                                <td>{{ $package['validity_days'] }}</td>
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
                                            <td valign="top" colspan="9" class="dataTables_empty">No data available in
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
    </div>
    <!-- Container closed -->
    </div>

@endsection
