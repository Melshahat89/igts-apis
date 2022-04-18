@extends(layoutExtend('website'))
  @section('title')
    {{ trans('coursesections.coursesections') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('coursesections') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("coursesections.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursesections.will_do_at_the_end") }}</th>
     <td>{{ nl2br($item->will_do_at_the_end_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursesections.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('website.coursesections.buttons.delete' , ['id' => $item->id])
        @include('website.coursesections.buttons.edit' , ['id' => $item->id])
</div>
@endsection
