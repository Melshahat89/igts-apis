@extends(layoutExtend())
  @section('title')
    {{ trans('courseenrollment.courseenrollment') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('courseenrollment.courseenrollment') , 'model' => 'courseenrollment' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courseenrollment.start_time") }}</th>
     <td>{{ nl2br($item->start_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courseenrollment.end_time") }}</th>
     <td>{{ nl2br($item->end_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courseenrollment.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("courseenrollment.Yes") : trans("courseenrollment.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.courseenrollment.buttons.delete' , ['id' => $item->id])
        @include('admin.courseenrollment.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
