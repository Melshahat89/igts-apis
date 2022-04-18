@extends(layoutExtend('website'))
 @section('title')
    {{ trans('quizquestionschoice.quizquestionschoice') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('quizquestionschoice') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('quizquestionschoice/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.quizquestionschoice.relation.quizquestions.edit")
                <div class="form-group  {{  $errors->has("choice.en")  &&  $errors->has("choice.ar")  ? "has-error" : "" }}" >
   <label for="choice">{{ trans("quizquestionschoice.choice")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "choice", isset($item->choice) ? $item->choice : old("choice") , "text" , "quizquestionschoice") !!}
  </div>
   @if ($errors->has("choice.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("choice.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("choice.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("choice.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("is_correct") ? "has-error" : "" }}" > 
   <label for="is_correct">{{ trans("quizquestionschoice.is_correct")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("quizquestionschoice.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("quizquestionschoice.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("is_correct"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("is_correct") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.quizquestionschoice') }}
                </button>
            </div>
        </form>
</div>
@endsection
