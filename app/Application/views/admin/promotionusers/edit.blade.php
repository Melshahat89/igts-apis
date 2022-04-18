@extends(layoutExtend())
 @section('title')
    {{ trans('promotionusers.promotionusers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('promotionusers.promotionusers') , 'model' => 'promotionusers' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/promotionusers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.promotionusers.relation.orders.edit")
            @include("admin.promotionusers.relation.user.edit")
            @include("admin.promotionusers.relation.promotions.edit")
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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('promotionusers.promotionusers') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
