@extends(layoutExtend())

@section('title')
     {{ trans('courselectures.courselectures') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/courselectures/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="title" class="form-control " placeholder="{{ trans("courselectures.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("courselectures.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="description" class="form-control " placeholder="{{ trans("courselectures.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="video_file" class="form-control " placeholder="{{ trans("courselectures.video_file") }}" value="{{ request()->has("video_file") ? request()->get("video_file") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="length" class="form-control " placeholder="{{ trans("courselectures.length") }}" value="{{ request()->has("length") ? request()->get("length") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="is_free" class="form-control select2" placeholder="{{ trans("courselectures.is_free") }}">
				<option value="1"{{ request()->has("is_free") &&  request()->get("is_free") === 1 ? "selected" : "" }}>{{ trans("courselectures.Yes") }}</option>
				<option value="0"{{ request()->has("is_free") &&  request()->get("is_free") === 0 ? "selected" : "" }}>{{ trans("courselectures.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="position" class="form-control " placeholder="{{ trans("courselectures.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/courselectures') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('courselectures.courselectures') , 'model' => 'courselectures' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection