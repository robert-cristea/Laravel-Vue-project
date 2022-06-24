<div class="row">
    <!-- separator between navigation and project head -->
    <br>
</div>
<div class="row">
    <div class="col-6">
        <img data-action="zoom" class="img-center img-fluid" src="{{ $project->image }}">
        @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin' ||Auth::user()->role=='concessionaire')
            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row center mt-3">
                    <div class="col-md-6">
                        <input data-toggle="tooltip" data-placement="top" title="Upload Image and maximum size is 2M" type="file" name="image" class="form-control">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </div>
                    
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload Image</button>
                    </div>
                    <div class="col-md-12">
                        <p>Only upload files with the extension: jpeg, png, jpg, gif, svg and size under 2MB</p>
                    </div>
                </div>
            </form>
        @endif
        
        @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin' ||Auth::user()->role=='concessionaire')
            <form action="{{ route('pdf.upload_work_program.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row center mt-3">
                    <div class="col-md-6">
                        <input data-toggle="tooltip" data-placement="top" title="Upload Work Program and maximum size is 10M" type="file" name="pdf" class="form-control">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </div>
                    
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload Work Program (PDF Only)</button>
                    </div>
                    <div class="col-md-12">
                        <p>Only upload files with the extension: pdf and size under 10 MB</p>
                    </div>
                </div>
            </form>
        @endif

        @if(!empty($project->work_program))
            <a href="{{ $project->work_program }}" class="btn btn-primary mt-3" target="_blank">Download work program</a>
        @endif
        @if ($pdf_file = Session::get('pdf'))
            <p style="color:#000;">{{ $pdf_file }}</p>
        @endif
    </div>

    <div class="col-6">

        <form action="/admin/projects" method="POST" class="form-group">
            @csrf
            <input type="hidden" name="id" value="{{ $project->id }}">
{{--            @if(Auth::user()->role!='auditor')--}}
        <table class="table table-sm">
            <div style="display:none" id="register_variable">{{ json_encode($highwaylist) }}</div>
            <tr>
                <td>Concessionaire Name</td>
                <td colspan="2">
                    @if(Auth::user()->role=='concessionaire')
                        <input type="text" class="form-control" disabled value="{{Auth::user()->name}}">
                     @else
                        <select id="concessionaire_register"  {{Auth::user()->role=='auditor' ?'disabled':''}} name="concessionaire_name" class="form-control" value="default">
                            <option readonly value="default">Select Concessionaire Name</option>
                            @foreach($concessionaire as $con)
                                <option value="{{$con->highwayname}}" {{$con->highwayname==$project->concessionaire_name?'selected':''}}>{{$con->user->name}}</option>
                            @endforeach
                        </select>
                    @endif

                </td>
                <!-- <td colspan="2"><input type="text" id="name" name="name" value="{{ $project['name'] }}" class="form-control"></td> -->
            </tr>
            <tr>
                <td>Region </td>
                <td colspan="2">

                    <select id="region_register" name="region" class="form-control" {{Auth::user()->role=='auditor' ?'disabled':''}}>
                        <option value="">Select Region Name</option>
                        @if(Auth::user()->role=='concessionaire')
                            @php
                            $regions =\App\HighwayList::where('highwayname',Auth::user()->id)->get();
                            $exist = [];

                             foreach($regions as $reg){
                              if (count($exist)==0){
                              array_push($exist,$reg->region);
                              }
                              else{
                               if(!in_array($reg->region,$exist)){

                                    array_push($exist,$reg->region);
                                   }
                              }

                             }

                            @endphp

                                @foreach($exist as $reg)
                                <option value="{{$reg}}" {{!empty($project->region)?$project->region==$reg?'selected':'':''}}>{{$reg}}</option>
                                @endforeach
                        @else
                            @php
                                $regions =\App\HighwayList::where('highwayname',$project->concessionaire_name)->get();

                                $exist = [];

                                 foreach($regions as $reg){
                                  if (count($exist)==0){
                                  array_push($exist,$reg->region);
                                  }
                                  else{
                                   if(!in_array($reg->region,$exist)){

                                        array_push($exist,$reg->region);
                                       }
                                  }

                                 }

                            @endphp
                            @foreach($exist as $reg)
                                <option value="{{$reg}}" {{!empty($project->region)?$project->region==$reg?'selected':'':''}}>{{$reg}}</option>
                            @endforeach
{{--                        @if(!empty($project->region))--}}
{{--                            <option value="{{$project->region}}" selected>{{$project->region}}</option>--}}
{{--                        @endif--}}

                    </select>
                    @endif


                </td>
            <!-- <td colspan="2"><input type="text" id="name" name="route" value="{{ $project['route'] }}" class="form-control"></td> -->
            </tr>
            <tr>
                <td>Highway Name</td>
                <td colspan="2">
                    <select id="highway_register" name="highway_name" class="form-control" {{Auth::user()->role=='auditor' ?'disabled':''}}>
                        <option value="">Select Region Name</option>
                        @php
                            $highway =\App\HighwayList::where('deleted_at',NULL)
                            ->where('highwayname',$project->concessionaire_name)
                            ->where('region',$project->region)
                            ->get();


                        @endphp
                        @foreach($highway as $high)
                            <option value="{{$high->routename}}" {{!empty($project->highway_name)?$project->highway_name==$high->routename?'selected':'':''}} >{{$high->routename}}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            @php
                $allData =\App\HighwayList::where('highwayname',$project->concessionaire_name)
                ->where('region',$project->region)
                ->where('routename',$project->highway_name)
                ->first();


            @endphp

            <tr>
                <td>No/Code/Section</td>
                <td colspan="2"><input type="text" readonly id="code" name="code" value="{{!empty($project->highway_name)?@$allData->code:''}}" class="form-control"  ></td>
            </tr>
            <tr>
                <td>Abbreviation</td>
                <td colspan="2"><input type="text" readonly id="abbreviation" name="abbreviation" value="{{!empty($project->abbreviation)?@$allData->abbreviation:''}}" class="form-control"  ></td>
            </tr>
            <tr>
                <td rowspan="2">Chainage/Kilometer</td>
                <td>From</td>
                <td>To</td>
            </tr>
            <tr>
                <td><input type="text" readonly id="from_register" name="kilometer_from" value="{{ !empty($project->kilometer_from) ? @$allData->from:'' }}" class="form-control" ></td>
                <td><input type="text" readonly id="to_register" name="kilometer_to" value="{{ !empty($project->kilometer_to)? @$allData->to:'' }}" class="form-control"></td>
            </tr>

            <tr>
                <td>Highway Length (KM) </td>
                <td colspan="2"><input type="text" id="name" name="length" value="{{ $project['length'] }}" class="form-control"  {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Planning Highway (%)</td>
                <td colspan="2"><input type="text" id="name" name="planning_percentage" value="{{ $project['planning_percentage'] }}" class="form-control" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Construction Highway (%)</td>
                <td colspan="2"><input type="text" id="name" name="construction_percentage" value="{{ $project['construction_percentage'] }}" class="form-control" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Existing Highway (%)</td>
                <td colspan="2"><input type="text" id="name" name="existing_percentage" value="{{ $project['existing_percentage'] }}" class="form-control" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Construction Start Date</td>
                <td colspan="2"><input type="text" id="name" data-format="dd MMMM yyyy" data-toggle="datepicker" name="construction_start" value="{{ $project['construction_start'] }}" class="form-control datetimepicker" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Const. Completion Date</td>
                <td colspan="2"><input type="text" id="name" data-format="dd MMMM yyyy" data-toggle="datepicker" name="construction_completion" value="{{ $project['construction_completion'] }}" class="form-control datetimepicker" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Open to Public Date</td>
                <td colspan="2"><input type="text" id="name" data-format="dd MMMM yyyy" data-toggle="datepicker" name="open_to_public" value="{{ $project['open_to_public'] }}" class="form-control datetimepicker" {{Auth::user()->role=='auditor' ?'readonly':''}}></td>
            </tr>
            <tr>
                <td>Report Period</td>
                <td>
                    <input type="text" id="report_period" name="report_period" value="{{ $project['report_period'] }}" class="form-control" {{Auth::user()->role=='auditor' ?'readonly':''}}>
                </td>
                <td>year</td>
            </tr>
            <tr>
                <td>Year of assessment</td>
                <td>
                    <input type="text" id="assessment_date" name="assessment_year" value="{{ $project['assessment_year'] }}" class="form-control" {{Auth::user()->role=='auditor' ?'readonly':''}}>
                </td>
                <td></td>
            </tr>
            @if(!empty($project->assessment_years))
                @foreach($project->assessment_years as $key => $assessment_year)
                    @if($assessment_year == $project['assessment_year'])
                        @continue
                    @endif
                    <tr>
                        <td>Year of assessment</td>
                        <td>
                            <input id="assessment_years[]" name="assessment_years[]" type="text" class="form-control" value="{{ $assessment_year }}" {{Auth::user()->role=='auditor' ?'readonly':''}}>
                        </td>
                        <td>
                            @if(Auth::user()->isAdmin())
                                <button type="button" class="btn btn-warning" onclick="deleteAssessmentYear({{ $key }})">
                                    Delete
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin' ||Auth::user()->role=='concessionaire')
            <tr id="addAssessmentYearButton">
                <td colspan="3">
                    <button type="button" class="btn btn-primary" onclick="addAssessmentYear()">
                        Add New Assessment Year
                    </button>
                </td>
            </tr>
                @endif
        </table>
{{--            @endif--}}

        <evaluators 
            auditor-route={{route('getAuditors')}} 
            project-id={{ $project->id }} 
            route={{  route('assessmentStatus') }} 
            role={{Auth::user()->role}}
            status-val={{$project->status_val}}
        ></evaluators >

        </form>
    </div>
</div>
