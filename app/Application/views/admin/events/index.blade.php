@extends(layoutExtend())

@section('title')
     {{ trans('events.events') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/events/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="title" class="form-control " placeholder="{{ trans("events.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="description" class="form-control " placeholder="{{ trans("events.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="is_free" class="form-control select2" placeholder="{{ trans("events.is_free") }}">
				<option value="1"{{ request()->has("is_free") &&  request()->get("is_free") === 1 ? "selected" : "" }}>{{ trans("events.Yes") }}</option>
				<option value="0"{{ request()->has("is_free") &&  request()->get("is_free") === 0 ? "selected" : "" }}>{{ trans("events.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="price_egp" class="form-control " placeholder="{{ trans("events.price_egp") }}" value="{{ request()->has("price_egp") ? request()->get("price_egp") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="price_usd" class="form-control " placeholder="{{ trans("events.price_usd") }}" value="{{ request()->has("price_usd") ? request()->get("price_usd") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="type" class="form-control " placeholder="{{ trans("events.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="status" class="form-control select2" placeholder="{{ trans("events.status") }}">
				<option value="1"{{ request()->has("status") &&  request()->get("status") === 1 ? "selected" : "" }}>{{ trans("events.Yes") }}</option>
				<option value="0"{{ request()->has("status") &&  request()->get("status") === 0 ? "selected" : "" }}>{{ trans("events.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="location" class="form-control " placeholder="{{ trans("events.location") }}" value="{{ request()->has("location") ? request()->get("location") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="live_link" class="form-control " placeholder="{{ trans("events.live_link") }}" value="{{ request()->has("live_link") ? request()->get("live_link") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="recorded_link" class="form-control " placeholder="{{ trans("events.recorded_link") }}" value="{{ request()->has("recorded_link") ? request()->get("recorded_link") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/events') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('events.events') , 'model' => 'events' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection