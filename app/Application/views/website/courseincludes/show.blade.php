@extends(layoutExtend('website'))
  @section('title')
    {{ trans('courseincludes.courseincludes') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('courseincludes') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courseincludes.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('website.courseincludes.buttons.delete' , ['id' => $item->id])
        @include('website.courseincludes.buttons.edit' , ['id' => $item->id])
</div>
@endsection
