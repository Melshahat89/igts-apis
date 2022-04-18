@extends(layoutExtend('website'))
 @section('title')
    {{ trans('promotionusers.promotionusers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('promotionusers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('promotionusers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.promotionusers.relation.orders.edit")
            @include("website.promotionusers.relation.user.edit")
            @include("website.promotionusers.relation.promotions.edit")
                <div class="form-group {{ $errors->has("used") ? "has-error" : "" }}" > 
   <label for="used">{{ trans("promotionusers.used")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="used" {{ isset($item->used) && $item->used == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("promotionusers.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="used" {{ isset($item->used) && $item->used == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("promotionusers.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("used"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("used") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.promotionusers') }}
                </button>
            </div>
        </form>
</div>
@endsection
