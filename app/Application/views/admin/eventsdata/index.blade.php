@extends(layoutExtend())

@section('title')
     {{ trans('eventsdata.eventsdata') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/eventsdata/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="name" class="form-control " placeholder="{{ trans("eventsdata.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="email" class="form-control " placeholder="{{ trans("eventsdata.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="website" class="form-control " placeholder="{{ trans("eventsdata.website") }}" value="{{ request()->has("website") ? request()->get("website") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="about" class="form-control " placeholder="{{ trans("eventsdata.about") }}" value="{{ request()->has("about") ? request()->get("about") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="status" class="form-control select2" placeholder="{{ trans("eventsdata.status") }}">
				<option value="1"{{ request()->has("status") &&  request()->get("status") === 1 ? "selected" : "" }}>{{ trans("eventsdata.Yes") }}</option>
				<option value="0"{{ request()->has("status") &&  request()->get("status") === 0 ? "selected" : "" }}>{{ trans("eventsdata.No") }}</option>
		</select>
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/eventsdata') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('eventsdata.eventsdata') , 'model' => 'eventsdata' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection