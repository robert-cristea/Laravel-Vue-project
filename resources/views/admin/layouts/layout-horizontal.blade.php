<!DOCTYPE html>
<html>
    <head>
        <title>Projects</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <script src="{{asset('/assets/admin/js/core/pace.js')}}"></script>
        <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/assets/admin/css/datepicker.css') }}" rel="stylesheet" type="text/css">
        
        
        
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('admin.layouts.partials.favicons')
        @yield('styles')
    </head>
    <body class="layout-horizontal skin-default skin-tyrell">

        <div id="app" class="site-wrapper">
            @include('admin.layouts.partials.laraspace-notifs')
            @include('admin.layouts.partials.header')
            <div class="mobile-menu-overlay"></div>
            @include('admin.layouts.partials.header-bottom')
            @yield('content')
            @include('admin.layouts.partials.footer')
            @include('admin.layouts.partials.skintools')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
        <script src="{{asset('/assets/admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/assets/admin/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('/assets/admin/js/demo/skintools.js')}}"></script>
        <script src="{{asset('/assets/admin/js/demo/myscript.js?ver=').time()}}"></script>
        <script src="{{mix('/assets/admin/js/core/app.js')}}"></script>
        
        <script>
            $(function() {
               
                $('[data-toggle="datepicker"]').datepicker({
                    autoclose: true,
                    format: 'dd MM yyyy'
                });
                $('[data-toggle="datepicker-month"]').datepicker({
                    autoclose: true,
                    startView: 1,
                    minViewMode: 1,
                    format: 'MM yyyy'
                });
            });

            //showing success message popup for "Submit Assessment" at Assessment listing page
            @if(Request::get("submittion")=="success")
            $(window).on('load',function(){
                $('#success_popup').show().find('.popup-content').addClass('fadeIn');
            });
            $("#success_popup .close-popup").on('click',function(){
                
                $("#success_popup").find('.popup-content').removeClass('fadeIn').addClass('fadeOut');
                
                setTimeout(function(){
                    $("#success_popup").hide();
                    $("#success_popup").find('.popup-content').removeClass('fadeOut') 
                }, 500);
            })
            @endif
            
        </script>
        @yield('scripts')
    </body>
</html>
