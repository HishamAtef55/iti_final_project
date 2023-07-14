@extends('layouts.front.master')


@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Ad Details</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Ad Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <p><iframe src="{{ $link }}" width="680" height="500" frameborder="0"></iframe></p>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $('document').ready(function() {
            $('#country').change(function() {
                let idcountry = this.value;

                $('#city_id').html('');

                $.ajax({
                    url: '/api/fetch/state',
                    type: "POST",
                    datatype: 'json',
                    data: {
                        country_id: idcountry,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#city_id').html('<option  value="">Select city</option>')
                        $.each(response.states, function(index, val) {
                            $('#city_id').prop('disabled', false).append(
                                '<option  value="' + val.id + '">' +
                                val.name +
                                '</option>')
                        });
                        $('#city-id').html('<option value="">Select City</option>');

                    }
                })
            });

        })
    </script>
@endsection
