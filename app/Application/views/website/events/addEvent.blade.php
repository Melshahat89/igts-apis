@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.Add Event') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.Add Event') }}</h3>
        </div>
        <div class="panel-body">
          @include(layoutMessage('website'))
          <form action="{{ concatenateLangToUrl('events/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.events.relation.categories.edit")
                <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
              <label for="title">{{ trans("events.title")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "events") !!}
              </div>
              @if ($errors->has("title.en"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("title.en") }}</strong>
                </span>
                </div>
              @endif
              @if ($errors->has("title.ar"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("title.ar") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
              <label for="description">{{ trans("events.description")}}</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ isset($item->description) ? $item->description : old("description") }}"  placeholder="{{ trans("events.description")}}">
              </div>
              @if ($errors->has("description.en"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("description.en") }}</strong>
                </span>
                </div>
              @endif
              @if ($errors->has("description.ar"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("description.ar") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
              <label for="image">{{ trans("events.image")}}</label>
                @if(isset($item) && $item->image != "")
                <br>
                <img src="{{ small($item->image) }}" class="thumbnail" alt="" width="200">
                <br>
                @endif
                <input type="file" name="image" >
              </div>
              @if ($errors->has("image"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("image") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("is_free") ? "has-error" : "" }}" > 
              <label for="is_free">{{ trans("events.is_free")}}</label>
                <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" name="is_free" {{ isset($item->is_free) && $item->is_free == 0 ? "checked" : "" }} type="radio" value="0" > 
                {{ trans("events.No")}}
                </label > 
                <label class="form-check-label">
                <input class="form-check-input" name="is_free" {{ isset($item->is_free) && $item->is_free == 1 ? "checked" : "" }} type="radio" value="1" > 
                    {{ trans("events.Yes")}}
                </label> 
                </div> 		</div>
              @if ($errors->has("is_free"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("is_free") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("price_egp") ? "has-error" : "" }}" > 
              <label for="price_egp">{{ trans("events.price_egp")}}</label>
                <input type="text" name="price_egp" class="form-control" id="price_egp" value="{{ isset($item->price_egp) ? $item->price_egp : old("price_egp") }}"  placeholder="{{ trans("events.price_egp")}}">
              </div>
              @if ($errors->has("price_egp"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("price_egp") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("price_usd") ? "has-error" : "" }}" > 
              <label for="price_usd">{{ trans("events.price_usd")}}</label>
                <input type="text" name="price_usd" class="form-control" id="price_usd" value="{{ isset($item->price_usd) ? $item->price_usd : old("price_usd") }}"  placeholder="{{ trans("events.price_usd")}}">
              </div>
              @if ($errors->has("price_usd"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("price_usd") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
              <label for="type">{{ trans("events.type")}}</label>
                {!! Form::select('type', eventTypes(), isset($item->type) ? $item->type : old("type") ,['class'=>'form-control','id'=>'type','placeholder'=>trans("events.type")]); !!}              
              </div>
              @if ($errors->has("type"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("type") }}</strong>
                </span>
                </div>
              @endif
              
              <div id="offline" style="display: none;" class="form-group {{ $errors->has("location") ? "has-error" : "" }}" > 
              <label for="location">{{ trans("events.location")}}</label>
                <textarea  name="location" class="form-control" id="location"   placeholder="{{ trans("events.location")}}" >{{isset($item->location) ? $item->location : old("location") }}</textarea >
              </div>
              @if ($errors->has("location"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("location") }}</strong>
                </span>
                </div>
              @endif
              <div id="live" style="display: none;" class="form-group {{ $errors->has("live_link") ? "has-error" : "" }}" > 
              <label for="live_link">{{ trans("events.live_link")}}</label>
                <textarea name="live_link" class="form-control" id="live_link"   placeholder="{{ trans("events.live_link")}}" >{{isset($item->live_link) ? $item->live_link : old("live_link") }}</textarea >
              </div>
              @if ($errors->has("live_link"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("live_link") }}</strong>
                </span>
                </div>
              @endif
              <div id="recorded" style="display: none;" class="form-group {{ $errors->has("recorded_link") ? "has-error" : "" }}" > 
              <label for="recorded_link">{{ trans("events.recorded_link")}}</label>
                <textarea name="recorded_link" class="form-control" id="recorded_link"   placeholder="{{ trans("events.recorded_link")}}" >{{isset($item->recorded_link) ? $item->recorded_link : old("recorded_link") }}</textarea >
              </div>
              @if ($errors->has("recorded_link"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("recorded_link") }}</strong>
                </span>
                </div>
              @endif

              
   <div class="form-group {{ $errors->has("start_date") ? "has-error" : "" }}" > 
    <label for="start_date">{{ trans("eventsdata.start_date")}}</label>
     <input type="text" name="start_date" class="form-control datepicker" id="start_date" value="{{ isset($item->start_date) ? $item->start_date : old("start_date") }}"  placeholder="{{ trans("eventsdata.start_date")}}">
   </div>
    @if ($errors->has("start_date"))
     <div class="alert alert-danger">
      <span class='help-block'>
       <strong>{{ $errors->first("start_date") }}</strong>
      </span>
     </div>
    @endif
    <div class="form-group {{ $errors->has("end_date") ? "has-error" : "" }}" > 
      <label for="end_date">{{ trans("eventsdata.end_date")}}</label>
       <input type="text" name="end_date" class="form-control datepicker" id="end_date" value="{{ isset($item->end_date) ? $item->end_date : 'old("end_date")' }}"  placeholder="{{ trans("eventsdata.end_date")}}">
     </div>
      @if ($errors->has("end_date"))
       <div class="alert alert-danger">
        <span class='help-block'>
         <strong>{{ $errors->first("end_date") }}</strong>
        </span>
       </div>
      @endif


             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.events') }}
                </button>
            </div>
          </form>

        </div>
    </div>

@endsection
@push('js')
<script>
  $(document).ready(function(){
    $("#type").change(function(){
          if($( "option:selected", this ).attr("value") =="1"){
              $("#live").show();
              $("#recorded").hide();
              $("#offline").hide();
          }
          if($( "option:selected", this ).attr("value") =="2"){
              $("#live").hide();
              $("#recorded").show();
              $("#offline").hide();
          }
          if($( "option:selected", this ).attr("value") =="3"){
              $("#live").hide();
              $("#recorded").hide();
              $("#offline").show();
          }
  });
});
</script>
@endpush