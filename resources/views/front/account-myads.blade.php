@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">My Ads</h2>
                        <ol class="breadcrumb">

                            <li><a href="#">Home/

                                </a></li>

                            <li class="current">My Ads</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content" class="section-padding">

        <div class="alert alert-success" id="alert" style="display:none">
            Thank you for caring about website we accept your request
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3 page-sidebar">

                    <aside>
                        <div class="sidebar-box">
                            <div class="user">
                                {{-- <figure>
                                    <a href="#"><img src="assets/img/author/img1.jpg" alt=""></a>
                                </figure> --}}
                                <div class="usercontent">
                                    <h3>Hello {{ auth()->user()->name }}</h3>
                                </div>
                            </div>
                            <nav class="navdashboard">
                                <ul>

                                    <li>

                                        <a href="{{ route('profile', Auth::user()) }}">
                                            <i class="lni-cog"></i>
                                            <span>Profile Settings</span>
                                        </a>

                                    </li>
                                    {{-- <form action="{{ route('po', Auth::user()) }}" method="GET">
                                            @csrf
                                            <button>
                                                ads
                                            </button>
                                        </form> --}}
                                    <li>

                                        <a class="active" href="{{ route('po', Auth::user()) }}">
                                            <i class="lni-layers"></i>
                                            <span>My Ads</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('userCategory.create') }}">
                                            <i class="lni-wallet"></i>
                                            <span>Buy Package</span>
                                        </a>
                                    </li>
                                    <li>
                                        {{-- <form action="{{ route('po', Auth::user()) }}" method="POST">
                                            @csrf
                                            <button>
                                                ads
                                            </button>
                                        </form> --}}
                                        {{-- <a href="{{ route('user.myPackages') }}">
                                            <i class="lni-wallet"></i>
                                            <span>My Packages</span>
                                        </a> --}}
                                    </li>
                                    <li>
                                        <a href="{{ route('wishlist.show') }}">
                                            <i class="lni-heart"></i>
                                            <span>My Favourites</span>
                                        </a>
                                    </li>

                                    {{-- <li>
                                        <a href="#">
                                            <i class="lni-enter"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </nav>
                        </div>
                    </aside>

                </div>

                <div class="col-sm-12 col-md-9 col-lg-9">

                    <div class="page-content">
                        <div class="inner-box">
                            <div class="dashboard-box">
                                <h2 class="dashbord-title">My Ads</h2>
                            </div>
                            <div class="dashboard-wrapper">
                                <nav class="nav-table">
                                    <ul>

                                    </ul>
                                </nav>
                                <table class="table table-responsive dashboardtable tablemyads">
                                    <thead>
                                        <tr>
                                            {{-- <th>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkedall">
                                                        <label class="custom-control-label" for="checkedall"></label>
                                                    </div>
                                                </th> --}}
                                            <th>Photo</th>

                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Ad Status</th>
                                            <th>Request</th>
                                            <th>Price</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ads as $ad)
                                            <tr id="aid{{ $ad->id }}" data-category="active">
                                                {{-- <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="adone">
                                                            <label class="custom-control-label" for="adone"></label>
                                                        </div>
                                                    </td> --}}

                                                <td class="photo">
                                                    <img src="{{ asset('ads/image/' . $ad['image'][0]['fileimage']) }}"
                                                        class="img-fluid" alt="...">
                                                </td>
                                                <td data-title="Title">
                                                    {{-- @if ($ads) --}}

                                                    <h3>{{ $ad->name }}</h3>

                                                    {{-- @endif --}}


                                                </td>
                                                <td data-title="Category"><span
                                                        class="adcategories">{{ $ad->category->name }}</span>
                                                </td>
                                                <td data-title="Ad Status"><span class="adstatus adstatusactive"
                                                        id="statuuus">{{ $ad->status }}</span>
                                                </td>
                                                <td id="sold">

                                                    @if ($ad['status'] == 'Approved')
                                                        <button data-id="{{ $ad->id }}" name="sold-id" id="soldid"
                                                            class="btn btn-danger" id="mybtn">
                                                            sold
                                                        </button>
                                                    @elseif($ad['status'] == 'Deactive')
                                                        <form method="get" action="{{ route('republishad', $ad->id) }}">
                                                            @csrf
                                                            <button class="btn btn-danger">
                                                                Rebublish
                                                            </button>
                                                        </form>
                                                    @else
                                                        No Request
                                                    @endif

                                                </td>
                                                <td data-title="Price">
                                                    <h3>{{ $ad->price }}</h3>

                                                </td>
                                                <td data-title="Action">
                                                    <div class="btns-actions">
                                                        @if ($ad['status'] == 'Rejected')
                                                        @elseif ($ad['status'] == 'Deactive')
                                                        @else
                                                            <a class="btn-action btn-view"
                                                                href="{{ route('adDetails', $ad->id) }}">
                                                                <i class="lni-eye"></i></a>
                                                        @endif

                                                        <a class="btn-action btn-edit"
                                                            href="{{ route('UseradEdit', $ad->id) }}"><i
                                                                class="lni-pencil"></i>
                                                        </a>

                                                        <button class="btn-action btn-delete" id="deleteid" name="image_id"
                                                            data-id="{{ $ad->id }}"><i
                                                                class="lni-trash"></i></button>

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

                {{-- start script --}}

                {{-- end script --}}

            </div>
        </div>
    </div>



    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/color-switcher.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/contact-form-script.min.js"></script>
    <script src="assets/js/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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
                // sold stattus
            });
        })
    </script>



    <script>
        $('document').ready(function() {
            $(document).on('click', '#soldid', function() {
                const id = $(this).data('id');
                swal({
                        title: 'sold!',
                        text: 'Congratulation',
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
                            url: '/ad/sold/status',
                            type: 'POST',
                            DataType: 'json',
                            data: {
                                sold_id: id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                swal({
                                    title: 'Accepted!',
                                    text: 'Ads has been Sold',
                                    type: 'success',
                                    timer: 2000,
                                });
                                $('#sold').html('no request');
                                $('#statuuus').html('sold');
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
