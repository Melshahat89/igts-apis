@extends(layoutExtend())
  @section('title')
    {{ trans('quizquestions.quizquestions') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('quizquestions.quizquestions') , 'model' => 'quizquestions' , 'action' => trans('home.view')  ])
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
          @include('admin.quizquestions.buttons.delete' , ['id' => $item->id])
        @include('admin.quizquestions.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
