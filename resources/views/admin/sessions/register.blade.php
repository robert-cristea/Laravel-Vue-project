@extends('admin.layouts.layout-login')

@section('scripts')
    <script src="/assets/admin/js/sessions/register.js"></script>
@stop

@section('content')
    <?php //echo "<pre>";print_r($errors);
        if(!empty($success)){
            echo '<p style="color:#11aa95;">'.$success.'</p>';
        }
    ?>
    <?php
        if(empty($success)){
            ?>
    @include('admin.sessions.partials.register-form')

    <?php
        }
    ?>
@stop
