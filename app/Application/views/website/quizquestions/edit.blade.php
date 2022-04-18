@extends(layoutExtend('website'))
 @section('title')
    {{ trans('quizquestions.quizquestions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('quizquestions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('quizquestions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.quizquestions.relation.quiz.edit")
                <div class="form-group  {{  $errors->has("question.en")  &&  $errors->has("question.ar")  ? "has-error" : "" }}" >
   <label for="question">{{ trans("quizquestions.question")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "question", isset($item->question) ? $item->question : old("question") , "text" , "quizquestions") !!}
  </div>
   @if ($errors->has("question.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("question.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("question.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("question.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("quizquestions.type")}}</label>
    <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("quizquestions.type")}}">
  </div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("mark") ? "has-error" : "" }}" > 
   <label for="mark">{{ trans("quizquestions.mark")}}</label>
    <input type="text" name="mark" class="form-control" id="mark" value="{{ isset($item->mark) ? $item->mark : old("mark") }}"  placeholder="{{ trans("quizquestions.mark")}}">
  </div>
   @if ($errors->has("mark"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("mark") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.quizquestions') }}
                </button>
            </div>
        </form>
</div>
@endsection
