@extends(layoutExtend())
 @section('title')
    {{ trans('promotionactive.promotionactive') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('promotionactive.promotionactive') , 'model' => 'promotionactive' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/promotionactive/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.promotionactive.relation.user.edit")
            @include("admin.promotionactive.relation.promotions.edit")
     <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("promotionactive.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("promotionactive.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("promotionactive.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('promotionactive.promotionactive') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
