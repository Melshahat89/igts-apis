@extends(layoutExtend('website'))
 @section('title')
    {{ trans('events.events') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('events') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('events/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.events.relation.eventsdata.edit")
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
                <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("events.type")}}">
              </div>
              @if ($errors->has("type"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("type") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
              <label for="status">{{ trans("events.status")}}</label>
                <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
                {{ trans("events.No")}}
                </label > 
                <label class="form-check-label">
                <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
                    {{ trans("events.Yes")}}
                </label> 
                </div> 		</div>
              @if ($errors->has("status"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("status") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("location") ? "has-error" : "" }}" > 
              <label for="location">{{ trans("events.location")}}</label>
                <textarea name="location" class="form-control" id="location"   placeholder="{{ trans("events.location")}}" >{{isset($item->location) ? $item->location : old("location") }}</textarea >
              </div>
              @if ($errors->has("location"))
                <div class="alert alert-danger">
                <span class='help-block'>
                  <strong>{{ $errors->first("location") }}</strong>
                </span>
                </div>
              @endif
              <div class="form-group {{ $errors->has("live_link") ? "has-error" : "" }}" > 
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
              <div class="form-group {{ $errors->has("recorded_link") ? "has-error" : "" }}" > 
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
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.events') }}
                </button>
            </div>
        </form>
</div>
@endsection
