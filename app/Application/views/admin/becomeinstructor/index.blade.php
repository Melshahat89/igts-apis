@extends(layoutExtend())

@section('title')
     {{ trans('becomeinstructor.becomeinstructor') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('admin/becomeinstructor/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="name" class="form-control " placeholder="{{ trans("becomeinstructor.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="email" class="form-control " placeholder="{{ trans("becomeinstructor.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="phone" class="form-control " placeholder="{{ trans("becomeinstructor.phone") }}" value="{{ request()->has("phone") ? request()->get("phone") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="title" class="form-control " placeholder="{{ trans("becomeinstructor.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="specialist" class="form-control " placeholder="{{ trans("becomeinstructor.specialist") }}" value="{{ request()->has("specialist") ? request()->get("specialist") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="yourCourses" class="form-control " placeholder="{{ trans("becomeinstructor.yourCourses") }}" value="{{ request()->has("yourCourses") ? request()->get("yourCourses") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="socialAccount" class="form-control " placeholder="{{ trans("becomeinstructor.socialAccount") }}" value="{{ request()->has("socialAccount") ? request()->get("socialAccount") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/becomeinstructor') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('becomeinstructor.becomeinstructor') , 'model' => 'becomeinstructor' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection