@extends(layoutExtend('website'))
  @section('title')
    {{ trans('lecturequestions.lecturequestions') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('lecturequestions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.lecturequestions.buttons.delete' , ['id' => $item->id])
        @include('website.lecturequestions.buttons.edit' , ['id' => $item->id])
</div>
@endsection
