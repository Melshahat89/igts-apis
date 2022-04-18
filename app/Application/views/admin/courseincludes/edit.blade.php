@extends(layoutExtend())
 @section('title')
    {{ trans('courseincludes.courseincludes') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('courseincludes.courseincludes') , 'model' => 'courseincludes' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/courseincludes/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courseincludes.relation.courses.edit")
     <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">Position</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("courseincludes.position")}}">
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
                    {{ trans('home.save') }}  {{ trans('courseincludes.courseincludes') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
