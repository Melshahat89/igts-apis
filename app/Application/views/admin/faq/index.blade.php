@extends(layoutExtend())

@section('title')
     {{ trans('faq.faq') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/faq/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="group_id" class="form-control " placeholder="{{ trans("faq.group_id") }}" value="{{ request()->has("group_id") ? request()->get("group_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="question" class="form-control " placeholder="{{ trans("faq.question") }}" value="{{ request()->has("question") ? request()->get("question") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="answer" class="form-control " placeholder="{{ trans("faq.answer") }}" value="{{ request()->has("answer") ? request()->get("answer") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/faq') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('faq.faq') , 'model' => 'faq' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection