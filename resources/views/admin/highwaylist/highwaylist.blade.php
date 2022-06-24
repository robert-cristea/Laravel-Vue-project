@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content" id="ProjectNavigation">
    <div class="page-header" style="margin-bottom: 0px">
        <h3 class="page-title">Highway</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/highwaylist">Highway</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </div>
    <div class="page-header">
        <form action="/admin/highwaylist" method="POST" class="form-group">
            @csrf
            <table class="table" id="highwayTable">
                <tr>
                    <td colspan="3">Concessionaire</td>
                </tr>
                <tr>
                    <td colspan="3">

                       <select class="form-control" required name="highwayname">
                           @foreach($concessionaire as $con)
                               <option value="{{$con->id}}">{{$con->name}}</option>
                           @endforeach
                       </select>
{{--                        <input type="text" required id="name" name="highwayname" value="New Project" class="form-control"></td>--}}
                </tr>
                <tr>
                    <td colspan="3">Region</td>
                </tr>
                <tr>
                    <td colspan="3">

                        <input required type='text' name="region"class='form-control'>

                </tr>
                <tr index="1" class="routes">
                    <td>Highway Name</td>
                    <td>No/Code/Section</td>
                    <td>Abbreviation</td>
                    <td>Chainage/Kilometer From</td>
                    <td>To</td>
                </tr>
                <tr>
                    <td><input required type="text" name="route[]" class="form-control"></td>
                    <td><input required type='text' name="code[]"class='form-control'></td>
                    <td><input required type='text' name="abbreviation[]"  class='form-control'></td>
                    <td><input required type="text" name="from[]" class="form-control"></td>
                    <td><input required type="text" name="to[]" class="form-control"></td>


                </tr>
            </table>
            <input style="display:none" value="1" name="count" id="highway_count">
            <div class="w-100">
                <div class="float-left">
                    <button type="button" id="addHightWayButton" class="btn btn-info" >Add New</button>
                </div>
                <div class="float-left" style="margin-left: 10px">
                    <input type="submit" class="btn btn-success" value="Save">
                </div>
            </div>
        </form>
        <br>
        <br>
        <br>
        <div class="row">
            @include('admin.highwaylist.filter')
        </div>
        <br>
        <table class="table" id="highwayTable">
            <tr>
                <td colspan="2">Concessionaire</td>
                <td colspan="2">Region</td>
                <td colspan="2">Highway Name</td>
                <td colspan="2">No/Code/Section</td>
                <td colspan="2">Abbreviation</td>
                <td colspan="1">From(KM)</td>
                <td colspan="1">To(KM)</td>
            </tr>

            @if ($error != false)

                <script>alert("Already Exist")</script>
            @endif
            @for ($i = 0 ; $i < count($data); $i ++)
                <tr>
                    @if ($i == 0)
                        <td colspan="2">{{$data[$i]->user->name}}</td>
                    @elseif ($data[$i]->user->name == $data[$i-1]->user->name)
                        <td colspan="2"></td>
                    @else  
                        <td colspan="2">{{$data[$i]->user->name}}</td>
                    @endif
                    @if ($i == 0)
                            <td colspan="2">{{$data[$i]->region}}</td>
                        @elseif ($data[$i]->region == $data[$i-1]->region)
                            <td colspan="2"></td>
                        @else
                            <td colspan="2">{{$data[$i]->region}}</td>
                        @endif
{{--                        <td colspan="2">{{$data[$i]->region}}</td>--}}
                        <td colspan="2">{{$data[$i]->routename}}</td>
                        <td colspan="2">{{$data[$i]->code}}</td>
                        <td colspan="2">{{$data[$i]->abbreviation}}</td>
                        <td colspan="1">{{$data[$i]->from}}</td>
                        <td colspan="1">{{$data[$i]->to}}</td>
                        <td>
                            <form action="{{route('highway-edit')}}" method="POST">
                                @csrf
                                <input type="hidden" name="con" value="{{encrypt($data[$i]->highwayname)}}">
                                <input type="hidden" name="region" value="{{encrypt($data[$i]->region)}}">

                                <button type="submit" class="btn btn-success"><i class="icon-fa icon-fa-user"></i>Edit</button>
                            </form>
{{--                            <a href="{{route('highwaylist.edit',$data[$i]->id)}}" class="btn btn-success"><i class="icon-fa icon-fa-user"></i>Edit</a></td>--}}
                        <td>
                            <form action="{{route('highwaylist.destroy',$data[$i]->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i>Delete</button>
                            </form></td>
{{--                        <td><a href="{{route('')}}" class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i>Delete</a></td>--}}

                </tr>
            @endfor
        </table>
    </div>
</div>
@stop