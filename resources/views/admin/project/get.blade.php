@extends('admin.layouts.layout-horizontal')

@section('styles')
    {{-- <style type="text/css">
        .btn {
            width: 100%;
            text-align: center;
        }
    </style> --}}
    @include("admin.project.partials.project_js")
@endsection

@section('content')

    {{-- All Routes --}}
    @php
        $region_projects = \App\Project::where('region', $project->region)->get();
        $footer_all_scope = 0;
        $chart_graph_data = [];
        $chart_scope_data = [
            ['scope' => 'Scope 1'],
            ['scope' => 'Scope 2'],
            ['scope' => 'Scope 3'],
        ];
        foreach ($region_projects as $item) {
            $score_awards_totals = json_decode($item->score_awards_totals, true);
            $item_slug = str_slug($item->highway_name);
            $chart_scope_data[0][$item_slug] = $score_awards_totals && count($score_awards_totals) > 0 ? number_format($score_awards_totals[0]['scope_1'], 4, '.', "") : 0;
            $chart_scope_data[1][$item_slug] = $score_awards_totals && count($score_awards_totals) > 0 ? number_format($score_awards_totals[0]['scope_2'], 4, '.', "") : 0;
            $chart_scope_data[2][$item_slug] = $score_awards_totals && count($score_awards_totals) > 0 ? number_format($score_awards_totals[0]['scope_3'], 4, '.', "") : 0;
            
            $graph_data = array(
                'balloonText' => $item->highway_name.': [[value]]',
                'fillAlphas' => 0.8,
                'id' => $item_slug,
                'lineAlpha' => 0.2,
                'title' => $item->highway_name,
                'type' => 'column',
                'valueField' => $item_slug
            );

            array_push($chart_graph_data, $graph_data);
        }
    @endphp

    {{-- End All routes --}}


    <div class="main-content" id="ProjectNavigation">
        <div class="page-header" style="margin-bottom: 0px">
            <h3 class="page-title">Assessment Report Carbon Footprint Calculator For MyGHI</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/projects">Project List</a></li>
                <li class="breadcrumb-item active">{{ $project->name }}</li>
            </ol>
        </div>
        <year-selector
            years="project_data.assessment_years"
        ></year-selector>
        <div class="row tabs tabs-default w-100">
            <ul role="tablist" class="nav nav-tabs">
                <li class="nav-item">
                    <a data-toggle="tab" href="#home" role="tab" class="nav-link active show" aria-selected="true" id="home_navigation_tab">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#guideline" role="tab" class="nav-link" aria-selected="false" id="guideline_navigation_tab">
                        Guideline
                    </a>
                </li>
                <li class="nav-item" id="main-navigation-1">
                    <a data-toggle="tab" href="#planning_design" role="tab" class="nav-link" aria-selected="false" id="planning_navigation_tab">
                        Planning & Design Stage
                    </a>
                </li>
                <li class="nav-item" id="main-navigation-2">
                    <a data-toggle="tab" href="#construction" role="tab" class="nav-link" aria-selected="false">
                        Construction Stage
                    </a>
                </li>
                <li class="nav-item" id="main-navigation-3">
                    <a data-toggle="tab" href="#operation_maintenance" role="tab" class="nav-link"
                                        aria-selected="false">Operation & Maintenance Stage</a></li>
                <li class="nav-item" id="main-navigation-5">
                    <a data-toggle="tab" href="#summary" role="tab" class="nav-link"
                                        aria-selected="false">Summary Report</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#all_routes" role="tab" class="nav-link" aria-selected="false">
                        All Route
                    </a>
                </li>
                @if(!empty($project->assessment_years))
                <li class="nav-item">
                    <a data-toggle="tab" href="#score_awards" role="tab" class="nav-link" aria-selected="false">
                        Score & Awards
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a data-toggle="tab" href="#emission_factor" role="tab" class="nav-link" aria-selected="false">
                        Emission Factor
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#notes" role="tab" class="nav-link"
                                        aria-selected="false">Notes</a></li>
            </ul>
        </div>
        <div class="tab-content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="home" role="tabpanel" class="tab-pane active show">
                @include("admin.project.partials.home")
            </div>
            <div id="guideline" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.guideline")
            </div>
            <div id="planning_design" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.planning_design")
            </div>
            <div id="construction" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.construction")
            </div>
            <div id="operation_maintenance" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.operation_maintenance")
            </div>
            <div id="summary" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.summary")
            </div>
            <div id="all_routes" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.all_routes")
            </div>
            <div id="score_awards" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.score_awards")
            </div>
            <div id="emission_factor" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.emission_factor")
            </div>
            <div id="notes" role="tabpanel" class="tab-pane">
                @include("admin.project.partials.notes")
            </div>
        </div>
        <div class="d-none">
            <!-- upload pdf -->
            <form id="upload_pdf" action="{{ route('pdf.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row center">
                    <div class="col-md-6">
                        <input type="file" id="pdf_to_upload" name="pdf_to_upload" class="form-control" value="" onchange="uploadPdf($('#section').val())">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" id="pdf_assessment_year" name="pdf_assessment_year" value="">
                        <input type="hidden" id="pdf_section" name="pdf_section" value="">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/admin/js/pages/bar-ratings.js')}}"></script>

    <script type="text/javascript">
        var csrf_token = "{{ csrf_token() }}";
        function deleteNote(id) {
            var xhr1 = new XMLHttpRequest();
            xhr1.open('DELETE', "/admin/note/"+id, true);
            xhr1.setRequestHeader('X-CSRF-TOKEN', csrf_token);
            xhr1.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {
                    window.location.reload();
                }
            }
            xhr1.send("_token="+csrf_token);
        }
    </script>

    {{-- All Route Chart --}}

    <script>
        AmCharts.makeChart('allRoute_amChart', {
            'type': 'serial',
            'categoryField': 'scope',
            'theme': 'light',
            'rotate': true,
            'startDuration': 1,
            'categoryAxis': {
            'gridPosition': 'start',
            'position': 'left'
            },
            'trendLines': [],
            'graphs': {!! json_encode($chart_graph_data) !!},
            'guides': [],
            'valueAxes': [
            {
                'id': 'ValueAxis-1',
                'position': 'top',
                'axisAlpha': 0
            }
            ],
            'allLabels': [],
            'balloon': {},
            'titles': [],
            'dataProvider': {!! json_encode($chart_scope_data) !!},
            'export': {
            'enabled': false
            }
        });

    </script>

@endsection