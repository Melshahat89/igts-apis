@extends(layoutExtend('website'))
  @section('title')
    {{ trans('lectures3d.lectures3d') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('lectures3d') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("lectures3d.title") }}</th>
     <td>{{ nl2br($item->title) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("lectures3d.link") }}</th>
     <td>{{ nl2br($item->link) }}</td>
    </tr>
  </table>
          @include('website.lectures3d.buttons.delete' , ['id' => $item->id])
        @include('website.lectures3d.buttons.edit' , ['id' => $item->id])
</div>
@endsection
