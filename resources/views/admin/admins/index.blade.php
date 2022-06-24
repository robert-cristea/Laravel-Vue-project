@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content contact-page">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Admin</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/admins">Admin</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </div>
    <div class="row contact-box">
        <div class="contact-list">
            @include('admin.admins.filter')
       
            <div class="float-right" style="margin-bottom:10px;margin-right:10px;">
                <a href="{{ route('admins.adcreate') }}" class="btn btn-primary" style="background-color:#4fc47f;">Create AD Record Admin</a>
            </div>
            <div class="float-right" style="margin-bottom:10px;margin-right:10px;">
                <a href="{{ route('admins.create') }}" class="btn btn-primary" style="background-color:#4fc47f;">Create New Admin</a>
            </div>
            
            <table id="contact-datatable" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>AD Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($admins->count())
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><p style="font-weight:bold;">{{ $admin->name }}</p>
                                <p>Login Count : {{ $admin->login_count ? $admin->login_count : 0 }}<br> Last Login {{ date('d M, Y', strtotime($admin->updated_at)) }}</p>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->department }}</td>
                            <td>{{ $admin->ad_username }}</td>
                            <td>
                                <a class="btn btn-success btn-xs" href="{{ route('admins.edit', $admin->id) }}"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('admins.destroy', $admin->id) }}" onclick="event.preventDefault(); document.getElementById('form-{{ $admin->id }}').submit();"><i class="icon-fa icon-fa-trash"></i> Delete</a>
                                <form id="form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No result founds.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-12 clearfix">
            <div class="float-left" style="margin: 0;">
                <p>Total <strong style="color: red">{{ $admins->total() }}</strong>
                    Items</p>
            </div>
            <div class="float-right" style="margin: 0;">
                {!! $admins->appends([
                    'name' => $name,
                    'filter_cols' => $filter_cols,
                    'pageLength' => $pageLength
                ])->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection