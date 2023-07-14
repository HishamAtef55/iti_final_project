@extends('layouts.dashbord.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Ads</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->

    <div class="row row-sm">

        <div class="col-xl-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Image</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">price</th>
                                    <th class="wd-15p border-bottom-0">category</th>
                                    <th style="text-align: center;" class="wd-15p border-bottom-0">Request</th>
                                    <th style="text-align: center;" class="wd-15p border-bottom-0">Request</th>
                                    <th class="wd-15p border-bottom-0">City</th>
                                    <th class="wd-15p border-bottom-0">User</th>
                                    <th class="wd-15p border-bottom-0">Status</th>
                                    <th style="text-align: center;" class="wd-5p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ads as $ad)
                                    <tr id="aid{{ $ad->id }}">
                                        <td>{{ $ad->id }}</td>
                                        <td>
                                            <img src="{{ asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                                height="80px; width:100px;">
                                        </td>
                                        <td>{{ $ad->name }}</td>
                                        <td>{{ $ad->price }}</td>
                                        <td>{{ $ad->category->name }}</td>

                                        <td>

                                            @if ($ad['status'] == 'Pending' || $ad['status'] == 'Update Pending')
                                                <form action="{{ route('updates.ads.status', $ad) }}" method="get">

                                                    @csrf
                                                    <button class="btn btn-primary"> <i
                                                            class="fa-sharp fa-solid fa-circle-check"></i></button>

                                                </form>
                                            @elseif($ad['status'] == 'Approved')
                                                <form action="{{ route('updates.ads.status', $ad) }}" method="get">
                                                    @csrf
                                                    <button class="btn btn-primary mr-2">
                                                        sold
                                                    </button>
                                                </form>
                                            @else
                                                No Request
                                            @endif

                                        </td>

                                        <td>
                                            @if ($ad['status'] == 'Pending' || $ad['status'] == 'Update Pending')
                                                <form action="{{ route('reject.ads.status', $ad) }}" method="get">
                                                    @csrf
                                                    <button class="btn btn-danger"> <i
                                                            class="fa-sharp fa-solid fa-circle-xmark"></i></button>
                                                </form>
                                            @else
                                                No Request
                                            @endif

                                        </td>
                                        <td>{{ $ad->city->name }}</td>
                                        <td>
                                            {{ $ad->user->name }}
                                        </td>
                                        <td>
                                            {{ $ad->status }}
                                        </td>
                                        <td>
                                            <div class="btn-icon-list">

                                                <form action="{{ route('shows.ads.details', $ad->id) }}" method="get">

                                                    @csrf
                                                    <button class="btn btn-primary mr-2"><i
                                                            class="icon ion-md-eye"></i></button>
                                                </form>
                                                {{-- <form action="{{ route('deleteads', $ad->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf --}}
                                                <button class="btn btn-danger " id="deleteid" name="image_id"
                                                    data-id="{{ $ad->id }}"><i class="fas fa-trash"></i></button>
                                                {{-- </form> --}}

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
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
    <!-- Internal Data tables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>




    <script type="text/javascript">
        $('document').ready(function() {

            $(document).on('click', '#deleteid', function() {

                const id = $(this).data('id');

                swal({
                        title: 'Delete !',
                        text: 'Are you sure you want to delete this Ad ?',
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
                            url: '/ads/delete',
                            type: 'delete',
                            DataType: 'json',
                            data: {

                                image_id: id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {

                                swal({
                                    title: 'Deleted!',
                                    text: 'Ads has been deleted.',
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
