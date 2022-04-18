@extends(layoutExtend())
 @section('title')
    {{ trans('courserelated.courserelated') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('courserelated.courserelated') , 'model' => 'courserelated' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/courserelated/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courserelated.relation.courses.edit")
            @include("admin.courserelated.relation.related.edit")
     <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("courserelated.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("courserelated.position")}}">
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
                    {{ trans('home.save') }}  {{ trans('courserelated.courserelated') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
