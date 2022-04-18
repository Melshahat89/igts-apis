@extends(layoutExtend())

@section('title')
{{ trans('partnership.partnership') }} {{ isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
@component(layoutForm() , ['title' => trans('partnership.partnership') , 'model' => 'partnership' , 'action' => isset($item) ? trans('home.edit') : trans('home.add') ])
@include(layoutMessage())
<form action="{{ concatenateLangToUrl('lazyadmin/partnership/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    @include("admin.partnership.relation.user.edit")

    <div class="form-group {{ $errors->has("certificates") ? "has-error" : "" }}" > 
    <label for="certificates">{{ trans("eventsdata.certificates")}}</label>
     @isset($item)
						@if(json_decode($item->certificates))
							<input type="hidden" name="oldFiles_certificates" value="{{ $item->certificates }}">
							@php $certificates = returnFilesImages($item , "certificates"); @endphp
							<div class="row text-center">
								@foreach($certificates["image"] as $jsonimage )
									<div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" class="img-responsive" /><br>
									<a class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/partnership/".$item->id."?name=".$jsonimage."&filed_name=certificates") }}"><i class="fa fa-trash"></i></a></div>
								@endforeach
							</div>
							<div class="row text-center">
								@foreach($certificates["file"] as $jsonimage )
									<div class="col-lg-2 text-center"><a href="{{ url(env("UPLOAD_PATH")."/".$jsonimage) }}" ><i class="fa fa-file"></i></a>
									<span  onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/partnership/".$item->id."?name=".$jsonimage."&filed_name=certificates") }}"><i class="fa fa-trash"></i> {{ $jsonimage }} </span></div>
								@endforeach
							</div>
						@endif
					@endisset
     <input type="file" name="certificates[]" multiple>
   </div>
    @if ($errors->has("certificates"))
     <div class="alert alert-danger">
      <span class='help-block'>
       <strong>{{ $errors->first("certificates") }}</strong>
      </span>
     </div>
    @endif
  


    <div class="form-group {{ $errors->has("setting") ? "has-error" : "" }}">
        <label for="setting">{{ trans("partnership.setting")}}</label>
        <input type="text" name="setting" class="form-control" id="setting" value="{{ isset($item->setting) ? $item->setting : old("setting") }}" placeholder="{{ trans("partnership.setting")}}">
    </div>
    @if ($errors->has("setting"))
    <div class="alert alert-danger">
        <span class='help-block'>
            <strong>{{ $errors->first("setting") }}</strong>
        </span>
    </div>
    @endif


    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-default">
            <i class="material-icons">check_circle</i>
            {{ trans('home.save') }} {{ trans('partnership.partnership') }}
        </button>
    </div>
</form>
@endcomponent
@endsection