<div class="col-12 top-filter">
    <form  action="" class="form-inline">
        <input value="{{ $highwayname }}" placeholder="Highway Name" type="text"  id="highwayname" name="highwayname"  class="form-control col-10 ml-2 mb-2">
        <button type="submit" class="btn btn-sm btn-primary ml-2 mb-2">Search</button>
        <a href="{{ URL::to('/admin/settings/highwaylist') }}" class="btn btn-sm btn-danger ml-2 mb-2">Reset</a>
    </form>
</div>