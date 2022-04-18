@extends(layoutExtend())
 @section('title')
    {{ trans('coursereviews.coursereviews') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('coursereviews.coursereviews') , 'model' => 'coursereviews' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/coursereviews/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.coursereviews.relation.courses.edit")
            @include("admin.coursereviews.relation.user.edit")
     <div class="form-group {{ $errors->has("review") ? "has-error" : "" }}" > 
   <label for="review">{{ trans("coursereviews.review")}}</label>
    <input type="text" name="review" class="form-control" id="review" value="{{ isset($item->review) ? $item->review : old("review") }}"  placeholder="{{ trans("coursereviews.review")}}">
  </div>
   @if ($errors->has("review"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("review") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("rating") ? "has-error" : "" }}" > 
   <label for="rating">{{ trans("coursereviews.rating")}}</label>
    <input type="text" name="rating" class="form-control" id="rating" value="{{ isset($item->rating) ? $item->rating : old("rating") }}"  placeholder="{{ trans("coursereviews.rating")}}">
  </div>
   @if ($errors->has("rating"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("rating") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("coursereviews.type")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="type" {{ isset($item->type) && $item->type == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("coursereviews.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="type" {{ isset($item->type) && $item->type == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("coursereviews.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("manual_name") ? "has-error" : "" }}" > 
   <label for="manual_name">{{ trans("coursereviews.manual_name")}}</label>
    <input type="text" name="manual_name" class="form-control" id="manual_name" value="{{ isset($item->manual_name) ? $item->manual_name : old("manual_name") }}"  placeholder="{{ trans("coursereviews.manual_name")}}">
  </div>
   @if ($errors->has("manual_name"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("manual_name") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("manual_image") ? "has-error" : "" }}" > 
   <label for="manual_image">{{ trans("coursereviews.manual_image")}}</label>
    <input type="text" name="manual_image" class="form-control" id="manual_image" value="{{ isset($item->manual_image) ? $item->manual_image : old("manual_image") }}"  placeholder="{{ trans("coursereviews.manual_image")}}">
  </div>
   @if ($errors->has("manual_image"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("manual_image") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('coursereviews.coursereviews') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
