@extends(layoutExtend('website'))
  @section('title')
    {{ trans('ticketsreplay.ticketsreplay') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('ticketsreplay') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("ticketsreplay.message") }}</th>
     <td>{{ nl2br($item->message) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("ticketsreplay.reciver_id") }}</th>
     <td>{{ nl2br($item->reciver_id) }}</td>
    </tr>
  </table>
          @include('website.ticketsreplay.buttons.delete' , ['id' => $item->id])
        @include('website.ticketsreplay.buttons.edit' , ['id' => $item->id])
</div>
@endsection
