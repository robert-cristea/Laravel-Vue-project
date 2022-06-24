@extends('admin.layouts.layout-horizontal')

@section('content')
    <div class="main-content" id="ProjectNavigation">
        <div class="page-header">
            <form action="{{route('highwaylist.update',$data[0]->highwayname)}}" method="POST" class="form-group">
                @csrf
                @method('PUT')
                <input type="hidden" name="con" value="{{encrypt($data[0]->highwayname)}}">
                <input type="hidden" name="regions" value="{{encrypt($data[0]->region)}}">

                <table class="table" id="highwayTable">
                    <tr>
                        <td colspan="3">Concessionaire</td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <select class="form-control" required name="highwayname">
                                @foreach($concessionaire as $con)
                                    <option value="{{$con->id}}"  {{$con->id==$data[0]->highwayname ? 'selected':''}}>{{$con->name}}</option>
                                @endforeach

                            </select>
                        {{--                        <input type="text" required id="name" name="highwayname" value="New Project" class="form-control"></td>--}}
                    </tr>
                    <tr>
                        <td colspan="3">Region</td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <input required type='text' name="region"class='form-control' value="{{$data[0]['region']}}">

                    </tr>

                    @foreach($data as $highwayData)
                        <tr index="{{$highwayData->id}}" class="routes row{{$highwayData->id}}">
                            <td>Highway Name</td>
                            <td>No/Code/Section</td>
                            <td>Abbreviation</td>
                            <td>Chainage/Kilometer From</td>
                            <td>To</td>
                        </tr>
                        <tr class='row{{$highwayData->id}}'>
                        <td><input required type="text" name="route[]" class="form-control" value="{{$highwayData->routename}}"></td>
                        <td><input required type='text' name="code[]"class='form-control' value="{{$highwayData['code']}}"></td>
                        <td><input required type='text' name="abbreviation[]"  class='form-control' value="{{$highwayData['abbreviation']}}"></td>
                        <td><input required type="text" name="from[]" class="form-control" value="{{$highwayData['from']}}"></td>
                        <td><input required type="text" name="to[]" class="form-control" value="{{$highwayData['to']}} {{$highwayData['highway_name']}}"></td>
{{--                        <td><button type='button' class='btn btn-danger deleteBtn' data-id="{{$highwayData->id}}"><i class='fa fa-remove'></i>x</button></td>--}}

                            <input type="hidden" value="{{$highwayData->routename}}" name="highway[]">
                    </tr>
                    @endforeach
                </table>
                <input style="display:none" value="1" name="count" id="highway_count">
                <div class="w-100">
                    <div class="float-left">
                        <button type="button" id="addHightWayButton" class="btn btn-info" >Add New</button>
                    </div>
                    <div class="float-left" style="margin-left: 10px">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </div>
            </form>
            <br>
            <br>
            <br>

        </div>
    </div>
@stop