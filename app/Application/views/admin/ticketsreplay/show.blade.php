@extends(layoutExtend())
  @section('title')
    {{ trans('ticketsreplay.ticketsreplay') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('ticketsreplay.ticketsreplay') , 'model' => 'ticketsreplay' , 'action' => trans('home.view')  ])
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
          @include('admin.ticketsreplay.buttons.delete' , ['id' => $item->id])
        @include('admin.ticketsreplay.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
