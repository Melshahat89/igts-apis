@extends(layoutExtend())
 @section('title')
    {{ trans('quizstudentsstatus.quizstudentsstatus') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('quizstudentsstatus.quizstudentsstatus') , 'model' => 'quizstudentsstatus' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/quizstudentsstatus/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.quizstudentsstatus.relation.user.edit")
            @include("admin.quizstudentsstatus.relation.quiz.edit")
     <div class="form-group {{ $errors->has("start_time") ? "has-error" : "" }}" > 
   <label for="start_time">{{ trans("quizstudentsstatus.start_time")}}</label>
    <input type="date" name="start_time" class="form-control datepicker" id="start_time" value="{{ isset($item->start_time) ? $item->start_time : old("start_time") }}"  placeholder="{{ trans("quizstudentsstatus.start_time")}}">
  </div>
   @if ($errors->has("start_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("start_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("end_time") ? "has-error" : "" }}" > 
   <label for="end_time">{{ trans("quizstudentsstatus.end_time")}}</label>
    <input type="date" name="end_time" class="form-control datepicker" id="end_time" value="{{ isset($item->end_time) ? $item->end_time : old("end_time") }}"  placeholder="{{ trans("quizstudentsstatus.end_time")}}">
  </div>
   @if ($errors->has("end_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("end_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("pause_time") ? "has-error" : "" }}" > 
   <label for="pause_time">{{ trans("quizstudentsstatus.pause_time")}}</label>
    <input type="text" name="pause_time" class="form-control" id="pause_time" value="{{ isset($item->pause_time) ? $item->pause_time : old("pause_time") }}"  placeholder="{{ trans("quizstudentsstatus.pause_time")}}">
  </div>
   @if ($errors->has("pause_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("pause_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("quizstudentsstatus.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("quizstudentsstatus.status")}}">
  </div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("skipped_question_id") ? "has-error" : "" }}" > 
   <label for="skipped_question_id">{{ trans("quizstudentsstatus.skipped_question_id")}}</label>
    <input type="text" name="skipped_question_id" class="form-control" id="skipped_question_id" value="{{ isset($item->skipped_question_id) ? $item->skipped_question_id : old("skipped_question_id") }}"  placeholder="{{ trans("quizstudentsstatus.skipped_question_id")}}">
  </div>
   @if ($errors->has("skipped_question_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("skipped_question_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("passed") ? "has-error" : "" }}" > 
   <label for="passed">{{ trans("quizstudentsstatus.passed")}}</label>
    <input type="text" name="passed" class="form-control" id="passed" value="{{ isset($item->passed) ? $item->passed : old("passed") }}"  placeholder="{{ trans("quizstudentsstatus.passed")}}">
  </div>
   @if ($errors->has("passed"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("passed") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("exam_anytime") ? "has-error" : "" }}" > 
   <label for="exam_anytime">{{ trans("quizstudentsstatus.exam_anytime")}}</label>
    <input type="text" name="exam_anytime" class="form-control" id="exam_anytime" value="{{ isset($item->exam_anytime) ? $item->exam_anytime : old("exam_anytime") }}"  placeholder="{{ trans("quizstudentsstatus.exam_anytime")}}">
  </div>
   @if ($errors->has("exam_anytime"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("exam_anytime") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('quizstudentsstatus.quizstudentsstatus') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
