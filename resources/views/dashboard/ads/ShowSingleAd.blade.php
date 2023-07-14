@extends('layouts.dashbord.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Ad Details</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->


    <div class="row row-sm">

        <div class="col-xl-12">

            <div class="row">
                <div class="col-md-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="{{ asset('ads/image/' . $ads['image'][0]['fileimage']) }}" class="d-block w-100"
                                    alt="...">
                            </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="width: 30rem;">

                        <div class="card-body">
                            <h5 class="card-title"><u style="color:#48619f">name:</u> &nbsp;&nbsp;{{ $ads->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><u style="color:#48619f">price:</u>
                                &nbsp;&nbsp;{{ $ads->price }}</h6>
                            <p class="card-text"><u style="color:#48619f">Description:</u>
                                &nbsp;&nbsp;{{ $ads->description }}</p>
                            <h5 class="card-title"><u style="color:#48619f">username:</u> &nbsp;&nbsp;{{ $ads->user->name }}
                            </h5>
                            <h5 class="card-title"><u style="color:#48619f">Category:</u>
                                &nbsp;&nbsp;{{ $ads->category->name }}</h5>
                            <h5 class="card-title"><u style="color:#48619f">City:</u> &nbsp;&nbsp;{{ $ads->city->name }}
                            </h5>
                            <h5 class="card-title"><u style="color:#48619f">Country:</u>
                                &nbsp;&nbsp;{{ $ads->country->name }}
                            </h5>

                            @foreach ($ads->attributes as $attr)
                                <h5 class="card-title">
                                    <u style="color:#48619f">
                                        {{ $attr['name'] }} &nbsp; :
                                    </u>
                                    {{ $attr->pivot->value }}
                                </h5>
                            @endforeach

                            <h5 class="card-title"><u style="color:#48619f">Status:</u>
                                &nbsp;&nbsp;{{ $ads->status }}
                            </h5>


                            <h5 class="card-title"><u style="color:#48619f">Start_date:</u>
                                &nbsp;&nbsp;{{ $ads->start_date }}
                            </h5>
                            <h5 class="card-title"><u style="color:#48619f">End_date:</u>
                                &nbsp;&nbsp;{{ $ads->end_date }}
                            </h5>
                            <a href="{{ url('/See/All/Ads') }}" class="btn btn-primary btn-md text-white float-end">
                                BACK
                            </a>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>































    <!-- main-content closed -->
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
