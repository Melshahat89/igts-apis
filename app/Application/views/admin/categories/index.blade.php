@extends(layoutExtend())

@section('title')
     {{ trans('categories.categories') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/categories/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="name" class="form-control " placeholder="{{ trans("categories.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("categories.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="desc" class="form-control " placeholder="{{ trans("categories.desc") }}" value="{{ request()->has("desc") ? request()->get("desc") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="parent_id" class="form-control " placeholder="{{ trans("categories.parent_id") }}" value="{{ request()->has("parent_id") ? request()->get("parent_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="sort" class="form-control " placeholder="{{ trans("categories.sort") }}" value="{{ request()->has("sort") ? request()->get("sort") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="status" class="form-control select2" placeholder="{{ trans("categories.status") }}">
				<option value="1"{{ request()->has("status") &&  request()->get("status") === 1 ? "selected" : "" }}>{{ trans("categories.Yes") }}</option>
				<option value="0"{{ request()->has("status") &&  request()->get("status") === 0 ? "selected" : "" }}>{{ trans("categories.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="show_home" class="form-control select2" placeholder="{{ trans("categories.show_home") }}">
				<option value="1"{{ request()->has("show_home") &&  request()->get("show_home") === 1 ? "selected" : "" }}>{{ trans("categories.Yes") }}</option>
				<option value="0"{{ request()->has("show_home") &&  request()->get("show_home") === 0 ? "selected" : "" }}>{{ trans("categories.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="show_menu" class="form-control select2" placeholder="{{ trans("categories.show_menu") }}">
				<option value="1"{{ request()->has("show_menu") &&  request()->get("show_menu") === 1 ? "selected" : "" }}>{{ trans("categories.Yes") }}</option>
				<option value="0"{{ request()->has("show_menu") &&  request()->get("show_menu") === 0 ? "selected" : "" }}>{{ trans("categories.No") }}</option>
		</select>
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/categories') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('categories.categories') , 'model' => 'categories' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection