<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0 , shrink-to-fit=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    <meta charset="utf-8">
    <title>OAN</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/fonts/line-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/slicknav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/color-switcher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/pagination.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/popup.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/cart.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/edit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/front/css/cart.css') }}">
</head>

<body class="main-body app sidebar-mini">
    @include('includes.front.header')
    <!-- main-content -->
    <div class="main-content app-content">
        @yield('content')
        {{-- @include('includes.front.footer') --}}
        @include('includes.front.footer-scripts')
        @yield('scripts')
    </div>
</body>

</html>
