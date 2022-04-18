@extends(layoutExtend())
 @section('title')
    {{ trans('eventstickets.eventstickets') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('eventstickets.eventstickets') , 'model' => 'eventstickets' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/eventstickets/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.eventstickets.relation.user.edit")
            @include("admin.eventstickets.relation.events.edit")
            @include("admin.eventstickets.relation.eventsdata.edit")
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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('eventstickets.eventstickets') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
