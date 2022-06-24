@extends('admin.layouts.layout-horizontal')

@section('styles')
    <style>

    </style>
@stop

@section('content')
    <div class="main-content contact-page">
        <div class="page-header" style="margin-bottom: 0px">
            <h3 class="page-title">Assessment</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/projects">Assessment</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
            <ul class="add-assessment">
                <li>
                    @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin'|| Auth::user()->role=='concessionaire')
                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-fa icon-fa-plus"></i>
                    </a>
                    @endif
                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="post" action="{{ url('admin/projects') }}" id="newProjectForm">
                            @csrf
                            <a class="dropdown-item btn" onclick="window.newProjectForm.submit()"> <i class="icon-fa icon-fa-edit"></i> New Assessment</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        {{--        <div class="row"><div class="col-md-12 col-lg-6 col-xl-3"><a href="#" class="dashbox"><i class="icon-fa icon-fa-list-ul text-primary"></i> <span class="title">--}}
        {{--                      35--}}
        {{--                    </span> <span class="desc">--}}
        {{--                      Total Assessment--}}
        {{--                    </span></a></div> <div class="col-md-12 col-lg-6 col-xl-3"><a href="#" class="dashbox"><i class="icon-fa icon-fa-ellipsis-h text-success"></i> <span class="title">--}}
        {{--                      200--}}
        {{--                    </span> <span class="desc">--}}
        {{--                      Pending Approval--}}
        {{--                    </span></a></div> <div class="col-md-12 col-lg-6 col-xl-3"><a href="#" class="dashbox"><i class="icon-fa icon-fa-send text-danger"></i> <span class="title">--}}
        {{--                      100--}}
        {{--                    </span> <span class="desc">--}}
        {{--                      New Assessment--}}
        {{--                    </span></a></div> <div class="col-md-12 col-lg-6 col-xl-3"><a href="#" class="dashbox"><i class="icon-fa  text-info icon-fa-star-half-empty"></i> <span class="title">--}}
        {{--                      59--}}
        {{--                    </span> <span class="desc">--}}
        {{--                      Approve/Reject--}}
        {{--                    </span></a></div></div>--}}

        
        <div class="row">
            @include('admin.project.filter')
            <div class="col-12 table-responsive">
                <table id="contact-datatable" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">                        
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assessment Title</th>
                            @if(Auth::user()->role != 'concessionaire')
                                <th>Concessionaire</th>
                            @endif
                            <th>Certification/Award</th>
                            @if(Auth::user()->role != 'auditor')
                                <th>Assessor</th>
                            @endif
                            <th>Date Report</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //                        $status = array(
                            //                                            "0"=>array('title'=>'Save Assessment','class'=>'badge-warning'),
                            //                                            "1"=>array('title'=>'Pending Application','class'=>'badge-warning'),
                            //                                            "2"=>array('title'=>'Pending Result','class'=>'badge-warning'),
                            //                                            "3"=>array('title'=>'Approve','class'=>'badge-success'),
                            //                                            "4"=>array('title'=>'Draft','class'=>'badge-info'),
                            //                                            "5"=>array('title'=>'Reject','class'=>'badge-danger')
                            //
                            //
                            //
                            //                        );
                            $status =[
                                'Submit Assessment'=>'badge-success',
                                'Complete'=>'badge-success',
                                'Apply Assessment'=>'badge-success',
                                'Approve Assessment'=>'badge-success',
                                'Reject Assessment'=>'badge-danger',
                                'Save As Draft Assessment'=>'badge-warning',
                                'Save As Draft'=>'badge-warning',
                                ''
                            ]
                        ?>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ (($projects->currentPage() - 1 ) * $projects->perPage() ) + $loop->iteration }}</td>
                                <td><p>Highway Name : {{ $project->highway_name }}</p><p>Region Name : {{ $project->region }}</p><p>Chainage/Kilometer :{{ $project->kilometer_from }},{{ $project->kilometer_to }}</p></td>
                                @if(Auth::user()->role != 'concessionaire')
                                    <td>{{$project->concessionaire ?$project->concessionaire->name:'' }}</td>
                                @endif
                                <td>
                                    @if (@$project->status == 'Complete')
                                        {{ $project->award }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @if(Auth::user()->role != 'auditor')
                                    <td>
                                        @foreach ($project->evaluatorsList as $pro)
                                            {{@$pro->user->name}}
                                            <br>
                                        @endforeach
                                    </td>
                                @endif

                                <td>
                                    @if(Auth::user()->role == 'concessionaire')
                                        {{$project->created_at ? $project->created_at:'' }}
                                    @else
                                        {{ $project->created_at ? $project->created_at:'' }}
                                    @endif
                                </td>
                               
                                <td>
                                    @if($project->status=="Save As Draft" || $project->status=="Save As Draft Assessment")

                                    @elseif (key_exists(@$project->status, $status))
                                        <span class="badge {{$status[@$project->status]}}">{{@$project->status}}</span>
                                    @else
                                        Not In
                                    @endif
                                </td>

                                <td>
                                    <a href="/admin/projects/{{ $project->id }}" class="btn btn-default btn-xs">View</a>
                                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                        {{--                                    <a href="/admin/projects/{{ $project->id }}" class="btn btn-default btn-xs">Edit</a>--}}
                                        <form action="{{route('projects.destroy', $project->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default btn-xs" onclick="return window.confirm('Are you sure?')">Delete</button>
                                        </form>
                                        {{-- <a href="/admin/projects/{{ $project->id }}" class="btn btn-default btn-xs">Delete</a>--}}
                                    @endif
                                    {{-- <a href="/admin/projects/{{ $project->id }}" class="btn btn-default btn-xs">Download</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 clearfix">
                <div class="float-left" style="margin: 0;">
                    <p>Total <strong style="color: red">{{ $projects->total() }}</strong>
                        Items</p>
                </div>
                <div class="float-right" style="margin: 0;">
                    {!! $projects->appends([
                        'concessionaire_id' => $concessionaire_id,
                        'auditor_id' => $auditor_id,
                        'award' => $award,
                        'status' => @$_GET['status'],
                        'report_date' => $report_date,
                    ])->links() !!}
                </div>
            </div>
        </div>
    </div>
    
    @if(Request::get("submittion")=="success")
    <div id="success_popup" class="popup">
        <div class="popup-overlay"></div>
        <div class="popup-content">
            <i class="icon-fa icon-fa-check-circle-o"></i><br />
            <h4>Thank You!</h4>
            <p>The Assessment was submitted successfully<br />
            Date of Submittion: {{Request::get("submittion_date")}}
            <br />
            <br />
            <button class="close-popup" >Close</button>
        </div>
    </div>
    @endif
    
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_filter_reset").click(function(){
            $("#search_concessionaire").val('');
            $("#search_auditor").val('');
            $("#search_award").val('');
            $("#search_status").val('');
            $("#search_report_date").val('');
        });
        
    }) 
</script>
@endsection
