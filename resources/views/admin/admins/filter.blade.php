<div class="col-12 top-filter">
    <form  action="" class="form-inline">
        <input value="{{ $name }}" placeholder="Name" type="text"  id="name" name="name"  class="form-control col-6 ml-2 mb-2">
        <select name="filter_cols" class="form-control col-2 ml-2 mb-2">
            <option value="" @if($filter_cols == '') selected @endif>Recent </option>
            <option value="alpha_asc" @if($filter_cols == 'alpha_asc') selected @endif>Alphabetical ASC</option>
            <option value="alpha_desc" @if($filter_cols == 'alpha_desc') selected @endif>Alphabetical DESC</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary ml-2 mb-2">Search</button>
        <a href="{{ URL::to('/admin/admins') }}" class="btn btn-sm btn-danger ml-2 mb-2">Reset</a>
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