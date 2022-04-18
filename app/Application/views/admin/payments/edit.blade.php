@extends(layoutExtend())
 @section('title')
    {{ trans('payments.payments') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('payments.payments') , 'model' => 'payments' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/payments/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.payments.relation.user.edit")
     <div class="form-group {{ $errors->has("operation") ? "has-error" : "" }}" > 
   <label for="operation">{{ trans("payments.operation")}}</label>
    <input type="text" name="operation" class="form-control" id="operation" value="{{ isset($item->operation) ? $item->operation : old("operation") }}"  placeholder="{{ trans("payments.operation")}}">
  </div>
   @if ($errors->has("operation"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("operation") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("amount") ? "has-error" : "" }}" > 
   <label for="amount">{{ trans("payments.amount")}}</label>
    <input type="text" name="amount" class="form-control" id="amount" value="{{ isset($item->amount) ? $item->amount : old("amount") }}"  placeholder="{{ trans("payments.amount")}}">
  </div>
   @if ($errors->has("amount"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("amount") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("currency_id") ? "has-error" : "" }}" > 
   <label for="currency_id">{{ trans("payments.currency_id")}}</label>
    <input type="text" name="currency_id" class="form-control" id="currency_id" value="{{ isset($item->currency_id) ? $item->currency_id : old("currency_id") }}"  placeholder="{{ trans("payments.currency_id")}}">
  </div>
   @if ($errors->has("currency_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("currency_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("receiver_id") ? "has-error" : "" }}" > 
   <label for="receiver_id">{{ trans("payments.receiver_id")}}</label>
    <input type="text" name="receiver_id" class="form-control" id="receiver_id" value="{{ isset($item->receiver_id) ? $item->receiver_id : old("receiver_id") }}"  placeholder="{{ trans("payments.receiver_id")}}">
  </div>
   @if ($errors->has("receiver_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("receiver_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("token") ? "has-error" : "" }}" > 
   <label for="token">{{ trans("payments.token")}}</label>
    <input type="text" name="token" class="form-control" id="token" value="{{ isset($item->token) ? $item->token : old("token") }}"  placeholder="{{ trans("payments.token")}}">
  </div>
   @if ($errors->has("token"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("token") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("token_date") ? "has-error" : "" }}" > 
   <label for="token_date">{{ trans("payments.token_date")}}</label>
    <input type="text" name="token_date" class="form-control" id="token_date" value="{{ isset($item->token_date) ? $item->token_date : old("token_date") }}"  placeholder="{{ trans("payments.token_date")}}">
  </div>
   @if ($errors->has("token_date"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("token_date") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("payments.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("payments.status")}}">
  </div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_source_data_type") ? "has-error" : "" }}" > 
   <label for="accept_source_data_type">{{ trans("payments.accept_source_data_type")}}</label>
    <input type="text" name="accept_source_data_type" class="form-control" id="accept_source_data_type" value="{{ isset($item->accept_source_data_type) ? $item->accept_source_data_type : old("accept_source_data_type") }}"  placeholder="{{ trans("payments.accept_source_data_type")}}">
  </div>
   @if ($errors->has("accept_source_data_type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_source_data_type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_id") ? "has-error" : "" }}" > 
   <label for="accept_id">{{ trans("payments.accept_id")}}</label>
    <input type="text" name="accept_id" class="form-control" id="accept_id" value="{{ isset($item->accept_id) ? $item->accept_id : old("accept_id") }}"  placeholder="{{ trans("payments.accept_id")}}">
  </div>
   @if ($errors->has("accept_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_pending") ? "has-error" : "" }}" > 
   <label for="accept_pending">{{ trans("payments.accept_pending")}}</label>
    <input type="text" name="accept_pending" class="form-control" id="accept_pending" value="{{ isset($item->accept_pending) ? $item->accept_pending : old("accept_pending") }}"  placeholder="{{ trans("payments.accept_pending")}}">
  </div>
   @if ($errors->has("accept_pending"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_pending") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_order") ? "has-error" : "" }}" > 
   <label for="accept_order">{{ trans("payments.accept_order")}}</label>
    <input type="text" name="accept_order" class="form-control" id="accept_order" value="{{ isset($item->accept_order) ? $item->accept_order : old("accept_order") }}"  placeholder="{{ trans("payments.accept_order")}}">
  </div>
   @if ($errors->has("accept_order"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_order") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_amount_cents") ? "has-error" : "" }}" > 
   <label for="accept_amount_cents">{{ trans("payments.accept_amount_cents")}}</label>
    <input type="text" name="accept_amount_cents" class="form-control" id="accept_amount_cents" value="{{ isset($item->accept_amount_cents) ? $item->accept_amount_cents : old("accept_amount_cents") }}"  placeholder="{{ trans("payments.accept_amount_cents")}}">
  </div>
   @if ($errors->has("accept_amount_cents"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_amount_cents") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_success") ? "has-error" : "" }}" > 
   <label for="accept_success">{{ trans("payments.accept_success")}}</label>
    <input type="text" name="accept_success" class="form-control" id="accept_success" value="{{ isset($item->accept_success) ? $item->accept_success : old("accept_success") }}"  placeholder="{{ trans("payments.accept_success")}}">
  </div>
   @if ($errors->has("accept_success"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_success") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_data_message") ? "has-error" : "" }}" > 
   <label for="accept_data_message">{{ trans("payments.accept_data_message")}}</label>
    <input type="text" name="accept_data_message" class="form-control" id="accept_data_message" value="{{ isset($item->accept_data_message) ? $item->accept_data_message : old("accept_data_message") }}"  placeholder="{{ trans("payments.accept_data_message")}}">
  </div>
   @if ($errors->has("accept_data_message"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_data_message") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_profile_id") ? "has-error" : "" }}" > 
   <label for="accept_profile_id">{{ trans("payments.accept_profile_id")}}</label>
    <input type="text" name="accept_profile_id" class="form-control" id="accept_profile_id" value="{{ isset($item->accept_profile_id) ? $item->accept_profile_id : old("accept_profile_id") }}"  placeholder="{{ trans("payments.accept_profile_id")}}">
  </div>
   @if ($errors->has("accept_profile_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_profile_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_source_data_sub_type") ? "has-error" : "" }}" > 
   <label for="accept_source_data_sub_type">{{ trans("payments.accept_source_data_sub_type")}}</label>
    <input type="text" name="accept_source_data_sub_type" class="form-control" id="accept_source_data_sub_type" value="{{ isset($item->accept_source_data_sub_type) ? $item->accept_source_data_sub_type : old("accept_source_data_sub_type") }}"  placeholder="{{ trans("payments.accept_source_data_sub_type")}}">
  </div>
   @if ($errors->has("accept_source_data_sub_type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_source_data_sub_type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_hmac") ? "has-error" : "" }}" > 
   <label for="accept_hmac">{{ trans("payments.accept_hmac")}}</label>
    <input type="text" name="accept_hmac" class="form-control" id="accept_hmac" value="{{ isset($item->accept_hmac) ? $item->accept_hmac : old("accept_hmac") }}"  placeholder="{{ trans("payments.accept_hmac")}}">
  </div>
   @if ($errors->has("accept_hmac"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_hmac") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("txn_response_code") ? "has-error" : "" }}" > 
   <label for="txn_response_code">{{ trans("payments.txn_response_code")}}</label>
    <input type="text" name="txn_response_code" class="form-control" id="txn_response_code" value="{{ isset($item->txn_response_code) ? $item->txn_response_code : old("txn_response_code") }}"  placeholder="{{ trans("payments.txn_response_code")}}">
  </div>
   @if ($errors->has("txn_response_code"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("txn_response_code") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('payments.payments') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
