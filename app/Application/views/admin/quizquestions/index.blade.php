@extends(layoutExtend())

@section('title')
     {{ trans('quizquestions.quizquestions') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/quizquestions/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="question" class="form-control " placeholder="{{ trans("quizquestions.question") }}" value="{{ request()->has("question") ? request()->get("question") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="type" class="form-control " placeholder="{{ trans("quizquestions.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="mark" class="form-control " placeholder="{{ trans("quizquestions.mark") }}" value="{{ request()->has("mark") ? request()->get("mark") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/quizquestions') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('quizquestions.quizquestions') , 'model' => 'quizquestions' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection