@extends(layoutExtend())

@section('title')
    {{ trans('categories.categories') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('categories.categories') , 'model' => 'categories' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/categories/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group  {{  $errors->has("name.en")  &&  $errors->has("name.ar")  ? "has-error" : "" }}" >
			<label for="name">{{ trans("categories.name")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "name", isset($item->name) ? $item->name : old("name") , "text" , "categories") !!}
		</div>
			@if ($errors->has("name.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("name.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("name.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("name.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("slug") ? "has-error" : "" }}" > 
			<label for="slug">{{ trans("categories.slug")}}</label>
				<input type="text" name="slug" class="form-control" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("categories.slug")}}">
		</div>
			@if ($errors->has("slug"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("slug") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("desc.en")  &&  $errors->has("desc.ar")  ? "has-error" : "" }}" >
			<label for="desc">{{ trans("categories.desc")}}</label>
			 {!! extractFiled(isset($item) ? $item : null , "desc", isset($item->desc) ? $item->desc : old("desc") , "text" , "categories") !!}

		</div>
			@if ($errors->has("desc.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("desc.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("desc.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("desc.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("parent_id") ? "has-error" : "" }}" > 
			<label for="parent_id">{{ trans("categories.parent_id")}}</label>
				<input type="text" name="parent_id" class="form-control" id="parent_id" value="{{ isset($item->parent_id) ? $item->parent_id : old("parent_id") }}"  placeholder="{{ trans("categories.parent_id")}}">
		</div>
			@if ($errors->has("parent_id"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("parent_id") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("sort") ? "has-error" : "" }}" > 
			<label for="sort">{{ trans("categories.sort")}}</label>
				<input type="text" name="sort" class="form-control" id="sort" value="{{ isset($item->sort) ? $item->sort : old("sort") }}"  placeholder="{{ trans("categories.sort")}}">
		</div>
			@if ($errors->has("sort"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("sort") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
			<label for="status">{{ trans("categories.status")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("categories.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("categories.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("status"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("status") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("show_home") ? "has-error" : "" }}" > 
			<label for="show_home">{{ trans("categories.show_home")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="show_home" {{ isset($item->show_home) && $item->show_home == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("categories.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="show_home" {{ isset($item->show_home) && $item->show_home == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("categories.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("show_home"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("show_home") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("show_menu") ? "has-error" : "" }}" > 
			<label for="show_menu">{{ trans("categories.show_menu")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="show_menu" {{ isset($item->show_menu) && $item->show_menu == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("categories.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="show_menu" {{ isset($item->show_menu) && $item->show_menu == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("categories.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("show_menu"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("show_menu") }}</strong>
					</span>
				</div>
			@endif
{{--		 <div class="form-group {{ $errors->has("m_image") ? "has-error" : "" }}" > --}}
{{--			<label for="m_image">{{ trans("categories.m_image")}}</label>--}}
{{--				@if(isset($item) && $item->m_image != "")--}}
{{--				<br>--}}
{{--				<img src="{{ small($item->m_image) }}" class="thumbnail" alt="" width="200">--}}
{{--				<br>--}}
{{--				@endif--}}
{{--				<input type="file" name="m_image" >--}}
{{--		</div>--}}
{{--			@if ($errors->has("m_image"))--}}
{{--				<div class="alert alert-danger">--}}
{{--					<span class='help-block'>--}}
{{--						<strong>{{ $errors->first("m_image") }}</strong>--}}
{{--					</span>--}}
{{--				</div>--}}
{{--			@endif--}}
{{--		 <div class="form-group {{ $errors->has("d_image") ? "has-error" : "" }}" > --}}
{{--			<label for="d_image">{{ trans("categories.d_image")}}</label>--}}
{{--				@if(isset($item) && $item->d_image != "")--}}
{{--				<br>--}}
{{--				<img src="{{ small($item->d_image) }}" class="thumbnail" alt="" width="200">--}}
{{--				<br>--}}
{{--				@endif--}}
{{--				<input type="file" name="d_image" >--}}
{{--		</div>--}}
{{--			@if ($errors->has("d_image"))--}}
{{--				<div class="alert alert-danger">--}}
{{--					<span class='help-block'>--}}
{{--						<strong>{{ $errors->first("d_image") }}</strong>--}}
{{--					</span>--}}
{{--				</div>--}}
{{--			@endif--}}
		 <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
			<label for="image">{{ trans("categories.image")}}</label>
				@if(isset($item) && $item->image != "")
				<br>
				<img src="{{ small($item->image) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image" >
		</div>
			@if ($errors->has("image"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image") }}</strong>
					</span>
				</div>
			@endif

			<div class="form-group {{ $errors->has("color_code") ? "has-error" : "" }}" >
				<label for="color_code">{{ trans("categories.color_code")}}</label>
				<input type="text" name="color_code" class="form-control" id="color_code" value="{{ isset($item->color_code) ? $item->color_code : old("color_code") }}"  placeholder="{{ trans("categories.color_code")}}">
			</div>
			@if ($errors->has("color_code"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("color_code") }}</strong>
					</span>
				</div>
			@endif


			<!-- START FREE COURSE -->

			<div class="form-group  {{ $errors->has("courses_id") ? "has-error" : "" }}">
				<label for="class">{{ trans("categories.Free Course")}}</label>
				@php $course = isset($item) && $item->courses_id ? $item->courses_id : null; @endphp
				{{ Form::select('courses_id', allCourses(),$course,['class' => 'form-control select2', "placeholder" => "Select Course"]) }}
			</div>
			@if ($errors->has("courses_id"))
				<div class="alert alert-danger">
				<span class='help-block'>
				<strong>{{ $errors->first("courses_id") }}</strong>
				</span>
				</div>
			@endif

			<div class="form-group {{ $errors->has("end_time") ? "has-error" : "" }}" > 
				<label for="end_time">{{ trans("courseenrollment.end_time")}}</label>
				<input type="date" name="end_time" class="form-control" id="end_time" value="{{ isset($item->end_time) ? $item->end_time : old("end_time") }}"  placeholder="{{ trans("courseenrollment.end_time")}}">
  			</div>
			@if ($errors->has("end_time"))
				<div class="alert alert-danger">
				<span class='help-block'>
				<strong>{{ $errors->first("end_time") }}</strong>
				</span>
				</div>
			@endif



			<div class="form-group {{ $errors->has("enable_free") ? "has-error" : "" }}" > 
				<label for="enable_free">{{ trans("categories.enable_free")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="enable_free" {{ isset($item->enable_free) && $item->enable_free == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("categories.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="enable_free" {{ isset($item->enable_free) && $item->enable_free == 1 ? "checked" : "" }} type="radio" value="1" > 
					{{ trans("categories.Yes")}}
				 </label> 
				</div> 		
			</div>
			@if ($errors->has("enable_free"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("enable_free") }}</strong>
					</span>
				</div>
			@endif

			<!-- END FREE COURSE -->


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('categories.categories') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
