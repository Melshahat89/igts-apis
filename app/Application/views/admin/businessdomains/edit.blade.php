@extends(layoutExtend())
 @section('title')
    {{ trans('businessdomains.businessdomains') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('businessdomains.businessdomains') , 'model' => 'businessdomains' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/businessdomains/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.businessdomains.relation.businessdata.edit")
     <div class="form-group {{ $errors->has("domainname") ? "has-error" : "" }}" > 
   <label for="domainname">{{ trans("businessdomains.domainname")}}</label>
    <input type="text" name="domainname" class="form-control" id="domainname" value="{{ isset($item->domainname) ? $item->domainname : old("domainname") }}"  placeholder="{{ trans("businessdomains.domainname")}}">
  </div>
   @if ($errors->has("domainname"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("domainname") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("businessdomains.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("businessdomains.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("businessdomains.Yes")}}
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
                    {{ trans('home.save') }}  {{ trans('businessdomains.businessdomains') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
