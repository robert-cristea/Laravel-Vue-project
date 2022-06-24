@extends('admin.layouts.layout-horizontal')

@section('scripts')
    <script src="/assets/admin/js/pages/concessionaires.js"></script>
@stop
@section('styles')
    <style>

    </style>
@stop

@section('content')
    <div class="main-content contact-page">
        <?php //echo "<pre>";print_r($cons);echo "</pre>"; ?>
        <div class="row contact-box">
            <div class="contact-list">
                <div class="float-right" style="margin-bottom:10px;margin-right:10px;"><a style="background-color:#4fc47f;" type="button" href="/admin/concession" onclick="" class="btn btn-primary">Create New Concessionaire</a></div>
                <table id="contact-datatable" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> Name</th>
                        <th>Person In Charge</th>
                        <th>Phone Number</th>
                        <th>Fax Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>


                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($cons as $con){
                        ?>
                        <tr>

                            <td><?php echo $con->id; ?></td>
                            <td><p style="font-weight:bold;"><?php echo $con->user_meta->name; ?></p>
                                <p>Login Count : 6<br> Last Login 20 Sep 2020</p>
                            </td>
                            <td><?php echo $con->person_charge->name; ?></td>
                            <td><?php echo $con->user_meta->phone_number; ?></td>
                            <td>
                                <?php echo $con->user_meta->fax; ?>
                            </td>

                            <td><?php echo $con->user_meta->email; ?></td>
                            <td>
                                <button class="btn btn-primary btn-xs">
                                    Active
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-info btn-xs"><i class="icon-fa icon-fa-envelope"></i> View
                                </button>
                                <a class="btn btn-success btn-xs" href="/admin/concession/<?php echo $con->id; ?>"><i class="icon-fa icon-fa-user"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-xs" href="/admin/delete-concession/<?php echo $con->id ?>" onclick="return confirm('Are you sure to delete?')"><i class="icon-fa icon-fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                                }
                         ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
