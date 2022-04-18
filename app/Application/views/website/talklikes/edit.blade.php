@extends(layoutExtend('website'))
 @section('title')
    {{ trans('talklikes.talklikes') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('talklikes') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('talklikes/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.talklikes.relation.user.edit")
            @include("website.talklikes.relation.talks.edit")
                <div class="form-group {{ $errors->has("comment") ? "has-error" : "" }}" > 
   <label for="comment">{{ trans("talklikes.comment")}}</label>
    <input type="text" name="comment" class="form-control" id="comment" value="{{ isset($item->comment) ? $item->comment : old("comment") }}"  placeholder="{{ trans("talklikes.comment")}}">
  </div>
   @if ($errors->has("comment"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("comment") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("talklikes.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("talklikes.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("talklikes.Yes")}}
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
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.talklikes') }}
                </button>
            </div>
        </form>
</div>
@endsection
