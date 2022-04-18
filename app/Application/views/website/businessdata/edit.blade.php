@extends(layoutExtend('website'))
 @section('title')
    {{ trans('businessdata.businessdata') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('businessdata') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('businessdata/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.businessdata.relation.user.edit")
                <div class="form-group  {{  $errors->has("name.en")  &&  $errors->has("name.ar")  ? "has-error" : "" }}" >
   <label for="name">{{ trans("businessdata.name")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "name", isset($item->name) ? $item->name : old("name") , "text" , "businessdata") !!}
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
   <div class="form-group {{ $errors->has("discount_type") ? "has-error" : "" }}" > 
   <label for="discount_type">{{ trans("businessdata.discount_type")}}</label>
    <input type="text" name="discount_type" class="form-control" id="discount_type" value="{{ isset($item->discount_type) ? $item->discount_type : old("discount_type") }}"  placeholder="{{ trans("businessdata.discount_type")}}">
  </div>
   @if ($errors->has("discount_type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("discount_value") ? "has-error" : "" }}" > 
   <label for="discount_value">{{ trans("businessdata.discount_value")}}</label>
    <input type="text" name="discount_value" class="form-control" id="discount_value" value="{{ isset($item->discount_value) ? $item->discount_value : old("discount_value") }}"  placeholder="{{ trans("businessdata.discount_value")}}">
  </div>
   @if ($errors->has("discount_value"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_value") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("automatically_license") ? "has-error" : "" }}" > 
   <label for="automatically_license">{{ trans("businessdata.automatically_license")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="automatically_license" {{ isset($item->automatically_license) && $item->automatically_license == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("businessdata.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="automatically_license" {{ isset($item->automatically_license) && $item->automatically_license == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("businessdata.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("automatically_license"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("automatically_license") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("logo") ? "has-error" : "" }}" > 
   <label for="logo">{{ trans("businessdata.logo")}}</label>
    @if(isset($item) && $item->logo != "")
    <br>
    <img src="{{ small($item->logo) }}" class="thumbnail" alt="" width="200">
    <br>
    @endif
    <input type="file" name="logo" >
  </div>
   @if ($errors->has("logo"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("logo") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("businessdata.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("businessdata.status")}}">
  </div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.businessdata') }}
                </button>
            </div>
        </form>
</div>
@endsection
