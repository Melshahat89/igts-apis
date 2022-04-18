@extends(layoutExtend('website'))
  @section('title')
    {{ trans('quizquestions.quizquestions') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('quizquestions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizquestions.question") }}</th>
     <td>{{ nl2br($item->question_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizquestions.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizquestions.mark") }}</th>
     <td>{{ nl2br($item->mark) }}</td>
    </tr>
  </table>
          @include('website.quizquestions.buttons.delete' , ['id' => $item->id])
        @include('website.quizquestions.buttons.edit' , ['id' => $item->id])
</div>
@endsection
