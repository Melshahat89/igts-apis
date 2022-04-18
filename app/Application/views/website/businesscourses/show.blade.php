@extends(layoutExtend('website'))
  @section('title')
    {{ trans('businesscourses.businesscourses') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('businesscourses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businesscourses.comment") }}</th>
     <td>{{ nl2br($item->comment) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businesscourses.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
  </table>
          @include('website.businesscourses.buttons.delete' , ['id' => $item->id])
        @include('website.businesscourses.buttons.edit' , ['id' => $item->id])
</div>
@endsection
