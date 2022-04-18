@extends(layoutExtend('website'))
  @section('title')
    {{ trans('quizstudentsstatus.quizstudentsstatus') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('quizstudentsstatus') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.start_time") }}</th>
     <td>{{ nl2br($item->start_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.end_time") }}</th>
     <td>{{ nl2br($item->end_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.pause_time") }}</th>
     <td>{{ nl2br($item->pause_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.skipped_question_id") }}</th>
     <td>{{ nl2br($item->skipped_question_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.passed") }}</th>
     <td>{{ nl2br($item->passed) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsstatus.exam_anytime") }}</th>
     <td>{{ nl2br($item->exam_anytime) }}</td>
    </tr>
  </table>
          @include('website.quizstudentsstatus.buttons.delete' , ['id' => $item->id])
        @include('website.quizstudentsstatus.buttons.edit' , ['id' => $item->id])
</div>
@endsection
