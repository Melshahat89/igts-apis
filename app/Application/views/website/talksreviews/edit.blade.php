@extends(layoutExtend('website'))
 @section('title')
    {{ trans('talksreviews.talksreviews') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('talksreviews') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('talksreviews/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.talksreviews.relation.talks.edit")
            @include("website.talksreviews.relation.user.edit")
                <div class="form-group {{ $errors->has("review") ? "has-error" : "" }}" > 
   <label for="review">{{ trans("talksreviews.review")}}</label>
    <input type="text" name="review" class="form-control" id="review" value="{{ isset($item->review) ? $item->review : old("review") }}"  placeholder="{{ trans("talksreviews.review")}}">
  </div>
   @if ($errors->has("review"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("review") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("rating") ? "has-error" : "" }}" > 
   <label for="rating">{{ trans("talksreviews.rating")}}</label>
    <input type="text" name="rating" class="form-control" id="rating" value="{{ isset($item->rating) ? $item->rating : old("rating") }}"  placeholder="{{ trans("talksreviews.rating")}}">
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
                    {{ trans('website.Update') }}  {{ trans('website.talksreviews') }}
                </button>
            </div>
        </form>
</div>
@endsection
