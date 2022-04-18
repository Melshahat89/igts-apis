@extends(layoutExtend())
  @section('title')
    {{ trans('lecturequestions.lecturequestions') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('lecturequestions.lecturequestions') , 'model' => 'lecturequestions' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("lecturequestions.question_title") }}</th>
     <td>{{ nl2br($item->question_title) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("lecturequestions.question_description") }}</th>
     <td>{{ nl2br($item->question_description) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("lecturequestions.approve") }}</th>
     <td>
    {{ $item->approve == 1 ? trans("lecturequestions.Yes") : trans("lecturequestions.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.lecturequestions.buttons.delete' , ['id' => $item->id])
        @include('admin.lecturequestions.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
