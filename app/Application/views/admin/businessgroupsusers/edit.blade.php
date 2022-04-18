@extends(layoutExtend())
 @section('title')
    {{ trans('businessgroupsusers.businessgroupsusers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('businessgroupsusers.businessgroupsusers') , 'model' => 'businessgroupsusers' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/businessgroupsusers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.businessgroupsusers.relation.user.edit")
            @include("admin.businessgroupsusers.relation.businessgroups.edit")
     <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("businessgroupsusers.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("businessgroupsusers.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("businessgroupsusers.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("note") ? "has-error" : "" }}" > 
   <label for="note">{{ trans("businessgroupsusers.note")}}</label>
    <input type="text" name="note" class="form-control" id="note" value="{{ isset($item->note) ? $item->note : old("note") }}"  placeholder="{{ trans("businessgroupsusers.note")}}">
  </div>
   @if ($errors->has("note"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("note") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('businessgroupsusers.businessgroupsusers') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
