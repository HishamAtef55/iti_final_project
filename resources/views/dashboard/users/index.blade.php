@extends('layouts.dashbord.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Users</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <a class="btn btn-primary btn-block" href="{{ route('registerr') }}">Add User</a>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table text-md-nowrap">
                        <thead>
                            <tr>

                                <th class="wd-15p border-bottom-0">action</th>

                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">email</th>
                                <th class="wd-15p border-bottom-0">birth date</th>
                                <th class="wd-15p border-bottom-0">role</th>
                                <th class="wd-15p border-bottom-0">whatsapp</th>
                                <th class="wd-15p border-bottom-0">phone</th>
                                <th class="wd-15p border-bottom-0">address</th>
                                <th class="wd-15p border-bottom-0">city</th>
                                <th class="wd-15p border-bottom-0">country</th>


                            </tr>

                        </thead>
                        <tbody>


                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">

                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <br>
                                        <form action="{{ route('user.edit', $user->id) }}" method="GET">


                                            @csrf
                                            <button class="btn btn-success"><i class="typcn typcn-edit"></i></button>
                                        </form>

                                    </td>
                                    <td> {{ $user->name }}</td>

                                    <td>{{ $user->email }}


                                    </td>

                                    <td>{{ $user->date_of_birth }}

                                    </td>
                                    <td>{{ $user->role }}


                                    </td>
                                    <td>{{ $user->whatsapp }}


                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>

                                    <td>{{ $user->city ? $user->city->name : '' }}</td>





                                    <td>{{ $user->country ? $user->country->name : '' }}</td>
                                    <td>

                                </tr>

                                </td>
                            @endforeach

                        </tbody>

                    </table>
                    {{-- <td> {{ $users->links() }}</td> --}}

                </div>
            </div>
        </div>
    </div>
@endsection
