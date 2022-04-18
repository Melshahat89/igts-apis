@extends(layoutExtend('website'))
 @section('title')
    {{ trans('orders.orders') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('orders') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('orders/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.orders.relation.payments.edit")
            @include("website.orders.relation.user.edit")
                <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("orders.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("orders.status")}}">
  </div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("comments") ? "has-error" : "" }}" > 
   <label for="comments">{{ trans("orders.comments")}}</label>
    <input type="text" name="comments" class="form-control" id="comments" value="{{ isset($item->comments) ? $item->comments : old("comments") }}"  placeholder="{{ trans("orders.comments")}}">
  </div>
   @if ($errors->has("comments"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("comments") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("billing_address_id") ? "has-error" : "" }}" > 
   <label for="billing_address_id">{{ trans("orders.billing_address_id")}}</label>
    <input type="text" name="billing_address_id" class="form-control" id="billing_address_id" value="{{ isset($item->billing_address_id) ? $item->billing_address_id : old("billing_address_id") }}"  placeholder="{{ trans("orders.billing_address_id")}}">
  </div>
   @if ($errors->has("billing_address_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("billing_address_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("accept_order_id") ? "has-error" : "" }}" > 
   <label for="accept_order_id">{{ trans("orders.accept_order_id")}}</label>
    <input type="text" name="accept_order_id" class="form-control" id="accept_order_id" value="{{ isset($item->accept_order_id) ? $item->accept_order_id : old("accept_order_id") }}"  placeholder="{{ trans("orders.accept_order_id")}}">
  </div>
   @if ($errors->has("accept_order_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("accept_order_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("kiosk_id") ? "has-error" : "" }}" > 
   <label for="kiosk_id">{{ trans("orders.kiosk_id")}}</label>
    <input type="text" name="kiosk_id" class="form-control" id="kiosk_id" value="{{ isset($item->kiosk_id) ? $item->kiosk_id : old("kiosk_id") }}"  placeholder="{{ trans("orders.kiosk_id")}}">
  </div>
   @if ($errors->has("kiosk_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("kiosk_id") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.orders') }}
                </button>
            </div>
        </form>
</div>
@endsection
