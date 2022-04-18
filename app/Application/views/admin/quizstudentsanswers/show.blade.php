@extends(layoutExtend())
  @section('title')
    {{ trans('quizstudentsanswers.quizstudentsanswers') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('quizstudentsanswers.quizstudentsanswers') , 'model' => 'quizstudentsanswers' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.is_correct") }}</th>
     <td>
    {{ $item->is_correct == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.answered") }}</th>
     <td>
    {{ $item->answered == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("quizstudentsanswers.mark") }}</th>
     <td>{{ nl2br($item->mark) }}</td>
    </tr>
  </table>
          @include('admin.quizstudentsanswers.buttons.delete' , ['id' => $item->id])
        @include('admin.quizstudentsanswers.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
