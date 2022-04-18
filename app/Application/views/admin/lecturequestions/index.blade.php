@extends(layoutExtend())

@section('title')
     {{ trans('lecturequestions.lecturequestions') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/lecturequestions/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<select style="" name="answered" class="form-control select2" placeholder="{{ trans("lecturequestions.answered") }}">
                <option value="">Answered?</option>
				<option value="1"{{ request()->has("answered") &&  request()->get("answered") == "1" ? "selected" : "" }}>{{ trans("lecturequestions.Yes") }}</option>
				<option value="0"{{ request()->has("answered") &&  request()->get("answered") == "0" ? "selected" : "" }}>{{ trans("lecturequestions.No") }}</option>
		</select>
		</div>
        <div class="form-group">
			{{ Form::select('course', allCourses(),null,['class' => 'form-control select2', 'placeholder' => 'Select Course']) }}		</div>
		<div class="form-group">
        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/lecturequestions') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('lecturequestions.lecturequestions') , 'model' => 'lecturequestions' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection