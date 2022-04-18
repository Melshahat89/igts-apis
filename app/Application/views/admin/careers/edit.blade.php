@extends(layoutExtend())

@section('title')
    {{ trans('careers.careers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('careers.careers') , 'model' => 'careers' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/careers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
			<label for="title">{{ trans("careers.title")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "careers") !!}
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
			<label for="description">{{ trans("careers.description")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "careers", "tinymce") !!}

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
			<div class="form-group {{ $errors->has("link") ? "has-error" : "" }}" >
                <label for="link">{{ trans("careers.link")}}</label>
                <input type="text" name="link" class="form-control" id="link" value="{{ isset($item->link) ? $item->link : old("link") }}"  placeholder="{{ trans("careers.link")}}">
            </div>
            @if ($errors->has("link"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("link") }}</strong>
                     </span>
                </div>
            @endif
		 <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
			<label for="image">{{ trans("careers.image")}}</label>
				@if(isset($item) && $item->image != "")
				<a class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/careers/".$item->id."?name=" . $item->image) }}"><i class="fa fa-trash"></i></a></div>

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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('careers.careers') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
@section('script')
@include(layoutPath('layout.helpers.tynic'))
@endsection