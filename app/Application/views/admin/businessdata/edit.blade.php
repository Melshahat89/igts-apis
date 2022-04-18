@extends(layoutExtend())
 @section('title')
    {{ trans('businessdata.businessdata') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('businessdata.businessdata') , 'model' => 'businessdata' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/businessdata/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.businessdata.relation.user.edit")
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
   <div class="form-group {{ $errors->has("discount_value_dollar") ? "has-error" : "" }}" > 
   <label for="discount_value_dollar">{{ trans("businessdata.discount_value_dollar")}}</label>
    <input type="text" name="discount_value_dollar" class="form-control" id="discount_value_dollar" value="{{ isset($item->discount_value_dollar) ? $item->discount_value_dollar : old("discount_value_dollar") }}"  placeholder="{{ trans("businessdata.discount_value_dollar")}}">
  </div>
   @if ($errors->has("discount_value_dollar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_value_dollar") }}</strong>
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

   <div class="form-group {{ $errors->has("licenses") ? "has-error" : "" }}" > 
   <label for="licenses">{{ trans("businessdata.Licenses")}}</label>
   <input type="text" name="licenses" class="form-control" id="licenses" value="{{ isset($item->licenses) ? $item->licenses : old("licenses") }}"  placeholder="{{ trans("businessdata.licenses")}}">

   @if ($errors->has("licenses"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("licenses") }}</strong>
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

   <div class="form-group {{ $errors->has("start_time") ? "has-error" : "" }}" > 
    <label for="start_time">{{ trans("courseenrollment.start_time")}}</label>
     <input type="date" name="start_time" class="form-control" id="start_time" value="{{ isset($item->start_time) ? $item->start_time : old("start_time") }}"  placeholder="{{ trans("courseenrollment.start_time")}}">
   </div>
    @if ($errors->has("start_time"))
     <div class="alert alert-danger">
      <span class='help-block'>
       <strong>{{ $errors->first("start_time") }}</strong>
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
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('businessdata.businessdata') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
