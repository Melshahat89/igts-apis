@extends(layoutExtend())

@section('title')
     {{ trans('social.social') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/social/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="user_id" class="form-control " placeholder="{{ trans("social.user_id") }}" value="{{ request()->has("user_id") ? request()->get("user_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="provider" class="form-control " placeholder="{{ trans("social.provider") }}" value="{{ request()->has("provider") ? request()->get("provider") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="identifier" class="form-control " placeholder="{{ trans("social.identifier") }}" value="{{ request()->has("identifier") ? request()->get("identifier") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="profile_cache" class="form-control " placeholder="{{ trans("social.profile_cache") }}" value="{{ request()->has("profile_cache") ? request()->get("profile_cache") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="session_data" class="form-control " placeholder="{{ trans("social.session_data") }}" value="{{ request()->has("session_data") ? request()->get("session_data") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/social') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('social.social') , 'model' => 'social' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection