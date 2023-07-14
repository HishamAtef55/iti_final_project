@extends('layouts.dashbord.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Packages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$package->name}}'s Details</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<a class="btn btn-primary btn-block" href="{{ route('package_category.create',$package->id) }}">Add New Categories</a>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Categories of {{$package->name}} </h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-auto text-center border-bottom-0"> # </th>
												<th class="wd-auto text-center border-bottom-0"> Category </th>
												<th class="wd-auto text-center border-bottom-0"> Number Of Free Ads </th>
												<th colspan="3" class="wd-auto text-center border-bottom-0">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($package->categories as $category )
											<tr>
												<td class="text-center"> {{++$loop->index}}</td>
												<td class="text-center"> {{$category->name}}</td>
												<td class="text-center"> {{$category->free_ads_days}}</td>
												<td class="text-center"> 
													<a class="btn btn-primary " href="{{ route('categories.show',$category->pivot->category_id) }}">Show</a>
												</td>
												<td>
													<form action="{{ route('package_category.edit',$category->pivot->package_id) }}" method="post">
														@csrf
														<input type="hidden" name="category_id" value="{{$category->pivot->category_id}}">
														<input  class="btn btn-secondary" type="submit"  value="Edit">
													</form>
												</td>
												<td>
													<form action="{{ route('package_category.destroy',$category->pivot->category_id) }}" method="post">
														@method("delete")
														@csrf
														<input type="hidden" name="package_id" value="{{$category->pivot->package_id}}">
														<input  class="btn btn-danger" type="submit"  value="Delete">
													</form>
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
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection