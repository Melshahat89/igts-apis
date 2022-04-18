@extends(layoutExtend('website'))
 @section('title')
    {{ trans('courseresources.courseresources') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('courseresources') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('courseresources/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.courseresources.relation.courses.edit")
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
                    <img src="{{ small($item->file) }}" class="thumbnail" alt="" width="200">
                    <br>
                    @endif
                    <input type="file" name="file" >
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
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.courseresources') }}
                </button>
            </div>
        </form>
</div>
@endsection
