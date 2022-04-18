@extends(layoutExtend2())
 @section('title')
    {{ trans('quizquestions.quizquestions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('quizquestions.quizquestions') , 'model' => 'quizquestions' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/quizquestions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.quizquestions.relation.quiz.edit")
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
   

   <div class="form-group" >
   <label for="choice">Choices</label>
    <div id="laraflat-choice">
    @php $i = 0; @endphp
     @if(isset($item) && isset($item->quizquestionschoice))
     
       @foreach($item->quizquestionschoice as $choice)
       @php $i++; @endphp
       {!! extractTextFiledAutoIncrement($choice, "choice", '' , $choice->choice, null, $i) !!}
       @endforeach
      @endif
      <hr>
      <span class="btn btn-success" onclick="AddNewchoice()"><i class="fa fa-plus"></i></span>

     </div>
  </div>
  
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('quizquestions.quizquestions') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
