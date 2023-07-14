@extends('layouts.front.master')



@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">My Favorites</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">My Favorites</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

                                        <a href="{{ route('profile', Auth::user()) }}">
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
                                        <a class="active" href="{{ route('wishlist.show') }}">
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
                        <div class="widget">
                            <h4 class="widget-title">Advertisement</h4>
                            <div class="add-box">
                                <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="page-content">
                        <div class="inner-box">
                            <div class="dashboard-box">
                                <h2 class="dashbord-title">My Favourites</h2>
                            </div>
                            <div class="dashboard-wrapper">
                                <nav class="nav-table">
                                    <ul>
                                        <li class="active"><a href="#">Featured (12)</a></li>
                                    </ul>
                                </nav>
                                <table class="table table-responsive dashboardtable tablemyads">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkedall">
                                                    <label class="custom-control-label" for="checkedall"></label>
                                                </div>
                                            </th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Ad Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>




                                        @foreach ($ads as $ad)
                                            @php
                                                $images = $ad->image()->get();
                                            @endphp

                                            <tr data-category="active">
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="adtwo">
                                                        <label class="custom-control-label" for="adtwo"></label>
                                                    </div>
                                                </td>
                                                <td class="photo"><img class="img-fluid"
                                                        src="{{ URL::asset('ads/image/' . $images[0]['fileimage']) }}"
                                                        alt=""></td>
                                                <td data-title="Title">
                                                    <h3>{{ $ad->name }}</h3>
                                                    <span>Ad ID: {{ $ad->id }}</span>
                                                </td>
                                                <td data-title="Category">{{ $ad->category->name }}</td>

                                                @if ($ad->status == 'approved')
                                                    <td data-title="Ad Status"><span
                                                            class="adstatus adstatusactive">{{ $ad->status }}</span>
                                                    @elseif ($ad->status == 'pending')
                                                    <td data-title="Ad Status"><span
                                                            class="adstatus adstatusinactive">{{ $ad->status }}</span>
                                                    @elseif ($ad->status == 'sold')
                                                    <td data-title="Ad Status"><span
                                                            class="adstatus adstatussold">{{ $ad->status }}</span>
                                                    @elseif ($ad->status == 'expired')
                                                    <td data-title="Ad Status"><span
                                                            class="adstatus adstatusexpired">{{ $ad->status }}</span>
                                                    @elseif ($ad->status == 'deleted')
                                                    <td data-title="Ad Status"><span
                                                            class="adstatus adstatusdeleted">{{ $ad->status }}</span>
                                                @endif


                                                </td>
                                                <td data-title="Price">
                                                    <h3>{{ $ad->price }}</h3>
                                                </td>
                                                <td data-title="Action">
                                                    <div class="btns-actions">
                                                        <a class="btn-action btn-view"
                                                            href="{{ route('adDetails', ['id' => $ad->id]) }}"><i
                                                                class="lni-eye"></i></a>

                                                        <a class="btn-action btn-delete"
                                                            href="{{ route('wishlist.destroy', ['ad' => $ad->id]) }}"><i
                                                                class="lni-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- <tr data-category="inactive">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adthree">
                                                    <label class="custom-control-label" for="adthree"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img3.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Furniture Straps 4-Pack, TV Anti-Tip Metal Wall </h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Real Estate</td>
                                            <td>
                                                <span class="adstatus adstatusinactive">Inactive</span>
                                            </td>
                                            <td data-title="Price">
                                                <h3>$69</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="sold">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adfour">
                                                    <label class="custom-control-label" for="adfour"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img4.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Apple iPhone X, Fully Unlocked 5.8", 64 GB - Black</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Mobile</td>
                                            <td data-title="Ad Status"><span class="adstatus adstatussold">Sold</span>
                                            </td>
                                            <td data-title="Price">
                                                <h3>$89</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="active">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adfive">
                                                    <label class="custom-control-label" for="adfive"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img5.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Apple Macbook Pro 13 Inch with/without Touch Bar</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Apple</td>
                                            <td data-title="Ad Status"><span class="adstatus adstatusactive">Active</span>
                                            </td>
                                            <td data-title="Price">
                                                <h3>$289</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="sold">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adsix">
                                                    <label class="custom-control-label" for="adsix"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img6.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Apple MQDT2CL/A 10.5-Inch 64GB Wi-Fi iPad Pro</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Apple iPad</td>
                                            <td data-title="Ad Status"><span class="adstatus adstatussold">Sold</span>
                                            </td>
                                            <td data-title="Price">
                                                <h3>$159</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="expired">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adseven">
                                                    <label class="custom-control-label" for="adseven"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img7.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Essential Phone 8GB Unlocked with Dual Camera</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Mobile</td>
                                            <td data-title="Ad Status"><span
                                                    class="adstatus adstatusexpired">Expired</span></td>
                                            <td data-title="Price">
                                                <h3>$89</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="inactive">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adeight">
                                                    <label class="custom-control-label" for="adeight"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img8.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>LG Nexus 5x LG-H791 32GB GSM Smartphone</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Mobile</td>
                                            <td>
                                                <span class="adstatus adstatusinactive">Inactive</span>
                                            </td>
                                            <td data-title="Price">
                                                <h3>$59</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="expired">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adnine">
                                                    <label class="custom-control-label" for="adnine"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img9.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Samsung Galaxy G550T On5 GSM Unlocked Smartphone</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Mobile</td>
                                            <td data-title="Ad Status"><span
                                                    class="adstatus adstatusexpired">Expired</span></td>
                                            <td data-title="Price">
                                                <h3>$129</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-category="deleted">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="adten">
                                                    <label class="custom-control-label" for="adten"></label>
                                                </div>
                                            </td>
                                            <td class="photo"><img class="img-fluid" src="assets/img/product/img10.jpg"
                                                    alt=""></td>
                                            <td data-title="Title">
                                                <h3>Apple iMac Pro 27" All-in-One Desktop, Space Gray</h3>
                                                <span>Ad ID: ng3D5hAMHPajQrM</span>
                                            </td>
                                            <td data-title="Category">Apple iMac</td>
                                            <td data-title="Ad Status"><span
                                                    class="adstatus adstatusdeleted">Deleted</span></td>
                                            <td data-title="Price">
                                                <h3>$389</h3>
                                            </td>
                                            <td data-title="Action">
                                                <div class="btns-actions">
                                                    <a class="btn-action btn-view" href="#"><i
                                                            class="lni-eye"></i></a>
                                                    <a class="btn-action btn-edit" href="#"><i
                                                            class="lni-pencil"></i></a>
                                                    <a class="btn-action btn-delete" href="#"><i
                                                            class="lni-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
