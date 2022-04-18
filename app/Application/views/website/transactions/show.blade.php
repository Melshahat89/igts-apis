@extends(layoutExtend('website'))
  @section('title')
    {{ trans('transactions.transactions') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('transactions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.transactions.buttons.delete' , ['id' => $item->id])
        @include('website.transactions.buttons.edit' , ['id' => $item->id])
</div>
@endsection
