@extends(layoutExtend2())
 @section('title')
    {{ trans('courseresources.courseresources') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('courseresources.courseresources') , 'model' => 'courseresources' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/courseresources/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courseresources.relation.courses.edit")
     <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("courseresources.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courseresources") !!}
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
   <div class="form-group {{ $errors->has("file") ? "has-error" : "" }}" > 
   <label for="file">{{ trans("courseresources.file")}}</label>
    @if(isset($item) && $item->file != "")
    <br>
    <a href="/public/uploads/files/{{$item->file}}" class="thumbnail" alt="" width="200">{{$item->file}}</a>
    <br>
    @endif
    
    <input type="file" name="file[]" multiple>
  </div>
   @if ($errors->has("file"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("file") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('courseresources.courseresources') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
