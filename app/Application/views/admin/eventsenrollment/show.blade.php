@extends(layoutExtend())
  @section('title')
    {{ trans('eventsenrollment.eventsenrollment') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('eventsenrollment.eventsenrollment') , 'model' => 'eventsenrollment' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("eventsenrollment.start_time") }}</th>
     <td>{{ nl2br($item->start_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsenrollment.end_time") }}</th>
     <td>{{ nl2br($item->end_time) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsenrollment.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("eventsenrollment.Yes") : trans("eventsenrollment.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.eventsenrollment.buttons.delete' , ['id' => $item->id])
        @include('admin.eventsenrollment.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
