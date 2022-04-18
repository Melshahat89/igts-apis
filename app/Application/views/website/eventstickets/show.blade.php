@extends(layoutExtend('website'))
  @section('title')
    {{ trans('eventstickets.eventstickets') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('eventstickets') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("eventstickets.name") }}</th>
     <td>{{ nl2br($item->name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventstickets.email") }}</th>
     <td>{{ nl2br($item->email) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventstickets.code") }}</th>
     <td>{{ nl2br($item->code) }}</td>
    </tr>
  </table>
          @include('website.eventstickets.buttons.delete' , ['id' => $item->id])
        @include('website.eventstickets.buttons.edit' , ['id' => $item->id])
</div>
@endsection
