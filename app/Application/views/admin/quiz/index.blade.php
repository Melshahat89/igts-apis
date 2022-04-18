@extends(layoutExtend())

@section('title')
     {{ trans('quiz.quiz') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/quiz/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="title" class="form-control " placeholder="{{ trans("quiz.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="description" class="form-control " placeholder="{{ trans("quiz.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="instructions" class="form-control " placeholder="{{ trans("quiz.instructions") }}" value="{{ request()->has("instructions") ? request()->get("instructions") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="time" class="form-control time" placeholder="{{ trans("quiz.time") }}" value="{{ request()->has("time") ? request()->get("time") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="time_in_mins" class="form-control " placeholder="{{ trans("quiz.time_in_mins") }}" value="{{ request()->has("time_in_mins") ? request()->get("time_in_mins") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="type" class="form-control " placeholder="{{ trans("quiz.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="pass_percentage" class="form-control " placeholder="{{ trans("quiz.pass_percentage") }}" value="{{ request()->has("pass_percentage") ? request()->get("pass_percentage") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/quiz') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('quiz.quiz') , 'model' => 'quiz' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection