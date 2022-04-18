@extends(layoutExtend())
 @section('title')
    {{ trans('talksrelated.talksrelated') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('talksrelated.talksrelated') , 'model' => 'talksrelated' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/talksrelated/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.talksrelated.relation.talks.edit")
     <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("talksrelated.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("talksrelated.position")}}">
  </div>
   @if ($errors->has("position"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("position") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('talksrelated.talksrelated') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
