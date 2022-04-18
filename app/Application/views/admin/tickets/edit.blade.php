@extends(layoutExtend())
 @section('title')
    {{ trans('tickets.tickets') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('tickets.tickets') , 'model' => 'tickets' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/tickets/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.tickets.relation.user.edit") 
            {{--  @include("admin.tickets.relation.reciver.edit")  --}}
     
   {{--  <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("tickets.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("tickets.status")}}">
  </div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
   <label for="type">{{ trans("tickets.type")}}</label>
    <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("tickets.type")}}">
  </div>
   @if ($errors->has("type"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
    </div>
   @endif  --}}
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
   {{--  <div class="form-group {{ $errors->has("priority") ? "has-error" : "" }}" > 
   <label for="priority">{{ trans("tickets.priority")}}</label>
    <input type="text" name="priority" class="form-control" id="priority" value="{{ isset($item->priority) ? $item->priority : old("priority") }}"  placeholder="{{ trans("tickets.priority")}}">
  </div>
   @if ($errors->has("priority"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("priority") }}</strong>
     </span>
    </div>
   @endif  --}}
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('tickets.tickets') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
