@extends(layoutExtend())
 @section('title')
    {{ trans('transactions.transactions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('transactions.transactions') , 'model' => 'transactions' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/transactions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <span class="control-fileupload">
                <label for="fileInput">Upload Transactions</label>
                <input name="transactionsFile" type="file" id="fileInput" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
            </span>

            <div class="form-group" > 
                <label for="transaction_date">Transactions Date</label>
                    <input type="text" name="transaction_date" class="form-control datepicker" id="transaction_date" value="{{ isset($item->date) ? $item->date : old("transaction_date") }}"  placeholder="Select Date" require>
		    </div>

              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('transactions.transactions') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
