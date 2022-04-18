@extends(layoutExtend())
 @section('title')
    {{ trans('ticketsreplay.ticketsreplay') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('ticketsreplay.ticketsreplay') , 'model' => 'ticketsreplay' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/ticketsreplay/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.ticketsreplay.relation.tickets.edit")
            @include("admin.ticketsreplay.relation.user.edit")
            @include("admin.ticketsreplay.relation.reciver.edit")
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
  
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('ticketsreplay.ticketsreplay') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
