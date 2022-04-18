@extends(layoutExtend())

@section('title')
     {{ trans('quizquestionschoice.quizquestionschoice') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/quizquestionschoice/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="choice" class="form-control " placeholder="{{ trans("quizquestionschoice.choice") }}" value="{{ request()->has("choice") ? request()->get("choice") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="is_correct" class="form-control select2" placeholder="{{ trans("quizquestionschoice.is_correct") }}">
				<option value="1"{{ request()->has("is_correct") &&  request()->get("is_correct") === 1 ? "selected" : "" }}>{{ trans("quizquestionschoice.Yes") }}</option>
				<option value="0"{{ request()->has("is_correct") &&  request()->get("is_correct") === 0 ? "selected" : "" }}>{{ trans("quizquestionschoice.No") }}</option>
		</select>
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/quizquestionschoice') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('quizquestionschoice.quizquestionschoice') , 'model' => 'quizquestionschoice' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection