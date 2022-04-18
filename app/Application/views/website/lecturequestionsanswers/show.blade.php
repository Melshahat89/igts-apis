@extends(layoutExtend('website'))
  @section('title')
    {{ trans('lecturequestionsanswers.lecturequestionsanswers') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('lecturequestionsanswers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("lecturequestionsanswers.answer") }}</th>
     <td>{{ nl2br($item->answer) }}</td>
    </tr>
  </table>
          @include('website.lecturequestionsanswers.buttons.delete' , ['id' => $item->id])
        @include('website.lecturequestionsanswers.buttons.edit' , ['id' => $item->id])
</div>
@endsection
