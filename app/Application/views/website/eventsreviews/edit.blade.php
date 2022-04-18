@extends(layoutExtend('website'))
 @section('title')
    {{ trans('eventsreviews.eventsreviews') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('eventsreviews') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('eventsreviews/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.eventsreviews.relation.events.edit")
            @include("website.eventsreviews.relation.user.edit")
                <div class="form-group {{ $errors->has("review") ? "has-error" : "" }}" > 
   <label for="review">{{ trans("eventsreviews.review")}}</label>
    <input type="text" name="review" class="form-control" id="review" value="{{ isset($item->review) ? $item->review : old("review") }}"  placeholder="{{ trans("eventsreviews.review")}}">
  </div>
   @if ($errors->has("review"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("review") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("rating") ? "has-error" : "" }}" > 
   <label for="rating">{{ trans("eventsreviews.rating")}}</label>
    <input type="text" name="rating" class="form-control" id="rating" value="{{ isset($item->rating) ? $item->rating : old("rating") }}"  placeholder="{{ trans("eventsreviews.rating")}}">
  </div>
   @if ($errors->has("rating"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("rating") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.eventsreviews') }}
                </button>
            </div>
        </form>
</div>
@endsection
