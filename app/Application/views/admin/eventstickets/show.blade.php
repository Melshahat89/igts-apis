@extends(layoutExtend())
  @section('title')
    {{ trans('eventstickets.eventstickets') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('eventstickets.eventstickets') , 'model' => 'eventstickets' , 'action' => trans('home.view')  ])
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
          @include('admin.eventstickets.buttons.delete' , ['id' => $item->id])
        @include('admin.eventstickets.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
