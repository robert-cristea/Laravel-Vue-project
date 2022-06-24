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
            <li class="breadcrumb-item active">Add New</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h6>Add AD Record Admin</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admins.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}" />
                                    <span class="invalid-feedback" role="alert" id="username_err">
                                        <strong ></strong>
                                    </span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" style="background-color: #4fc47f; color: white;" class="btn btn-primary" onClick="getAdUser()">Search AD Record</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" class="form-control" placeholder="Department" value="{{ old('department') }}" />
                            @if ($errors->has('department'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="hidden" name="password" value="aduser@1234" />
                        <button type="submit" style="background-color: #4fc47f; color: white;" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
var csrf_token = "{{ csrf_token() }}";
function getAdUser()
{
    $("#username_err strong").html("");
    $.ajax({
      url: "{{ route('admins.adsearch') }}",
      type: 'GET',
      data: "username= "+$('#username').val(),
      headers: {
        "X-CSRF-TOKEN": csrf_token,
      },
      dataType: 'json',
      success: function(data){

        var response = JSON.parse(JSON.stringify(data));
        if(response.result){
            $("#name").val(response.user.givenname[0]);
            $("#email").val(response.user.mail[0]);
        }else{
            $("#username_err strong").html(response.error);
        }
        
      },
    });
}
</script>
@endsection