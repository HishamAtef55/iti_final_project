@extends('layouts.dashbord.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Category's packages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Update Category </span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
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
									Update  Package
								</div>
								<div class="row">
									<div class="col-lg-12">
										<form action="{{route('package_category.update',$package->id)}}" method="POST" class="bg-gray-200 p-4">
											@csrf
                                            @method('put')
											<div class="form-group">
												<div class="row">
													<div class="col-md-2">
														<label for="category_id">Select Categories</label>
													</div>
													<div class="col-md-10">
														<select class="form-control select2-no-search " id="category_id" @error('category_id') is-invalid @enderror
														 	name="category_id">
															 @foreach ($categories as $category)
															 <option value="{{$category->id}}" 
																 {{$category_id == $category->id ? "selected" : ""}}
																 >{{$category->name}}</option>
															 @endforeach
														</select>
														@error('category_id')
															<p class="text-danger">
																{{ $message }}
															</p>
														@enderror
													</div>
												</div>
												<input type="hidden" name="oldCategory_id" value="{{$category_id}}">
                                            </div>
											<input type="hidden" name="package_id" value="{{$package->id}}">
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
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Form-layouts js -->
<script src="{{URL::asset('assets/js/form-layouts.js')}}"></script>
@endsection