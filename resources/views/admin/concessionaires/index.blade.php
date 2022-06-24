@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content contact-page">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Concessionaire</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/concessionaires">Concessionaire</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </div>
    
  
    <div class="clearfix"></div>
    <div class="row contact-box">
        <div class="contact-list">
        
        	@include('admin.concessionaires.filter')
            
            <div class="float-right" style="margin-bottom:10px;margin-right:10px;">
                <a href="{{ route('concessionaires.create') }}" class="btn btn-primary" style="background-color:#4fc47f;">Create New Concessionaire</a>
            </div>
            <table id="contact-datatable" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Person In Charge</th>
                        <th>Phone Number</th>
                        <th>Fax Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($concessionaires->count())
                    @foreach($concessionaires as $concessionaire)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><p style="font-weight:bold;">{{ $concessionaire->name }}</p>
                                <p>Login Count : {{ $concessionaire->login_count ? $concessionaire->login_count : 0 }}<br> Last Login {{ date('d M, Y', strtotime($concessionaire->updated_at)) }}</p>
                            </td>
                            <td>{{ $concessionaire->user_concessionaire ? $concessionaire->user_concessionaire->person_in_charge : '' }}</td>
                            <td>{{ $concessionaire->phone }}</td>
                            <td>{{ $concessionaire->fax }}</td>
                            <td>{{ $concessionaire->email }}</td>
                            <td>
                                <a class="btn btn-success btn-xs" href="{{ route('concessionaires.edit', $concessionaire->id) }}"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('concessionaires.destroy', $concessionaire->id) }}" onclick="event.preventDefault(); document.getElementById('form-{{ $concessionaire->id }}').submit();"><i class="icon-fa icon-fa-trash"></i> Delete</a>
                                <form id="form-{{ $concessionaire->id }}" action="{{ route('concessionaires.destroy', $concessionaire->id) }}" method="POST" style="display: none;">
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
                <p>Total <strong style="color: red">{{ $concessionaires->total() }}</strong>
                    Items</p>
            </div>
            <div class="float-right" style="margin: 0;">
                {!! $concessionaires->appends([
                    'name' => $name,
                    'filter_cols' => $filter_cols,
                    'pageLength' => $pageLength
                ])->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#pageLength").change(function(){
               $(this).closest('form').submit();
            });
        })
    </script>
@endsection
