@extends(layoutExtend('website'))
  @section('title')
    {{ trans('orders.orders') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('orders') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("orders.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("orders.comments") }}</th>
     <td>{{ nl2br($item->comments) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("orders.billing_address_id") }}</th>
     <td>{{ nl2br($item->billing_address_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("orders.accept_order_id") }}</th>
     <td>{{ nl2br($item->accept_order_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("orders.kiosk_id") }}</th>
     <td>{{ nl2br($item->kiosk_id) }}</td>
    </tr>
  </table>
          @include('website.orders.buttons.delete' , ['id' => $item->id])
        @include('website.orders.buttons.edit' , ['id' => $item->id])
</div>
@endsection
