@extends(layoutExtend())
  @section('title')
    {{ trans('ordersposition.ordersposition') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('ordersposition.ordersposition') , 'model' => 'ordersposition' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("ordersposition.amount") }}</th>
     <td>{{ nl2br($item->amount) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("ordersposition.notes") }}</th>
     <td>{{ nl2br($item->notes) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("ordersposition.certificate_id") }}</th>
     <td>{{ nl2br($item->certificate_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("ordersposition.shipping_id") }}</th>
     <td>{{ nl2br($item->shipping_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("ordersposition.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
  </table>
          @include('admin.ordersposition.buttons.delete' , ['id' => $item->id])
        @include('admin.ordersposition.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
