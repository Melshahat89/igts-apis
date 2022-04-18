@extends(layoutExtend())

@section('title')
     {{ trans('talks.talks') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/talks/pluck') }}" ><i class="fa fa-trash"></i></button>
    <button class="btn btn-success" onclick="checkAll(this)"  ><i class="fa fa-check-circle-o"></i> </button>
    <button class="btn btn-warning" onclick="unCheckAll(this)"  ><i class="fa fa-check-circle"></i> </button>
@endpush

@push('search')
    <form method="get" class="form-inline">
        <div class="form-group">
            <input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans('admin.from') }}" value="{{ request()->has('from') ? request()->get('from') : '' }}">
        </div>
        <div class="form-group">
            <input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans('admin.to') }}" value="{{ request()->has('to') ? request()->get('to') : '' }}">
        </div>
		<div class="form-group">
			<input type="text" name="title" class="form-control " placeholder="{{ trans("talks.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("talks.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="subtitle" class="form-control " placeholder="{{ trans("talks.subtitle") }}" value="{{ request()->has("subtitle") ? request()->get("subtitle") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="description" class="form-control " placeholder="{{ trans("talks.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="language_id" class="form-control " placeholder="{{ trans("talks.language_id") }}" value="{{ request()->has("language_id") ? request()->get("language_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="length" class="form-control " placeholder="{{ trans("talks.length") }}" value="{{ request()->has("length") ? request()->get("length") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="featured" class="form-control select2" placeholder="{{ trans("talks.featured") }}">
				<option value="1"{{ request()->has("featured") &&  request()->get("featured") === 1 ? "selected" : "" }}>{{ trans("talks.Yes") }}</option>
				<option value="0"{{ request()->has("featured") &&  request()->get("featured") === 0 ? "selected" : "" }}>{{ trans("talks.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="published" class="form-control select2" placeholder="{{ trans("talks.published") }}">
				<option value="1"{{ request()->has("published") &&  request()->get("published") === 1 ? "selected" : "" }}>{{ trans("talks.Yes") }}</option>
				<option value="0"{{ request()->has("published") &&  request()->get("published") === 0 ? "selected" : "" }}>{{ trans("talks.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="visits" class="form-control " placeholder="{{ trans("talks.visits") }}" value="{{ request()->has("visits") ? request()->get("visits") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="video_file" class="form-control " placeholder="{{ trans("talks.video_file") }}" value="{{ request()->has("video_file") ? request()->get("video_file") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="sort" class="form-control " placeholder="{{ trans("talks.sort") }}" value="{{ request()->has("sort") ? request()->get("sort") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="doctor_name" class="form-control " placeholder="{{ trans("talks.doctor_name") }}" value="{{ request()->has("doctor_name") ? request()->get("doctor_name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="seo_desc" class="form-control " placeholder="{{ trans("talks.seo_desc") }}" value="{{ request()->has("seo_desc") ? request()->get("seo_desc") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="seo_keys" class="form-control " placeholder="{{ trans("talks.seo_keys") }}" value="{{ request()->has("seo_keys") ? request()->get("seo_keys") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="search_keys" class="form-control " placeholder="{{ trans("talks.search_keys") }}" value="{{ request()->has("search_keys") ? request()->get("search_keys") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/talks') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('talks.talks') , 'model' => 'talks' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection