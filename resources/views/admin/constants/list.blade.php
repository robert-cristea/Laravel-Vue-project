@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content" id="ProjectNavigation">
    <div class="page-header">
        @if(isset($keyword))
        <div class="row">
            <div class="col-12">
                <form action="/admin/settings/constants" method="POST">
                    @csrf
                    <div class="row center">
                        @foreach($keyword as $key => $value)
                            @if($key == 'title' && !isset($keyword['subcategory']))
                                <div class="col-12">
                                    <label for="main_category">Name</label>
                                    <input type="text" id="title" name="title"
                                           value="{{ $keyword['title'] }}"
                                           class="form-control"
                                           disabled
                                    >
                                </div>
                            @elseif($key != 'id' && $key != 'type' && $key != 'title')
                            <div class="col-12">
                                <label for="main_category">
                                    @if($key == 'distance')
                                        Value
                                    @else
                                        {{ $key }}
                                    @endif
                                </label>
                                <input type="text" id="{{ $key }}" name="{{ $key }}"
                                       value="{{ $keyword[$key] }}"
                                       class="form-control">
                            </div>
                            @endif
                        @endforeach
                        <div class="col-12">
                            @if(isset($keyword))
                            <input type="hidden" name="id" value="{{ $keyword['id'] }}">
                            @endif
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><h3>Constant list</h3></div>
            <div class="col-6">
                @include('admin.constants.filter')
            </div>
            <div class="col-12">
                <table class="w-100">
                @foreach($keywordList as $key => $keywordGroup)
                    <tr>
                        <th colspan="{!! count(reset($keywordGroup)) + 1 !!}" style="background-color: #4fc47f; color: white">
                            {{ ucwords(str_replace("_", " ", str_replace("__", " - ", $key))) }}
                        </th>
                    <tr>
                    <tr>
                        <th></th>
                        @foreach($masterKeys[$key] as $itemKey)
                            @if($itemKey == 'title' || $itemKey == 'subcategory')
                                <th>Name</th>
                            @elseif($itemKey == 'type')
                                <!-- -->
                            @elseif($itemKey == 'distance')
                                <th>Value</th>
                            @elseif($itemKey != 'id')
                                <th>{!! ucwords($itemKey) !!}</th>
                            @endif
                        @endforeach
                    </tr>
                    @foreach($keywordGroup as $keyword)
                        <tr>
                            <td><a href="/admin/settings/constants/{{ $keyword['id'] }}"><i class="icon-fa icon-fa-pencil"/></a></td>
                            <td>
                                {{ ucfirst(isset($keyword['subcategory']) ? $keyword['subcategory'] : $keyword['title']) }}
                            </td>
                            @foreach($masterKeys[$key] as $itemKey)
                                @if($itemKey != 'id' && $itemKey != 'title' && $itemKey != 'subcategory')
                                <td>{!! isset($keyword[$itemKey]) ? $keyword[$itemKey] : ''!!}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop