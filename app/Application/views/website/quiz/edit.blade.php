@extends(layoutExtend('website'))
 @section('title')
    {{ trans('quiz.quiz') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('quiz') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('quiz/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.quiz.relation.coursesections.edit")
            @include("website.quiz.relation.courses.edit")
                <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("quiz.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "quiz") !!}
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
   <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
   <label for="description">{{ trans("quiz.description")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "text" , "quiz") !!}
  </div>
   @if ($errors->has("description.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("description.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("description.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("description.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("instructions") ? "has-error" : "" }}" > 
   <label for="instructions">{{ trans("quiz.instructions")}}</label>
    <input type="text" name="instructions" class="form-control" id="instructions" value="{{ isset($item->instructions) ? $item->instructions : old("instructions") }}"  placeholder="{{ trans("quiz.instructions")}}">
  </div>
   @if ($errors->has("instructions"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("instructions") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("time") ? "has-error" : "" }}" > 
   <label for="time">{{ trans("quiz.time")}}</label>
     <input type="text" name="time" class="form-control time" id="time" value="{{ isset($item->time) ? $item->time : old("time") }}"  placeholder="{{ trans("quiz.time")}}" > 
  </div>
   @if ($errors->has("time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("time_in_mins") ? "has-error" : "" }}" > 
   <label for="time_in_mins">{{ trans("quiz.time_in_mins")}}</label>
    <input type="text" name="time_in_mins" class="form-control" id="time_in_mins" value="{{ isset($item->time_in_mins) ? $item->time_in_mins : old("time_in_mins") }}"  placeholder="{{ trans("quiz.time_in_mins")}}">
  </div>
   @if ($errors->has("time_in_mins"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("time_in_mins") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("quiz.type")}}</label>
    <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("quiz.type")}}">
  </div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("pass_percentage") ? "has-error" : "" }}" > 
   <label for="pass_percentage">{{ trans("quiz.pass_percentage")}}</label>
    <input type="text" name="pass_percentage" class="form-control" id="pass_percentage" value="{{ isset($item->pass_percentage) ? $item->pass_percentage : old("pass_percentage") }}"  placeholder="{{ trans("quiz.pass_percentage")}}">
  </div>
   @if ($errors->has("pass_percentage"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("pass_percentage") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.quiz') }}
                </button>
            </div>
        </form>
</div>
@endsection
