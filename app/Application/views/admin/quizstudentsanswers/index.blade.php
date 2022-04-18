@extends(layoutExtend())

@section('title')
     {{ trans('quizstudentsanswers.quizstudentsanswers') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/quizstudentsanswers/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<select style="width:80px" name="is_correct" class="form-control select2" placeholder="{{ trans("quizstudentsanswers.is_correct") }}">
				<option value="1"{{ request()->has("is_correct") &&  request()->get("is_correct") === 1 ? "selected" : "" }}>{{ trans("quizstudentsanswers.Yes") }}</option>
				<option value="0"{{ request()->has("is_correct") &&  request()->get("is_correct") === 0 ? "selected" : "" }}>{{ trans("quizstudentsanswers.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="answered" class="form-control select2" placeholder="{{ trans("quizstudentsanswers.answered") }}">
				<option value="1"{{ request()->has("answered") &&  request()->get("answered") === 1 ? "selected" : "" }}>{{ trans("quizstudentsanswers.Yes") }}</option>
				<option value="0"{{ request()->has("answered") &&  request()->get("answered") === 0 ? "selected" : "" }}>{{ trans("quizstudentsanswers.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="mark" class="form-control " placeholder="{{ trans("quizstudentsanswers.mark") }}" value="{{ request()->has("mark") ? request()->get("mark") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/quizstudentsanswers') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('quizstudentsanswers.quizstudentsanswers') , 'model' => 'quizstudentsanswers' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection