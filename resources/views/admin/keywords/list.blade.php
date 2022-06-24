@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content" id="ProjectNavigation">
    <div class="page-header">
        <div class="row">
            <div class="col-12">
                @if(isset($keyword))
                    <h3>Edit Keyword</h3>
                @else
                    <h3>New Keyword</h3>
                @endif
            </div>
            <div class="col-12">
                <form action="/admin/settings/keywords" method="POST">
                    @csrf
                    <div class="row center">
                        @if(!isset($keyword))
                        <div class="col-12">
                            <select name="type" class="form-control">
                                @foreach(array_keys($keywordList) as $key)
                                <option value="{{ $key }}"
                                    @if(isset($keyword) && $keyword['type'] == $key)
                                        selected
                                    @endif
                                >{{ ucwords(str_replace("_", " ", str_replace("__", " - ", $key))) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-12">
                            <label for="main_category">Name</label>
                            <input type="text" id="title" name="title"
                                   @if(isset($keyword))
                                   value="{{ $keyword['title'] }}"
                                   @endif
                                   class="form-control">
                        </div>
                        <div class="col-12">
                            <br/>
                            @if(isset($keyword))
                            <input type="hidden" name="id" value="{{ $keyword['id'] }}">
                            @endif
                            <button type="submit" class="btn btn-success">Save</button>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><h3>Keyword list</h3></div>
            <div class="col-6">
                @include('admin.keywords.filter')
            </div>
            <div class="col-12">
                <table class="w-100">
                @foreach($keywordList as $key => $keywordGroup)
                    <tr>
                        <th colspan="2" style="background-color: #4fc47f; color: white">
                            {{ ucwords(str_replace("_", " ", str_replace("__", " - ", $key))) }}
                        </th>
                    </tr>
                    @foreach($keywordGroup as $keyword)
                        <tr>
                            <td><a href="/admin/settings/keywords/{{ $keyword['id'] }}"><i class="icon-fa icon-fa-pencil"/></a></td>
                            <td>
                                @if(isset($keyword['subcategory']))
                                    {{ $keyword['subcategory'] }}
                                @elseif(isset($keyword['title']))
                                    {{ $keyword['title'] }}
                                @else
                                    {{ $keyword['id'] }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop