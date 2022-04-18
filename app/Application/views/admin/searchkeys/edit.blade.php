@extends(layoutExtend())
 @section('title')
    {{ trans('searchkeys.searchkeys') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('searchkeys.searchkeys') , 'model' => 'searchkeys' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/searchkeys/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.searchkeys.relation.user.edit")
     <div class="form-group {{ $errors->has("word") ? "has-error" : "" }}" > 
   <label for="word">{{ trans("searchkeys.word")}}</label>
    <input type="text" name="word" class="form-control" id="word" value="{{ isset($item->word) ? $item->word : old("word") }}"  placeholder="{{ trans("searchkeys.word")}}">
  </div>
   @if ($errors->has("word"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("word") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("ip") ? "has-error" : "" }}" > 
   <label for="ip">{{ trans("searchkeys.ip")}}</label>
    <input type="text" name="ip" class="form-control" id="ip" value="{{ isset($item->ip) ? $item->ip : old("ip") }}"  placeholder="{{ trans("searchkeys.ip")}}">
  </div>
   @if ($errors->has("ip"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("ip") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("country") ? "has-error" : "" }}" > 
   <label for="country">{{ trans("searchkeys.country")}}</label>
    <input type="text" name="country" class="form-control" id="country" value="{{ isset($item->country) ? $item->country : old("country") }}"  placeholder="{{ trans("searchkeys.country")}}">
  </div>
   @if ($errors->has("country"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("country") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("city") ? "has-error" : "" }}" > 
   <label for="city">{{ trans("searchkeys.city")}}</label>
    <input type="text" name="city" class="form-control" id="city" value="{{ isset($item->city) ? $item->city : old("city") }}"  placeholder="{{ trans("searchkeys.city")}}">
  </div>
   @if ($errors->has("city"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("city") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('searchkeys.searchkeys') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
