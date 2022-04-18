@extends(layoutExtend())
  @section('title')
    {{ trans('courserelated.courserelated') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('courserelated.courserelated') , 'model' => 'courserelated' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courserelated.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('admin.courserelated.buttons.delete' , ['id' => $item->id])
        @include('admin.courserelated.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
