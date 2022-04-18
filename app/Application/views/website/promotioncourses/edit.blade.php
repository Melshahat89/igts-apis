@extends(layoutExtend('website'))
 @section('title')
    {{ trans('promotioncourses.promotioncourses') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('promotioncourses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('promotioncourses/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.promotioncourses.relation.courses.edit")
            @include("website.promotioncourses.relation.promotions.edit")
                <div class="form-group {{ $errors->has("note") ? "has-error" : "" }}" > 
   <label for="note">{{ trans("promotioncourses.note")}}</label>
    <input type="text" name="note" class="form-control" id="note" value="{{ isset($item->note) ? $item->note : old("note") }}"  placeholder="{{ trans("promotioncourses.note")}}">
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
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.promotioncourses') }}
                </button>
            </div>
        </form>
</div>
@endsection
