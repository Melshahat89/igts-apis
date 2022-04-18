@extends(layoutExtend())

@section('title')
     {{ trans('transactions.transactions') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/transactions/pluck') }}" ><i class="fa fa-trash"></i></button>
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
        	{{ Form::select('user_id', allInstructors(),null,['class' => 'form-control select2', 'placeholder' => 'Select Instructor']) }}
    	</div>

		<div class="form-group">
        	{{ Form::select('courses_id', allCourses(),null,['class' => 'form-control select2', 'placeholder' => 'Select Course']) }}
    	</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/transactions') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>

	<a class="dt-button buttons-excel btn btn-primary btn-sm m-r-xs m-b-xs waves-effect" 
    tabindex="0" aria-controls="dataTableBuilder" href="{{Request::fullUrl()}}&action=excel"><span>
        <i class="fa fa-file-excel-o"></i> Custom Export</span>
    </a>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('transactions.transactions') , 'model' => 'transactions' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection