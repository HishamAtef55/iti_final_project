@extends('layouts.front.master')
@section('content')
    <div id="content" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
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

                                        <a class="active" href="{{ route('profile', Auth::user()) }}">
                                            <i class="lni-cog"></i>
                                            <span>Profile Settings</span>
                                        </a>

                                    </li>
                                    <li>
                                        {{-- <form action="{{ route('po', Auth::user()) }}" method="GET">
                                            @csrf
                                            <button>
                                                ads
                                            </button>
                                        </form> --}}
                                        <a href="{{ route('po', Auth::user()) }}">
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
                                        <a href="{{route('MyOrders')}}">
                                            <i class="lni-wallet"></i>
                                            <span>My Orders</span>
                                        </a>
                                    </li>                                        
                                    <li>
                                        <a href="{{ url('/chatify') }}">
                                            <i class="lni-wallet"></i>
                                            <span>message</span>
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
                        {{-- <div class="widget">
                            <h4 class="widget-title">Advertisement</h4>
                            <div class="add-box">
                                <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                            </div>
                        </div> --}}
                    </aside>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="page-content">
                        <div class="inner-box">
                            <div class="dashboard-box">
                                <h2 class="dashbord-title">Order Details</h2>
                            </div>
                            <div class="dashboard-wrapper">
                                <table class="table table-responsive dashboardtable tablemyads">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center"> Order ID</th>
                                            <th class="text-center"> Package Name</th>
                                            <th class="text-center">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->packages as $package )
                                        <tr data-category="active">
                                            <td class="text-center" >
                                                {{++$loop->index}}
                                            </td>
                                            <td class="text-center" data-title="Title">
                                                {{$package->pivot->order_id}}
                                            </td>
                                            <td  class="text-center" data-title="Category">
                                                {{$package->name}}
                                            </td>
                                            <td  class="text-center" data-title="Price">
                                                <h3>{{$package->pivot->quantity}}</h3>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="row page-content">
                        				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Packages of {{$user->name}} </h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-auto text-center border-bottom-0"> # </th>
												<th class="wd-auto text-center border-bottom-0"> Package Name </th>
                                                <th class="wd-auto text-center border-bottom-0"> Start Date </th>
												<th class="wd-auto text-center border-bottom-0"> End Date </th>
												<th class="wd-auto text-center border-bottom-0"> Status </th>
												<th class="wd-auto text-center border-bottom-0">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center"> {{++$loop->index}}</td>
												<td class="text-center"> {{$package->name}}</td>
                                                <td class="text-center"> {{$package->name}}</td>
												<td class="text-center"> {{$package->name}}</td>
												<td class="text-center"> {{$package->name}}</td>
                                                <td class="text-center"> 
													<a class="btn btn-primary " href="#">Renew</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->

                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection
