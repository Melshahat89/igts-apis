@extends(layoutExtend())

@section('title')
     {{ trans('ordersposition.ordersposition') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/ordersposition/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="amount" class="form-control " placeholder="{{ trans("ordersposition.amount") }}" value="{{ request()->has("amount") ? request()->get("amount") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="notes" class="form-control " placeholder="{{ trans("ordersposition.notes") }}" value="{{ request()->has("notes") ? request()->get("notes") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="certificate_id" class="form-control " placeholder="{{ trans("ordersposition.certificate_id") }}" value="{{ request()->has("certificate_id") ? request()->get("certificate_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="shipping_id" class="form-control " placeholder="{{ trans("ordersposition.shipping_id") }}" value="{{ request()->has("shipping_id") ? request()->get("shipping_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="status" class="form-control " placeholder="{{ trans("ordersposition.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/ordersposition') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('ordersposition.ordersposition') , 'model' => 'ordersposition' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection