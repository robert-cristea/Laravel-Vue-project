<!DOCTYPE html>
<html>
<head>
    <title>Laraspace - Laravel Admin</title>
    <script src="{{asset('/assets/admin/js/core/pace.js')}}"></script>
    <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        .colr {
            color:  #4fc47f !important;
        }
        .bgcolr {
            background:  #4fc47f !important;
        }
    </style>
    @include('admin.layouts.partials.favicons')
</head>
<body id="app" class="page-error-404">
    <header class="site-header bgcolr">
        <img src="<?php echo e(asset('/assets/admin/img/myghi_logo.png')); ?>" id="logo-desk" alt="MyGHI"
             class="d-none d-md-inline" style="height: 45px; padding-top: 0px; margin-top: -8px;">
        <h3 class="d-none d-md-inline" style="margin-left: 15px; color: white;">MYGHI</h3> <img
                src="<?php echo e(asset('/assets/admin/img/myghi_logo.png')); ?>" id="logo-mobile" alt="MyGHI"
                class="d-md-none"><span class="d-md-none">MYGHI</span>
<!--        <a href="#" class="brand-main">
            <img src="{{asset('/assets/admin/img/logo-desk.png')}}" id="logo-desk" alt="Laraspace Logo" class="d-none d-md-inline ">
            <img src="{{asset('/assets/admin/img/logo-mobile.png')}}" id="logo-mobile" alt="Laraspace Logo" class="d-md-none">
        </a>-->
        <a href="#" class="nav-toggle">
            <div class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </div>
        </a>
    </header>
    <div class="error-box">
        <div class="row">
            <div class="col-sm-12 text-sm-center">
                <h1 class="colr" >404</h1>
                <h5 class="colr">Whoops! You got Lost!</h5>
                <a class="btn btn-lg bg-yellodw bgcolr" href="/"> <i class="icon-fa icon-fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
    </div>
    <script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
    @yield('scripts')
</body>
</html>