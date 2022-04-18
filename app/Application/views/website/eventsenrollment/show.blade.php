@extends(layoutExtend('website'))
  @section('title')
    {{ trans('eventsenrollment.eventsenrollment') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('eventsenrollment') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.eventsenrollment.buttons.delete' , ['id' => $item->id])
        @include('website.eventsenrollment.buttons.edit' , ['id' => $item->id])
</div>
@endsection
