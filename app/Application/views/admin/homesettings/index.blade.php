@extends(layoutExtend())

@section('title')
     {{ trans('homesettings.homesettings') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
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
			<select style="width:80px" name="bundles" class="form-control select2" placeholder="{{ trans("homesettings.bundles") }}">
				<option value="1"{{ request()->has("bundles") &&  request()->get("bundles") === 1 ? "selected" : "" }}>{{ trans("homesettings.Yes") }}</option>
				<option value="0"{{ request()->has("bundles") &&  request()->get("bundles") === 0 ? "selected" : "" }}>{{ trans("homesettings.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="featured_courses" class="form-control select2" placeholder="{{ trans("homesettings.featured_courses") }}">
				<option value="1"{{ request()->has("featured_courses") &&  request()->get("featured_courses") === 1 ? "selected" : "" }}>{{ trans("homesettings.Yes") }}</option>
				<option value="0"{{ request()->has("featured_courses") &&  request()->get("featured_courses") === 0 ? "selected" : "" }}>{{ trans("homesettings.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="events" class="form-control select2" placeholder="{{ trans("homesettings.events") }}">
				<option value="1"{{ request()->has("events") &&  request()->get("events") === 1 ? "selected" : "" }}>{{ trans("homesettings.Yes") }}</option>
				<option value="0"{{ request()->has("events") &&  request()->get("events") === 0 ? "selected" : "" }}>{{ trans("homesettings.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="talks" class="form-control select2" placeholder="{{ trans("homesettings.talks") }}">
				<option value="1"{{ request()->has("talks") &&  request()->get("talks") === 1 ? "selected" : "" }}>{{ trans("homesettings.Yes") }}</option>
				<option value="0"{{ request()->has("talks") &&  request()->get("talks") === 0 ? "selected" : "" }}>{{ trans("homesettings.No") }}</option>
		</select>
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/homesettings') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('homesettings.homesettings') , 'model' => 'homesettings' , 'table' => $dataTable->table([] , false) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection