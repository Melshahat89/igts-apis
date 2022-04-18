@extends(layoutExtend())
  @section('title')
    {{ trans('payments.payments') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('payments.payments') , 'model' => 'payments' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("payments.operation") }}</th>
     <td>{{ nl2br($item->operation) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.amount") }}</th>
     <td>{{ nl2br($item->amount) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.currency_id") }}</th>
     <td>{{ nl2br($item->currency_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.receiver_id") }}</th>
     <td>{{ nl2br($item->receiver_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.token") }}</th>
     <td>{{ nl2br($item->token) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.token_date") }}</th>
     <td>{{ nl2br($item->token_date) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_source_data_type") }}</th>
     <td>{{ nl2br($item->accept_source_data_type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_id") }}</th>
     <td>{{ nl2br($item->accept_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_pending") }}</th>
     <td>{{ nl2br($item->accept_pending) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_order") }}</th>
     <td>{{ nl2br($item->accept_order) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_amount_cents") }}</th>
     <td>{{ nl2br($item->accept_amount_cents) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_success") }}</th>
     <td>{{ nl2br($item->accept_success) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_data_message") }}</th>
     <td>{{ nl2br($item->accept_data_message) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_profile_id") }}</th>
     <td>{{ nl2br($item->accept_profile_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_source_data_sub_type") }}</th>
     <td>{{ nl2br($item->accept_source_data_sub_type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.accept_hmac") }}</th>
     <td>{{ nl2br($item->accept_hmac) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("payments.txn_response_code") }}</th>
     <td>{{ nl2br($item->txn_response_code) }}</td>
    </tr>
  </table>
       
    @endcomponent
@endsection
