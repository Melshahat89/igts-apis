@extends(layoutExtend())
 @section('title')
    {{ trans('eventsenrollment.eventsenrollment') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('eventsenrollment.eventsenrollment') , 'model' => 'eventsenrollment' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/eventsenrollment/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.eventsenrollment.relation.user.edit")
            @include("admin.eventsenrollment.relation.events.edit")
     <div class="form-group {{ $errors->has("start_time") ? "has-error" : "" }}" > 
   <label for="start_time">{{ trans("eventsenrollment.start_time")}}</label>
    <input type="date" name="start_time" class="form-control datepicker" id="start_time" value="{{ isset($item->start_time) ? $item->start_time : old("start_time") }}"  placeholder="{{ trans("eventsenrollment.start_time")}}">
  </div>
   @if ($errors->has("start_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("start_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("end_time") ? "has-error" : "" }}" > 
   <label for="end_time">{{ trans("eventsenrollment.end_time")}}</label>
    <input type="date" name="end_time" class="form-control datepicker" id="end_time" value="{{ isset($item->end_time) ? $item->end_time : old("end_time") }}"  placeholder="{{ trans("eventsenrollment.end_time")}}">
  </div>
   @if ($errors->has("end_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("end_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("eventsenrollment.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("eventsenrollment.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("eventsenrollment.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('eventsenrollment.eventsenrollment') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
