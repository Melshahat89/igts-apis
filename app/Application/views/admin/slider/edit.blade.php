@extends(layoutExtend())

@section('title')
    {{ trans('slider.slider') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('slider.slider') , 'model' => 'slider' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/slider/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
			<label for="title">{{ trans("slider.title")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "slider") !!}
		</div>
			@if ($errors->has("title.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("title.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
			<label for="description">{{ trans("slider.description")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "text" , "slider") !!}
		</div>
			@if ($errors->has("description.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("description.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image_m_ar") ? "has-error" : "" }}" > 
			<label for="image_m_ar">{{ trans("slider.image_m_ar")}}</label>
				@if(isset($item) && $item->image_m_ar != "")
				<br>
				<img src="{{ small($item->image_m_ar) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image_m_ar" >
		</div>
			@if ($errors->has("image_m_ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image_m_ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image_m_en") ? "has-error" : "" }}" > 
			<label for="image_m_en">{{ trans("slider.image_m_en")}}</label>
				@if(isset($item) && $item->image_m_en != "")
				<br>
				<img src="{{ small($item->image_m_en) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image_m_en" >
		</div>
			@if ($errors->has("image_m_en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image_m_en") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image_d_ar") ? "has-error" : "" }}" > 
			<label for="image_d_ar">{{ trans("slider.image_d_ar")}}</label>
				@if(isset($item) && $item->image_d_ar != "")
				<br>
				<img src="{{ small($item->image_d_ar) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image_d_ar" >
		</div>
			@if ($errors->has("image_d_ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image_d_ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image_d_en") ? "has-error" : "" }}" > 
			<label for="image_d_en">{{ trans("slider.image_d_en")}}</label>
				@if(isset($item) && $item->image_d_en != "")
				<br>
				<img src="{{ small($item->image_d_en) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image_d_en" >
		</div>
			@if ($errors->has("image_d_en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image_d_en") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
			<label for="status">{{ trans("slider.status")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("slider.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("slider.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("status"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("status") }}</strong>
					</span>
				</div>
			@endif


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('slider.slider') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
