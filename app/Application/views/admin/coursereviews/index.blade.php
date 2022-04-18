@extends(layoutExtend())

@section('title')
     {{ trans('coursereviews.coursereviews') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/coursereviews/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="review" class="form-control " placeholder="{{ trans("coursereviews.review") }}" value="{{ request()->has("review") ? request()->get("review") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="rating" class="form-control " placeholder="{{ trans("coursereviews.rating") }}" value="{{ request()->has("rating") ? request()->get("rating") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="type" class="form-control select2" placeholder="{{ trans("coursereviews.type") }}">
				<option value="1"{{ request()->has("type") &&  request()->get("type") === 1 ? "selected" : "" }}>{{ trans("coursereviews.Yes") }}</option>
				<option value="0"{{ request()->has("type") &&  request()->get("type") === 0 ? "selected" : "" }}>{{ trans("coursereviews.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="manual_name" class="form-control " placeholder="{{ trans("coursereviews.manual_name") }}" value="{{ request()->has("manual_name") ? request()->get("manual_name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="manual_image" class="form-control " placeholder="{{ trans("coursereviews.manual_image") }}" value="{{ request()->has("manual_image") ? request()->get("manual_image") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/coursereviews') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('coursereviews.coursereviews') , 'model' => 'coursereviews' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection