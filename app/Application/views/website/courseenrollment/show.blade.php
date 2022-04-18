@extends(layoutExtend('website'))
  @section('title')
    {{ trans('courseenrollment.courseenrollment') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('courseenrollment') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.courseenrollment.buttons.delete' , ['id' => $item->id])
        @include('website.courseenrollment.buttons.edit' , ['id' => $item->id])
</div>
@endsection
