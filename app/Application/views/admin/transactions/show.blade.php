@extends(layoutExtend())
  @section('title')
    {{ trans('transactions.transactions') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('transactions.transactions') , 'model' => 'transactions' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("transactions.price") }}</th>
     <td>{{ nl2br($item->price) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("transactions.currency") }}</th>
     <td>{{ nl2br($item->currency) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("transactions.percent") }}</th>
     <td>{{ nl2br($item->percent) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("transactions.amount") }}</th>
     <td>{{ nl2br($item->amount) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("transactions.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("transactions.date") }}</th>
     <td>{{ nl2br($item->date) }}</td>
    </tr>
  </table>
          @include('admin.transactions.buttons.delete' , ['id' => $item->id])
        @include('admin.transactions.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
