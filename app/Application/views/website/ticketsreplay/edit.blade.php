@extends(layoutExtend('website'))
 @section('title')
    {{ trans('ticketsreplay.ticketsreplay') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('ticketsreplay') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('ticketsreplay/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.ticketsreplay.relation.tickets.edit")
            @include("website.ticketsreplay.relation.user.edit")
                <div class="form-group {{ $errors->has("message") ? "has-error" : "" }}" > 
   <label for="message">{{ trans("ticketsreplay.message")}}</label>
    <textarea name="message" class="form-control" id="message"   placeholder="{{ trans("ticketsreplay.message")}}" >{{isset($item->message) ? $item->message : old("message") }}</textarea >
  </div>
   @if ($errors->has("message"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("message") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("reciver_id") ? "has-error" : "" }}" > 
   <label for="reciver_id">{{ trans("ticketsreplay.reciver_id")}}</label>
    <input type="text" name="reciver_id" class="form-control" id="reciver_id" value="{{ isset($item->reciver_id) ? $item->reciver_id : old("reciver_id") }}"  placeholder="{{ trans("ticketsreplay.reciver_id")}}">
  </div>
   @if ($errors->has("reciver_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("reciver_id") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.ticketsreplay') }}
                </button>
            </div>
        </form>
</div>
@endsection
