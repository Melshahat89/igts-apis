@extends(layoutExtend('website'))

@section('title')
    {{ trans('testimonials.testimonials') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('testimonials') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('testimonials/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group  {{  $errors->has("name.en")  &&  $errors->has("name.ar")  ? "has-error" : "" }}" >
			<label for="name">{{ trans("testimonials.name")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "name", isset($item->name) ? $item->name : old("name") , "text" , "testimonials") !!}
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
		 <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
			<label for="title">{{ trans("testimonials.title")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "testimonials") !!}
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
		 <div class="form-group  {{  $errors->has("message.en")  &&  $errors->has("message.ar")  ? "has-error" : "" }}" >
			<label for="message">{{ trans("testimonials.message")}}</label>
				<input type="text" name="message" class="form-control" id="message" value="{{ isset($item->message) ? $item->message : old("message") }}"  placeholder="{{ trans("testimonials.message")}}">
		</div>
			@if ($errors->has("message.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("message.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("message.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("message.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
			<label for="image">{{ trans("testimonials.image")}}</label>
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

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.testimonials') }}
                </button>
            </div>
        </form>
</div>
@endsection
