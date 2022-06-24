
<div class="row" id="all_routes_body">
    <div class="col-12">
        <h5 class="mt-3">Region:  <span class="badge badge-lg badge-info">{{$project->region}}</span></h5>
    </div>
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Highway Name</th>
                    <th>No/Code/Section</th>
                    <th>Abbreviation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Scope1</th>
                    <th>Scope2</th>
                    <th>Scope3</th>
                    <th>All Scope</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($region_projects as $item)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$item->highway_name}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->abbreviation}}</td>
                        <td>{{$item->kilometer_from}}</td>
                        <td>{{$item->kilometer_to}}</td>
                        @php
                            $score_awards_totals = json_decode($item->score_awards_totals, true);
                        @endphp
                        @if ($score_awards_totals && count($score_awards_totals) > 0)                            
                            <td>{{number_format($score_awards_totals[0]['scope_1'], 4, '.', "")}}</td>
                            <td>{{number_format($score_awards_totals[0]['scope_2'], 4, '.', "")}}</td>
                            <td>{{number_format($score_awards_totals[0]['scope_3'], 4, '.', "")}}</td>
                            <td>{{number_format($score_awards_totals[0]['total'], 4, '.', "")}}</td>
                            @php
                                $footer_all_scope += $score_awards_totals[0]['total'];
                            @endphp
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="font-weight-bold">
                    <th colspan="9" class="text-right">Total</th>
                    <th>{{number_format($footer_all_scope, 4, '.', "")}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="col-12">
        <div id="allRoute_amChart" style="width:100%; height : 400px"></div>
    </div>
</div>