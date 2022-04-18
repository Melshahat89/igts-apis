@extends(layoutExtend('website'))
 @section('title')
    {{ trans('progress.progress') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('progress') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('progress/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.progress.relation.courselectures.edit")
            @include("website.progress.relation.courses.edit")
            @include("website.progress.relation.user.edit")
                <div class="form-group {{ $errors->has("percentage") ? "has-error" : "" }}" > 
   <label for="percentage">{{ trans("progress.percentage")}}</label>
    <input type="text" name="percentage" class="form-control" id="percentage" value="{{ isset($item->percentage) ? $item->percentage : old("percentage") }}"  placeholder="{{ trans("progress.percentage")}}">
  </div>
   @if ($errors->has("percentage"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("percentage") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("note") ? "has-error" : "" }}" > 
   <label for="note">{{ trans("progress.note")}}</label>
    <input type="text" name="note" class="form-control" id="note" value="{{ isset($item->note) ? $item->note : old("note") }}"  placeholder="{{ trans("progress.note")}}">
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
                    {{ trans('website.Update') }}  {{ trans('website.progress') }}
                </button>
            </div>
        </form>
</div>
@endsection
