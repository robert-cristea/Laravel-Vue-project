@extends('admin.layouts.layout-horizontal')

@section('styles')
<style>
.invalid-feedback {
    display: block !important;
}
</style>
@endsection

@section('content')
<div class="main-content contact-page">
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Admin</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item"><a href="/admin/admins">List</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    @if($admin->ad_username!="")
                    <h6>Edit AD Admin</h6>
                    @else
                    <h6>Edit Admin</h6>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admins.update', $admin->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $admin->name) }}" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email', $admin->email) }}" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        @if($admin->ad_username=="")
                        <div class="form-group">
                            <label for="password">Password</label> 
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" class="form-control" placeholder="Department" value="{{ old('department', $admin->department) }}" />
                            @if ($errors->has('department'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" style="background-color: #4fc47f; color: white;" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection