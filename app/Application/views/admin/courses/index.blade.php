@extends(layoutExtend())

@section('title')
     {{ trans('courses.courses') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/courses/pluck') }}" ><i class="fa fa-trash"></i></button>
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
        {{ Form::select('instructor_id', allInstructors(),null,['class' => 'form-control select2']) }}
    	</div>
		<div class="form-group">
			<input type="text" name="title" class="form-control " placeholder="{{ trans("courses.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("courses.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="description" class="form-control " placeholder="{{ trans("courses.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="welcome_message" class="form-control " placeholder="{{ trans("courses.welcome_message") }}" value="{{ request()->has("welcome_message") ? request()->get("welcome_message") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="congratulation_message" class="form-control " placeholder="{{ trans("courses.congratulation_message") }}" value="{{ request()->has("congratulation_message") ? request()->get("congratulation_message") : "" }}">
		</div>
		<div class="form-group">
			{{ Form::select('type', typesCourses(),null,['class' => 'form-control select2']) }}		</div>
		<div class="form-group">
			<input type="text" name="skill_level" class="form-control " placeholder="{{ trans("courses.skill_level") }}" value="{{ request()->has("skill_level") ? request()->get("skill_level") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="language_id" class="form-control " placeholder="{{ trans("courses.language_id") }}" value="{{ request()->has("language_id") ? request()->get("language_id") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="has_captions" class="form-control select2" placeholder="{{ trans("courses.has_captions") }}">
				<option value="1"{{ request()->has("has_captions") &&  request()->get("has_captions") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("has_captions") &&  request()->get("has_captions") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<select style="width:80px" name="has_certificate" class="form-control select2" placeholder="{{ trans("courses.has_certificate") }}">
				<option value="1"{{ request()->has("has_certificate") &&  request()->get("has_certificate") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("has_certificate") &&  request()->get("has_certificate") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>

		<div class="form-group">
			<input type="text" name="length" class="form-control " placeholder="{{ trans("courses.length") }}" value="{{ request()->has("length") ? request()->get("length") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="price" class="form-control " placeholder="{{ trans("courses.price") }}" value="{{ request()->has("price") ? request()->get("price") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="price_in_dollar" class="form-control " placeholder="{{ trans("courses.price_in_dollar") }}" value="{{ request()->has("price_in_dollar") ? request()->get("price_in_dollar") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="affiliate1_per" class="form-control " placeholder="{{ trans("courses.affiliate1_per") }}" value="{{ request()->has("affiliate1_per") ? request()->get("affiliate1_per") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="affiliate2_per" class="form-control " placeholder="{{ trans("courses.affiliate2_per") }}" value="{{ request()->has("affiliate2_per") ? request()->get("affiliate2_per") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="affiliate3_per" class="form-control " placeholder="{{ trans("courses.affiliate3_per") }}" value="{{ request()->has("affiliate3_per") ? request()->get("affiliate3_per") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="affiliate4_per" class="form-control " placeholder="{{ trans("courses.affiliate4_per") }}" value="{{ request()->has("affiliate4_per") ? request()->get("affiliate4_per") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="instructor_per" class="form-control " placeholder="{{ trans("courses.instructor_per") }}" value="{{ request()->has("instructor_per") ? request()->get("instructor_per") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="discount_egp" class="form-control " placeholder="{{ trans("courses.discount_egp") }}" value="{{ request()->has("discount_egp") ? request()->get("discount_egp") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="discount_usd" class="form-control " placeholder="{{ trans("courses.discount_usd") }}" value="{{ request()->has("discount_usd") ? request()->get("discount_usd") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="featured" class="form-control select2" placeholder="{{ trans("courses.featured") }}">
				<option value="1"{{ request()->has("featured") &&  request()->get("featured") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("featured") &&  request()->get("featured") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="promo_video" class="form-control " placeholder="{{ trans("courses.promo_video") }}" value="{{ request()->has("promo_video") ? request()->get("promo_video") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="visits" class="form-control " placeholder="{{ trans("courses.visits") }}" value="{{ request()->has("visits") ? request()->get("visits") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="published" class="form-control select2" placeholder="{{ trans("courses.published") }}">
				<option value="1"{{ request()->has("published") &&  request()->get("published") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("published") &&  request()->get("published") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="position" class="form-control " placeholder="{{ trans("courses.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="sort" class="form-control " placeholder="{{ trans("courses.sort") }}" value="{{ request()->has("sort") ? request()->get("sort") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="doctor_name" class="form-control " placeholder="{{ trans("courses.doctor_name") }}" value="{{ request()->has("doctor_name") ? request()->get("doctor_name") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="full_access" class="form-control select2" placeholder="{{ trans("courses.full_access") }}">
				<option value="1"{{ request()->has("full_access") &&  request()->get("full_access") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("full_access") &&  request()->get("full_access") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="access_time" class="form-control " placeholder="{{ trans("courses.access_time") }}" value="{{ request()->has("access_time") ? request()->get("access_time") : "" }}">
		</div>
		<div class="form-group">
			<select style="width:80px" name="soon" class="form-control select2" placeholder="{{ trans("courses.soon") }}">
				<option value="1"{{ request()->has("soon") &&  request()->get("soon") === 1 ? "selected" : "" }}>{{ trans("courses.Yes") }}</option>
				<option value="0"{{ request()->has("soon") &&  request()->get("soon") === 0 ? "selected" : "" }}>{{ trans("courses.No") }}</option>
		</select>
		</div>
		<div class="form-group">
			<input type="text" name="seo_desc" class="form-control " placeholder="{{ trans("courses.seo_desc") }}" value="{{ request()->has("seo_desc") ? request()->get("seo_desc") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="seo_keys" class="form-control " placeholder="{{ trans("courses.seo_keys") }}" value="{{ request()->has("seo_keys") ? request()->get("seo_keys") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="search_keys" class="form-control " placeholder="{{ trans("courses.search_keys") }}" value="{{ request()->has("search_keys") ? request()->get("search_keys") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/courses') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('courses.courses') , 'model' => 'courses' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection