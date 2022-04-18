@extends(layoutExtend('website'))
 @section('title')
    {{ trans('coursesections.coursesections') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('coursesections') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('coursesections/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.coursesections.relation.courses.edit")
                <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("coursesections.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "coursesections") !!}
  </div>
   @if ($errors->has("title.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("title.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("title.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("title.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("will_do_at_the_end.en")  &&  $errors->has("will_do_at_the_end.ar")  ? "has-error" : "" }}" >
   <label for="will_do_at_the_end">{{ trans("coursesections.will_do_at_the_end")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "will_do_at_the_end", isset($item->will_do_at_the_end) ? $item->will_do_at_the_end : old("will_do_at_the_end") , "text" , "coursesections") !!}
  </div>
   @if ($errors->has("will_do_at_the_end.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("will_do_at_the_end.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("will_do_at_the_end.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("will_do_at_the_end.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("coursesections.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("coursesections.position")}}">
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
                    {{ trans('website.Update') }}  {{ trans('website.coursesections') }}
                </button>
            </div>
        </form>
</div>
@endsection
