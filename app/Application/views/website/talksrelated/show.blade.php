@extends(layoutExtend('website'))
  @section('title')
    {{ trans('talksrelated.talksrelated') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('talksrelated') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("talksrelated.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('website.talksrelated.buttons.delete' , ['id' => $item->id])
        @include('website.talksrelated.buttons.edit' , ['id' => $item->id])
</div>
@endsection
