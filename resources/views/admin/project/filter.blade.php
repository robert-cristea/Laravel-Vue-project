@php
    $concessionaires = \App\User::where('role', 'concessionaire')->orderBy('name' , 'asc')->get();
    
    
    $auditors = \App\User::where('role', 'auditor')->orderBy('name' , 'asc')->get();
    if (Auth::user()->role == 'concessionaire' && !empty($projects)):
        $arrayUser = [];
        foreach ($projects as $project):
            foreach ($project->evaluatorsList as $pro):
                array_push($arrayUser, $pro->evaluator_id);
           endforeach;
        endforeach;
        if(!empty($arrayUser)):
            $auditors = \App\User::where('role', 'auditor')->whereIn('id', $arrayUser)->orderBy('name' , 'asc')->get();
        endif;
    endif;
    $status_array = ['Submit Assessment', 'Complete', 'Apply Assessment', 'Approve Assessment', 'Reject Assessment'];
    asort($status_array, SORT_STRING);
    $report_dates = \App\Project::whereNotNull('open_to_public')->distinct()->orderBy('open_to_public' , 'asc')->pluck('open_to_public')->toArray();    
@endphp
<div class="col-12 top-filter">
    <form id="filter_project" action="" class="form-inline">
        {{-- @csrf --}}
        @if(Auth::user()->role != 'concessionaire')
            <select name="concessionaire_id" id="search_concessionaire" class="form-control form-control-sm mb-2">
                <option value="" hidden>Concessionaire</option>
                @foreach ($concessionaires as $item)
                    <option value="{{$item->id}}" @if($concessionaire_id == $item->id) selected @endif>{{$item->name}}</option>
                @endforeach                        
            </select>
        @endif
        @if(Auth::user()->role != 'auditor')
            <select name="auditor_id" id="search_auditor" class="form-control form-control-sm ml-2 mb-2">
                <option value="" hidden>Assessor</option>
                @foreach ($auditors as $item)
                    <option value="{{$item->id}}" @if($auditor_id == $item->id) selected @endif>{{$item->name}}</option>
                @endforeach                        
            </select>
        @endif
        <select name="award" id="search_award" class="form-control form-control-sm ml-2 mb-2">
            <option value="" @if($award == '') selected @endif hidden >Certification/Award</option>
            <option value="Certified" @if($award == 'Certified') selected @endif>Certified</option>
            <option value="Gold" @if($award == 'Gold') selected @endif>Gold</option>
            <option value="Platinum" @if($award == 'Platinum') selected @endif>Platinum</option> 
            <!-- <option value="Bronze" @if($award == 'Bronze') selected @endif>Bronze</option> -->
            <option value="Silver" @if($award == 'Silver') selected @endif>Silver</option>
            
            
        </select>
        <select name="status" id="search_status" class="form-control form-control-sm ml-2 mb-2">
            <option value="" hidden>Status</option>
            @foreach ($status_array as $item)
                <option value="{{$item}}" @if($status == $item) selected @endif>{{$item}}</option>
            @endforeach                              
        </select>
        <select name="report_date" id="search_report_date" class="form-control form-control-sm ml-2 mb-2">
            <option value="" hidden>Report Date</option>
            @foreach ($report_dates as $item)
                <option value="{{$item}}" @if($report_date == $item) selected @endif>{{$item}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-primary ml-2 mb-2">Search</button>
        <a href="{{ URL::to('/admin/projects') }}" class="btn btn-sm btn-danger ml-2 mb-2">Reset</a>
        <div  class="float-right" style="margin-bottom:10px;margin-right:10px; display: flex; margin-left:3px; right: 0; position: absolute;">
            <label>Show</label>
            <select name="pageLength" id="pageLength" class="form-control-sm ml-2 mb-2">
                <option   @if ($pageLength == 10) selected @endif value="10" >10</option>
                <option @if ($pageLength == 30) selected @endif value="30">30</option>
                <option @if ($pageLength == 50) selected @endif value="50">50</option>                                
            </select>
            <label>&nbsp;entries</label>
        </div>
    </form>
</div>

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#pageLength").change(function(){
               $(this).closest('form').submit();
            });
        })
    </script>
@endsection