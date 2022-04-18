@extends(layoutExtend())
 @section('title')
    {{ trans('talksreviews.talksreviews') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('talksreviews.talksreviews') , 'model' => 'talksreviews' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/talksreviews/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.talksreviews.relation.talks.edit")
            @include("admin.talksreviews.relation.user.edit")
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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('talksreviews.talksreviews') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
