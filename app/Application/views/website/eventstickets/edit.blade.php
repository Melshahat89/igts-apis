@extends(layoutExtend('website'))
 @section('title')
    {{ trans('eventstickets.eventstickets') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('eventstickets') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('eventstickets/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.eventstickets.relation.user.edit")
            @include("website.eventstickets.relation.events.edit")
            @include("website.eventstickets.relation.eventsdata.edit")
                <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
   <label for="name">{{ trans("eventstickets.name")}}</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("eventstickets.name")}}">
  </div>
   @if ($errors->has("name"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("name") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
   <label for="email">{{ trans("eventstickets.email")}}</label>
    <input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("eventstickets.email")}}">
  </div>
   @if ($errors->has("email"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("email") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("code") ? "has-error" : "" }}" > 
   <label for="code">{{ trans("eventstickets.code")}}</label>
    <input type="text" name="code" class="form-control" id="code" value="{{ isset($item->code) ? $item->code : old("code") }}"  placeholder="{{ trans("eventstickets.code")}}">
  </div>
   @if ($errors->has("code"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("code") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.eventstickets') }}
                </button>
            </div>
        </form>
</div>
@endsection
