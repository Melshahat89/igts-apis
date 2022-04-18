@extends(layoutExtend('website'))
 @section('title')
    {{ trans('courses.courses') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('courses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('courses/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.courses.relation.categories.edit")
                <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("courses.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courses") !!}
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
   <div class="form-group {{ $errors->has("slug") ? "has-error" : "" }}" > 
   <label for="slug">{{ trans("courses.slug")}}</label>
    <input type="text" name="slug" class="form-control" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("courses.slug")}}">
  </div>
   @if ($errors->has("slug"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("slug") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
   <label for="description">{{ trans("courses.description")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "courses" ) !!}
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
   <div class="form-group  {{  $errors->has("welcome_message.en")  &&  $errors->has("welcome_message.ar")  ? "has-error" : "" }}" >
   <label for="welcome_message">{{ trans("courses.welcome_message")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "welcome_message", isset($item->welcome_message) ? $item->welcome_message : old("welcome_message") , "text" , "courses") !!}
  </div>
   @if ($errors->has("welcome_message.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("welcome_message.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("welcome_message.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("welcome_message.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("congratulation_message.en")  &&  $errors->has("congratulation_message.ar")  ? "has-error" : "" }}" >
   <label for="congratulation_message">{{ trans("courses.congratulation_message")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "congratulation_message", isset($item->congratulation_message) ? $item->congratulation_message : old("congratulation_message") , "text" , "courses") !!}
  </div>
   @if ($errors->has("congratulation_message.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("congratulation_message.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("congratulation_message.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("congratulation_message.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("courses.type")}}</label>
    <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("courses.type")}}">
  </div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("skill_level") ? "has-error" : "" }}" > 
   <label for="skill_level">{{ trans("courses.skill_level")}}</label>
    <input type="text" name="skill_level" class="form-control" id="skill_level" value="{{ isset($item->skill_level) ? $item->skill_level : old("skill_level") }}"  placeholder="{{ trans("courses.skill_level")}}">
  </div>
   @if ($errors->has("skill_level"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("skill_level") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("language_id") ? "has-error" : "" }}" > 
   <label for="language_id">{{ trans("courses.language_id")}}</label>
    <input type="text" name="language_id" class="form-control" id="language_id" value="{{ isset($item->language_id) ? $item->language_id : old("language_id") }}"  placeholder="{{ trans("courses.language_id")}}">
  </div>
   @if ($errors->has("language_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("language_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("has_captions") ? "has-error" : "" }}" > 
   <label for="has_captions">{{ trans("courses.has_captions")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="has_captions" {{ isset($item->has_captions) && $item->has_captions == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="has_captions" {{ isset($item->has_captions) && $item->has_captions == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("has_captions"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("has_captions") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("has_certificate") ? "has-error" : "" }}" > 
   <label for="has_certificate">{{ trans("courses.has_certificate")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="has_certificate" {{ isset($item->has_certificate) && $item->has_certificate == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="has_certificate" {{ isset($item->has_certificate) && $item->has_certificate == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("has_certificate"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("has_certificate") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("length") ? "has-error" : "" }}" > 
   <label for="length">{{ trans("courses.length")}}</label>
    <input type="text" name="length" class="form-control" id="length" value="{{ isset($item->length) ? $item->length : old("length") }}"  placeholder="{{ trans("courses.length")}}">
  </div>
   @if ($errors->has("length"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("length") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("price") ? "has-error" : "" }}" > 
   <label for="price">{{ trans("courses.price")}}</label>
    <input type="text" name="price" class="form-control" id="price" value="{{ isset($item->price) ? $item->price : old("price") }}"  placeholder="{{ trans("courses.price")}}">
  </div>
   @if ($errors->has("price"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("price_in_dollar") ? "has-error" : "" }}" > 
   <label for="price_in_dollar">{{ trans("courses.price_in_dollar")}}</label>
    <input type="text" name="price_in_dollar" class="form-control" id="price_in_dollar" value="{{ isset($item->price_in_dollar) ? $item->price_in_dollar : old("price_in_dollar") }}"  placeholder="{{ trans("courses.price_in_dollar")}}">
  </div>
   @if ($errors->has("price_in_dollar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price_in_dollar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("affiliate1_per") ? "has-error" : "" }}" > 
   <label for="affiliate1_per">{{ trans("courses.affiliate1_per")}}</label>
    <input type="text" name="affiliate1_per" class="form-control" id="affiliate1_per" value="{{ isset($item->affiliate1_per) ? $item->affiliate1_per : old("affiliate1_per") }}"  placeholder="{{ trans("courses.affiliate1_per")}}">
  </div>
   @if ($errors->has("affiliate1_per"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate1_per") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("affiliate2_per") ? "has-error" : "" }}" > 
   <label for="affiliate2_per">{{ trans("courses.affiliate2_per")}}</label>
    <input type="text" name="affiliate2_per" class="form-control" id="affiliate2_per" value="{{ isset($item->affiliate2_per) ? $item->affiliate2_per : old("affiliate2_per") }}"  placeholder="{{ trans("courses.affiliate2_per")}}">
  </div>
   @if ($errors->has("affiliate2_per"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate2_per") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("affiliate3_per") ? "has-error" : "" }}" > 
   <label for="affiliate3_per">{{ trans("courses.affiliate3_per")}}</label>
    <input type="text" name="affiliate3_per" class="form-control" id="affiliate3_per" value="{{ isset($item->affiliate3_per) ? $item->affiliate3_per : old("affiliate3_per") }}"  placeholder="{{ trans("courses.affiliate3_per")}}">
  </div>
   @if ($errors->has("affiliate3_per"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate3_per") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("affiliate4_per") ? "has-error" : "" }}" > 
   <label for="affiliate4_per">{{ trans("courses.affiliate4_per")}}</label>
    <input type="text" name="affiliate4_per" class="form-control" id="affiliate4_per" value="{{ isset($item->affiliate4_per) ? $item->affiliate4_per : old("affiliate4_per") }}"  placeholder="{{ trans("courses.affiliate4_per")}}">
  </div>
   @if ($errors->has("affiliate4_per"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate4_per") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("instructor_per") ? "has-error" : "" }}" > 
   <label for="instructor_per">{{ trans("courses.instructor_per")}}</label>
    <input type="text" name="instructor_per" class="form-control" id="instructor_per" value="{{ isset($item->instructor_per) ? $item->instructor_per : old("instructor_per") }}"  placeholder="{{ trans("courses.instructor_per")}}">
  </div>
   @if ($errors->has("instructor_per"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("instructor_per") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("discount_egp") ? "has-error" : "" }}" > 
   <label for="discount_egp">{{ trans("courses.discount_egp")}}</label>
    <input type="text" name="discount_egp" class="form-control" id="discount_egp" value="{{ isset($item->discount_egp) ? $item->discount_egp : old("discount_egp") }}"  placeholder="{{ trans("courses.discount_egp")}}">
  </div>
   @if ($errors->has("discount_egp"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_egp") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("discount_usd") ? "has-error" : "" }}" > 
   <label for="discount_usd">{{ trans("courses.discount_usd")}}</label>
    <input type="text" name="discount_usd" class="form-control" id="discount_usd" value="{{ isset($item->discount_usd) ? $item->discount_usd : old("discount_usd") }}"  placeholder="{{ trans("courses.discount_usd")}}">
  </div>
   @if ($errors->has("discount_usd"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_usd") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("featured") ? "has-error" : "" }}" > 
   <label for="featured">{{ trans("courses.featured")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("featured"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("featured") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
   <label for="image">{{ trans("courses.image")}}</label>
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
   <div class="form-group {{ $errors->has("promo_video") ? "has-error" : "" }}" > 
   <label for="promo_video">{{ trans("courses.promo_video")}}</label>
    <input type="text" name="promo_video" class="form-control" id="promo_video" value="{{ isset($item->promo_video) ? $item->promo_video : old("promo_video") }}"  placeholder="{{ trans("courses.promo_video")}}">
  </div>
   @if ($errors->has("promo_video"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("promo_video") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("visits") ? "has-error" : "" }}" > 
   <label for="visits">{{ trans("courses.visits")}}</label>
    <input type="text" name="visits" class="form-control" id="visits" value="{{ isset($item->visits) ? $item->visits : old("visits") }}"  placeholder="{{ trans("courses.visits")}}">
  </div>
   @if ($errors->has("visits"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("visits") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("published") ? "has-error" : "" }}" > 
   <label for="published">{{ trans("courses.published")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("published"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("published") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("courses.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("courses.position")}}">
  </div>
   @if ($errors->has("position"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("position") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("sort") ? "has-error" : "" }}" > 
   <label for="sort">{{ trans("courses.sort")}}</label>
    <input type="text" name="sort" class="form-control" id="sort" value="{{ isset($item->sort) ? $item->sort : old("sort") }}"  placeholder="{{ trans("courses.sort")}}">
  </div>
   @if ($errors->has("sort"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("sort") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("doctor_name.en")  &&  $errors->has("doctor_name.ar")  ? "has-error" : "" }}" >
   <label for="doctor_name">{{ trans("courses.doctor_name")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "doctor_name", isset($item->doctor_name) ? $item->doctor_name : old("doctor_name") , "text" , "courses") !!}
  </div>
   @if ($errors->has("doctor_name.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("doctor_name.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("doctor_name.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("doctor_name.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("full_access") ? "has-error" : "" }}" > 
   <label for="full_access">{{ trans("courses.full_access")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="full_access" {{ isset($item->full_access) && $item->full_access == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="full_access" {{ isset($item->full_access) && $item->full_access == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("full_access"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("full_access") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("access_time") ? "has-error" : "" }}" > 
   <label for="access_time">{{ trans("courses.access_time")}}</label>
    <input type="text" name="access_time" class="form-control" id="access_time" value="{{ isset($item->access_time) ? $item->access_time : old("access_time") }}"  placeholder="{{ trans("courses.access_time")}}">
  </div>
   @if ($errors->has("access_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("access_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("soon") ? "has-error" : "" }}" > 
   <label for="soon">{{ trans("courses.soon")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="soon" {{ isset($item->soon) && $item->soon == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courses.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="soon" {{ isset($item->soon) && $item->soon == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courses.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("soon"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("soon") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("seo_desc[].en")  &&  $errors->has("seo_desc[].ar")  ? "has-error" : "" }}" >
   <label for="seo_desc">{{ trans("courses.seo_desc")}}</label>
    <div id="laraflat-seo_desc">
     @if(isset($item) || old("seo_desc"))
      @if((isset($item->seo_desc) && json_decode($item->seo_desc) ) || old("seo_desc"))
      @php $items = isset($item->seo_desc) && json_decode($item->seo_desc) ? json_decode($item->seo_desc)  : old("seo_desc") @endphp
       @foreach($items as $jsonseo_desc)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_desc[]"  value="{{ $jsonseo_desc}}" type="text" placeholder="{{ trans("courses.seo_desc")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewseo_desc()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllseo_desc(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewseo_desc() {
                                                $("#laraflat-seo_desc").append('<div class="seo_desc form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_desc[]"  type="text" placeholder="{{ trans("courses.seo_desc")}}" >'+'<span class="btn btn-warning" onclick="removeseo_desc(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_desc(e) {
                                                $(e).closest("div.seo_desc").remove();
                                            }
                                            function clearAllseo_desc(e) {
                                                $("#laraflat-seo_desc").html("");
                                            }
                                        </script>
            @endpush
     </div>
  </div>
   @if ($errors->has("seo_desc[].en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("seo_desc[].en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("seo_desc[].ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("seo_desc[].ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("seo_keys[].en")  &&  $errors->has("seo_keys[].ar")  ? "has-error" : "" }}" >
   <label for="seo_keys">{{ trans("courses.seo_keys")}}</label>
    <div id="laraflat-seo_keys">
     @if(isset($item) || old("seo_keys"))
      @if((isset($item->seo_keys) && json_decode($item->seo_keys) ) || old("seo_keys"))
      @php $items = isset($item->seo_keys) && json_decode($item->seo_keys) ? json_decode($item->seo_keys)  : old("seo_keys") @endphp
       @foreach($items as $jsonseo_keys)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_keys[]"  value="{{ $jsonseo_keys}}" type="text" placeholder="{{ trans("courses.seo_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewseo_keys()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllseo_keys(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewseo_keys() {
                                                $("#laraflat-seo_keys").append('<div class="seo_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_keys[]"  type="text" placeholder="{{ trans("courses.seo_keys")}}" >'+'<span class="btn btn-warning" onclick="removeseo_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_keys(e) {
                                                $(e).closest("div.seo_keys").remove();
                                            }
                                            function clearAllseo_keys(e) {
                                                $("#laraflat-seo_keys").html("");
                                            }
                                        </script>
            @endpush
     </div>
  </div>
   @if ($errors->has("seo_keys[].en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("seo_keys[].en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("seo_keys[].ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("seo_keys[].ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("search_keys[].en")  &&  $errors->has("search_keys[].ar")  ? "has-error" : "" }}" >
   <label for="search_keys">{{ trans("courses.search_keys")}}</label>
    <div id="laraflat-search_keys">
     @if(isset($item) || old("search_keys"))
      @if((isset($item->search_keys) && json_decode($item->search_keys) ) || old("search_keys"))
      @php $items = isset($item->search_keys) && json_decode($item->search_keys) ? json_decode($item->search_keys)  : old("search_keys") @endphp
       @foreach($items as $jsonsearch_keys)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="search_keys[]"  value="{{ $jsonsearch_keys}}" type="text" placeholder="{{ trans("courses.search_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewsearch_keys()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllsearch_keys(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewsearch_keys() {
                                                $("#laraflat-search_keys").append('<div class="search_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="search_keys[]"  type="text" placeholder="{{ trans("courses.search_keys")}}" >'+'<span class="btn btn-warning" onclick="removesearch_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removesearch_keys(e) {
                                                $(e).closest("div.search_keys").remove();
                                            }
                                            function clearAllsearch_keys(e) {
                                                $("#laraflat-search_keys").html("");
                                            }
                                        </script>
            @endpush
     </div>
  </div>
   @if ($errors->has("search_keys[].en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("search_keys[].en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("search_keys[].ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("search_keys[].ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("poster") ? "has-error" : "" }}" > 
   <label for="poster">{{ trans("courses.poster")}}</label>
    @if(isset($item) && $item->poster != "")
    <br>
    <img src="{{ small($item->poster) }}" class="thumbnail" alt="" width="200">
    <br>
    @endif
    <input type="file" name="poster" >
  </div>
   @if ($errors->has("poster"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("poster") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.courses') }}
                </button>
            </div>
        </form>
</div>
@endsection
