@extends(layoutExtend())
  @section('title')
    {{ trans('lecturequestionsanswers.lecturequestionsanswers') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('lecturequestionsanswers.lecturequestionsanswers') , 'model' => 'lecturequestionsanswers' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("lecturequestionsanswers.answer") }}</th>
     <td>{{ nl2br($item->answer) }}</td>
    </tr>
  </table>
          @include('admin.lecturequestionsanswers.buttons.delete' , ['id' => $item->id])
        @include('admin.lecturequestionsanswers.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
