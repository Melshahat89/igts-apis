@extends(layoutExtend('website'))
  @section('title')
    {{ trans('promotioncourses.promotioncourses') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('promotioncourses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotioncourses.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('website.promotioncourses.buttons.delete' , ['id' => $item->id])
        @include('website.promotioncourses.buttons.edit' , ['id' => $item->id])
</div>
@endsection
