@extends(layoutExtend('website'))
  @section('title')
    {{ trans('tickets.tickets') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('tickets') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("tickets.reciver_id") }}</th>
     <td>{{ nl2br($item->reciver_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.title") }}</th>
     <td>{{ nl2br($item->title) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.message") }}</th>
     <td>{{ nl2br($item->message) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("tickets.priority") }}</th>
     <td>{{ nl2br($item->priority) }}</td>
    </tr>
  </table>
          @include('website.tickets.buttons.delete' , ['id' => $item->id])
        @include('website.tickets.buttons.edit' , ['id' => $item->id])
</div>
@endsection
