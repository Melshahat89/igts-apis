@extends(layoutExtend())
  @section('title')
    {{ trans('quizquestionschoice.quizquestionschoice') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('quizquestionschoice.quizquestionschoice') , 'model' => 'quizquestionschoice' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizquestionschoice.choice") }}</th>
     <td>{{ nl2br($item->choice_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizquestionschoice.is_correct") }}</th>
     <td>
    {{ $item->is_correct == 1 ? trans("quizquestionschoice.Yes") : trans("quizquestionschoice.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.quizquestionschoice.buttons.delete' , ['id' => $item->id])
        @include('admin.quizquestionschoice.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
