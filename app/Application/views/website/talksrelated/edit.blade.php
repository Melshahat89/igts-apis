@extends(layoutExtend('website'))
 @section('title')
    {{ trans('talksrelated.talksrelated') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('talksrelated') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('talksrelated/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.talksrelated.relation.talks.edit")
                <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("talksrelated.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("talksrelated.position")}}">
  </div>
   @if ($errors->has("position"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("position") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.talksrelated') }}
                </button>
            </div>
        </form>
</div>
@endsection
