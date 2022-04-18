@extends(layoutExtend())

@section('title')
     {{ trans('eventsenrollment.eventsenrollment') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/eventsenrollment/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="start_time" class="form-control datepicker2" placeholder="{{ trans("eventsenrollment.start_time") }}" value="{{ request()->has("start_time") ? request()->get("start_time") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="end_time" class="form-control datepicker2" placeholder="{{ trans("eventsenrollment.end_time") }}" value="{{ request()->has("end_time") ? request()->get("end_time") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="status" class="form-control select2" placeholder="{{ trans("eventsenrollment.status") }}">
				<option value="1"{{ request()->has("status") &&  request()->get("status") === 1 ? "selected" : "" }}>{{ trans("eventsenrollment.Yes") }}</option>
				<option value="0"{{ request()->has("status") &&  request()->get("status") === 0 ? "selected" : "" }}>{{ trans("eventsenrollment.No") }}</option>
		</select>
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/eventsenrollment') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('eventsenrollment.eventsenrollment') , 'model' => 'eventsenrollment' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection