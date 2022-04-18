@extends(layoutExtend())

@section('title')
     {{ trans('searchkeys.searchkeys') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/searchkeys/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="word" class="form-control " placeholder="{{ trans("searchkeys.word") }}" value="{{ request()->has("word") ? request()->get("word") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="ip" class="form-control " placeholder="{{ trans("searchkeys.ip") }}" value="{{ request()->has("ip") ? request()->get("ip") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="country" class="form-control " placeholder="{{ trans("searchkeys.country") }}" value="{{ request()->has("country") ? request()->get("country") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="city" class="form-control " placeholder="{{ trans("searchkeys.city") }}" value="{{ request()->has("city") ? request()->get("city") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/searchkeys') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('searchkeys.searchkeys') , 'model' => 'searchkeys' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection