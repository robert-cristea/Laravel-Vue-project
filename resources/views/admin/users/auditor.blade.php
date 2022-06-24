@extends('admin.layouts.layout-horizontal')
<style>
    .parsley-errors-list {
        padding: 0px;
        list-style-type: none;
        padding-left: 12px;
        color: #ad5a5a;
    }

    .main-main-parent i {
        color: orange;
    }


</style>
@section('scripts')
    <script src="/assets/admin/js/users/auditor.js"></script>

    <script src="/assets/admin/js/plugins/Parsley/dist/parsley.js"></script>
@stop
@section('styles')
    <style>

    </style>
@stop

@section('content')
    <div class="main-content contact-page">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header"><h6>Add Assessor</h6></div>
                    <div class="card-body">
                        <form class="form_cons" id="form_cons" style="">
                            <div class="form_class">
                                {{ csrf_field() }}
                                <div class="form-group"><label for="inputFirstName"> Name</label> <input
                                            type="text" id="inputFirstName" placeholder=" Name"
                                            class="form-control" required name="name"
                                            value="<?php if (isset($data->user_meta->name)) {
                                                echo $data->user_meta->name;
                                            } ?>"></div>

                                <div class="form-group"><label for="inputFirstName"> Phone Number</label> <input
                                            type="text" id="inputFirstName" placeholder=" Phone Number"
                                            class="form-control" name="phone_number"
                                            value="<?php if (isset($data->user_meta->phone_number)) {
                                                echo $data->user_meta->phone_number;
                                            } ?>"></div>

                                <div class="form-group "><label for="inputFirstName"> Fax</label> <input
                                            type="text" id="inputFirstName" placeholder=" Fax"
                                            class="form-control" name="fax"
                                            value="<?php if (isset($data->user_meta->fax)) {
                                                echo $data->user_meta->fax;
                                            } ?>"></div>


                            </div>
                            <div class="form-group"><label for="exampleInputEmail">Email address</label> <input
                                        type="email" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter email" class="form-control" required name="email"
                                        value="<?php if (isset($data->user_meta->email)) {
                                            echo $data->user_meta->email;
                                        } ?>">

                            </div>
                            <?php if(isset($data->id)){
                            ?>
                            <input type="hidden" name="auditor_id" value="<?php echo $data->id; ?>">
                            <?php
                            } ?>
                            <div class="form-group"><label for="exampleInputPassword">Password</label> <input
                                        type="password" id="exampleInputPassword1=" placeholder="Password"
                                        class="form-control" name="password">
                            </div>
                            <div class="form-group "><label for="inputFirstName">Address</label>
                                <textarea
                                        placeholder="Address"
                                        class="form-control" name="address">
                                    <?php if(isset($data->user_meta->address)){echo $data->user_meta->address; } ?>
                            </textarea>
                            </div>


                            <div class="form-group"><label>Status</label>
                                <div>
                                    <div class="form-check form-check-inline"><input type="radio" name="status"
                                                                                     value="male" id="checkMale"
                                                                                     class="form-check-input"> <label
                                                for="checkMale" class="form-check-label">ASSIGNED</label></div>
                                    <div class="form-check form-check-inline"><input type="radio" name="status"
                                                                                     value="female" id="checkFemale"
                                                                                     class="form-check-input"> <label
                                                for="checkFemale" class="form-check-label">SUBMITTED</label></div>
                                </div>
                            </div>


                            <a id="sub_cons" style="background-color:#4fc47f; color:white;" class="btn btn-primary"
                               type="button">Add/Update</a>
                        </form>
                        <div class="loader_class" style="text-align: center;
font-size: 52px;
color: #4fc47f;display:none;"><i class="icon-fa icon-fa-adjust icon-fa-spin"></i></div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@stop
