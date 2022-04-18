@extends(layoutExtend('website'))
 @section('title')
    {{ trans('transactions.transactions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('transactions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('transactions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.transactions.relation.events.edit")
            @include("website.transactions.relation.courses.edit")
            @include("website.transactions.relation.payments.edit")
            @include("website.transactions.relation.user.edit")
                <div class="form-group {{ $errors->has("price") ? "has-error" : "" }}" > 
   <label for="price">{{ trans("transactions.price")}}</label>
    <input type="text" name="price" class="form-control" id="price" value="{{ isset($item->price) ? $item->price : old("price") }}"  placeholder="{{ trans("transactions.price")}}">
  </div>
   @if ($errors->has("price"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("currency") ? "has-error" : "" }}" > 
   <label for="currency">{{ trans("transactions.currency")}}</label>
    <input type="text" name="currency" class="form-control" id="currency" value="{{ isset($item->currency) ? $item->currency : old("currency") }}"  placeholder="{{ trans("transactions.currency")}}">
  </div>
   @if ($errors->has("currency"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("currency") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("percent") ? "has-error" : "" }}" > 
   <label for="percent">{{ trans("transactions.percent")}}</label>
    <input type="text" name="percent" class="form-control" id="percent" value="{{ isset($item->percent) ? $item->percent : old("percent") }}"  placeholder="{{ trans("transactions.percent")}}">
  </div>
   @if ($errors->has("percent"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("percent") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("amount") ? "has-error" : "" }}" > 
   <label for="amount">{{ trans("transactions.amount")}}</label>
    <input type="text" name="amount" class="form-control" id="amount" value="{{ isset($item->amount) ? $item->amount : old("amount") }}"  placeholder="{{ trans("transactions.amount")}}">
  </div>
   @if ($errors->has("amount"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("amount") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("transactions.type")}}</label>
    <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("transactions.type")}}">
  </div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("date") ? "has-error" : "" }}" > 
   <label for="date">{{ trans("transactions.date")}}</label>
     <input type="text" name="date" class="form-control datepicker2" id="date" value="{{ isset($item->date) ? $item->date : old("date") }}"  placeholder="{{ trans("transactions.date")}}" > 
  </div>
   @if ($errors->has("date"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("date") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.transactions') }}
                </button>
            </div>
        </form>
</div>
@endsection
