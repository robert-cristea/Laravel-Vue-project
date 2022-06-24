@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content contact-page">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Assessor</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/auditors">Assessor</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </div>
    <div class="row contact-box">
        <div class="contact-list">
        
        	@include('admin.auditors.filter')
            
            <div class="float-right" style="margin-bottom:10px;margin-right:10px;">
                <a href="{{ route('auditors.adcreate') }}" class="btn btn-primary" style="background-color:#4fc47f;">Create AD Record Assessor</a>
            </div>

            <div class="float-right" style="margin-bottom:10px;margin-right:10px;">
                <a href="{{ route('auditors.create') }}" class="btn btn-primary" style="background-color:#4fc47f;">Create New Assessor</a>
            </div>
            <table id="contact-datatable" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Fax Number</th>
                        <th>Email</th>
                        <th>AD Username</th>
                        {{-- <th>Status</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($auditors->count())
                    @foreach($auditors as $auditor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><p style="font-weight:bold;">{{ $auditor->name }}</p>
                                <p>Login Count : {{ $auditor->login_count ? $auditor->login_count : 0 }}<br> Last Login {{ date('d M, Y', strtotime($auditor->updated_at)) }}</p>
                            </td>
                            <td>{{ $auditor->phone }}</td>
                            <td>{{ $auditor->fax }}</td>
                            <td>{{ $auditor->email }}</td>
                            <td>{{ $auditor->ad_username }}</td>
                            {{-- <td>{{ $auditor->user_auditor ? $auditor->user_auditor->status : '' }}</td> --}}
                            <td>
                                <a class="btn btn-success btn-xs" href="{{ route('auditors.edit', $auditor->id) }}"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('auditors.destroy', $auditor->id) }}" onclick="event.preventDefault(); document.getElementById('form-{{ $auditor->id }}').submit();"><i class="icon-fa icon-fa-trash"></i> Delete</a>
                                <form id="form-{{ $auditor->id }}" action="{{ route('auditors.destroy', $auditor->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No result founds.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-12 clearfix">
            <div class="float-left" style="margin: 0;">
                <p>Total <strong style="color: red">{{ $auditors->total() }}</strong>
                    Items</p>
            </div>
            <div class="float-right" style="margin: 0;">
                {!! $auditors->appends([
                    'name' => $name,
                    'filter_cols' => $filter_cols,
                    'pageLength' => $pageLength
                ])->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection