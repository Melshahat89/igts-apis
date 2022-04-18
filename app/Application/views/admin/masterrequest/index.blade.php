@extends(layoutExtend())

@section('title')
     {{ trans('masterrequest.masterrequest') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/masterrequest/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="collage_name" class="form-control " placeholder="{{ trans("masterrequest.collage_name") }}" value="{{ request()->has("collage_name") ? request()->get("collage_name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="section" class="form-control " placeholder="{{ trans("masterrequest.section") }}" value="{{ request()->has("section") ? request()->get("section") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="g_year" class="form-control " placeholder="{{ trans("masterrequest.g_year") }}" value="{{ request()->has("g_year") ? request()->get("g_year") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="address" class="form-control " placeholder="{{ trans("masterrequest.address") }}" value="{{ request()->has("address") ? request()->get("address") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/masterrequest') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('masterrequest.masterrequest') , 'model' => 'masterrequest' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection