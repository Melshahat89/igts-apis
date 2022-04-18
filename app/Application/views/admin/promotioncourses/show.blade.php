@extends(layoutExtend())
  @section('title')
    {{ trans('promotioncourses.promotioncourses') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('promotioncourses.promotioncourses') , 'model' => 'promotioncourses' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotioncourses.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('admin.promotioncourses.buttons.delete' , ['id' => $item->id])
        @include('admin.promotioncourses.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
