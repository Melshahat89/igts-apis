@extends(layoutBusiness('website'))
@section('title')
    {{ trans('businessdata.MEDU | Dashboard') }} | {{ trans('businessdata.tickets') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
<div class="panel panel-headline">
  <div class="panel-heading">
      <h3 class="panel-title">{{ trans('businessdata.tickets') }}</h3>
  </div>


  <div class="panel-body">

 

<div class="pull-{{ getDirection() }} col-lg-9">
  @include(layoutMessage('website'))
 <form action="{{ concatenateLangToUrl('tickets/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
     {{ csrf_field() }}
    
<div class="form-group {{ $errors->has("title") ? "has-error" : "" }}" > 
<label for="title">{{ trans("tickets.title")}}</label>
<input type="text" name="title" class="form-control" id="title" value="{{ isset($item->title) ? $item->title : old("title") }}"  placeholder="{{ trans("tickets.title")}}">
</div>
@if ($errors->has("title"))
<div class="alert alert-danger">
<span class='help-block'>
<strong>{{ $errors->first("title") }}</strong>
</span>
</div>
@endif
<div class="form-group {{ $errors->has("message") ? "has-error" : "" }}" > 
<label for="message">{{ trans("tickets.message")}}</label>
<textarea name="message" class="form-control" id="message"   placeholder="{{ trans("tickets.message")}}" >{{isset($item->message) ? $item->message : old("message") }}</textarea >
</div>
@if ($errors->has("message"))
<div class="alert alert-danger">
<span class='help-block'>
<strong>{{ $errors->first("message") }}</strong>
</span>
</div>
@endif

      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-default" >
             <i class="fa fa-save"></i>
             {{ trans('home.save') }}  {{ trans('website.tickets') }}
         </button>
     </div>
 </form>
</div>

    
  </div>
</div>



@endsection
