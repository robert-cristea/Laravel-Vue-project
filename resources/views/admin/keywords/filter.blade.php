<div class="col-12 top-filter">
    <form  action="" class="form-inline">
        <input value="{{ $keywords }}" placeholder="Keyword" type="text"  id="keywords" name="keywords"  class="form-control col-8 ml-2 mb-2">
        <button type="submit" class="btn btn-sm btn-primary ml-2 mb-2">Search</button>
        <a href="{{ URL::to('/admin/settings/keywords') }}" class="btn btn-sm btn-danger ml-2 mb-2">Reset</a>
        <!-- <button type="reset" class="btn btn-sm btn-danger ml-2 mb-2">Reset</button> -->
    </form>
</div>