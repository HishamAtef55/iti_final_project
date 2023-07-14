@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Create Ad</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Create Ad</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (\Session::has('package'))

    <div class="popupBox">
        <div class="popupBox__content">
          <div class="close"></div>
          <div class="popupBox__img">
            <img src="https://cdn.pixabay.com/photo/2021/09/21/02/48/gift-6642306__480.png" alt="" />
          </div>
          <div class="popupBox__contentTwo">
            <div>
              <h3 class="popupBox__title">Great Offer</h3>
              <h2 class="popupBox__titleTwo">Buy <span> Package</span></h2>
              <p class="popupBox__description">
                {!! \Session::get('package') !!}
              </p>
              <a href="{{ route('userCategory.create') }}" class="popupBox__btn">Buy Now!</a>
            </div>
          </div>
        </div>
      </div>
   @endif

    <div class="container">

        <h2 style="text-align: center; padding: 15px;" class="mt-4 mb-4">Select Category</h2>
        <form method="POST" action="{{ route('create-ad') }}">
            <div class="row">
                @csrf
                @if (\Session::has('package'))
                <div id="parent" class="col-md-6">
                    <select disabled class="form-control select2-no-search" id="category_id" name="category_id"
                        onchange="handleChange(value)">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['name'] }} </option>
                        @endforeach
                    </select>
                </div>

                @else
                <div class="col-md-6">
                    <select  class="form-control select2-no-search" id="category_id" name="category_id"
                        onchange="handleChange(value)">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['name'] }} </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-md-6">
                    <select disabled class="form-control select2-no-search" id="childs" name="childs">
                    </select>
                </div>
            </div>
            <div class="row form-group mt-5 text-right">
                <div class="col-md-12">


                    <input disabled name="submit_category" id="submit_category" type="submit" value="Next"
                        class="btn btn-common">

                </div>
            </div>
        </form>
    </div>

    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <script>
        function handleChange(value) {
            let html;
            if (value) {
                fetch('/category/child/' + value) //api for the get request
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(element => {
                            html += `<option value="${element.id}">${element.name}</option>`;
                        })
                        document.querySelector("#childs").innerHTML = (html);
                        console.log(value);
                        if (value) {
                            $('#submit_category').prop('disabled', false);
                            $('#childs').prop('disabled', false);
                        } else {
                            $('#submit_category').prop('disabled', true);
                            $('#childs').prop('disabled', true);
                        }
                    });
            } else {
                $('#submit_category').prop('disabled', true);
                $('#childs').prop('disabled', true);
            }
        }
        //.then(data =>  $(".formResponse").append(`<p>Response: ${data}`)
    </script>
@endsection
@section('scripts')
   <script>

const popup = document.querySelector(".popupBox");
const close = document.querySelector(".close");

// window.onload = function () {
//   setTimeout(() => {
//     popup.style.display = "block";
//   }, 3000);
// };

close.addEventListener("click", () => {
  popup.style.display = "none";
  $('#category_id').prop('disabled', false);

});
   </script>
@endsection
