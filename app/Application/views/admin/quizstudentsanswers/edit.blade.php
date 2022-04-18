@extends(layoutExtend())
 @section('title')
    {{ trans('quizstudentsanswers.quizstudentsanswers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('quizstudentsanswers.quizstudentsanswers') , 'model' => 'quizstudentsanswers' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/quizstudentsanswers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.quizstudentsanswers.relation.quizstudentsstatus.edit")
            @include("admin.quizstudentsanswers.relation.quiz.edit")
            @include("admin.quizstudentsanswers.relation.quizquestions.edit")
            @include("admin.quizstudentsanswers.relation.quizquestionschoice.edit")
            @include("admin.quizstudentsanswers.relation.user.edit")
     <div class="form-group {{ $errors->has("is_correct") ? "has-error" : "" }}" > 
   <label for="is_correct">{{ trans("quizstudentsanswers.is_correct")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("quizstudentsanswers.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("quizstudentsanswers.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("is_correct"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("is_correct") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("answered") ? "has-error" : "" }}" > 
   <label for="answered">{{ trans("quizstudentsanswers.answered")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="answered" {{ isset($item->answered) && $item->answered == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("quizstudentsanswers.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="answered" {{ isset($item->answered) && $item->answered == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("quizstudentsanswers.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("answered"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("answered") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("mark") ? "has-error" : "" }}" > 
   <label for="mark">{{ trans("quizstudentsanswers.mark")}}</label>
    <input type="text" name="mark" class="form-control" id="mark" value="{{ isset($item->mark) ? $item->mark : old("mark") }}"  placeholder="{{ trans("quizstudentsanswers.mark")}}">
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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('quizstudentsanswers.quizstudentsanswers') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
