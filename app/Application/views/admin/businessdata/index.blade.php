@extends(layoutExtend())

@section('title')
     {{ trans('businessdata.businessdata') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/businessdata/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="name" class="form-control " placeholder="{{ trans("businessdata.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="discount_type" class="form-control " placeholder="{{ trans("businessdata.discount_type") }}" value="{{ request()->has("discount_type") ? request()->get("discount_type") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="discount_value" class="form-control " placeholder="{{ trans("businessdata.discount_value") }}" value="{{ request()->has("discount_value") ? request()->get("discount_value") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="automatically_license" class="form-control select2" placeholder="{{ trans("businessdata.automatically_license") }}">
				<option value="1"{{ request()->has("automatically_license") &&  request()->get("automatically_license") === 1 ? "selected" : "" }}>{{ trans("businessdata.Yes") }}</option>
				<option value="0"{{ request()->has("automatically_license") &&  request()->get("automatically_license") === 0 ? "selected" : "" }}>{{ trans("businessdata.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="status" class="form-control " placeholder="{{ trans("businessdata.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/businessdata') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('businessdata.businessdata') , 'model' => 'businessdata' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection