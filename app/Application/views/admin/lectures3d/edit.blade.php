@extends(layoutExtend())
 @section('title')
    {{ trans('lectures3d.lectures3d') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('lectures3d.lectures3d') , 'model' => 'lectures3d' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/lectures3d/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.lectures3d.relation.courselectures.edit")
     <div class="form-group {{ $errors->has("title") ? "has-error" : "" }}" > 
   <label for="title">{{ trans("lectures3d.title")}}</label>
    <input type="text" name="title" class="form-control" id="title" value="{{ isset($item->title) ? $item->title : old("title") }}"  placeholder="{{ trans("lectures3d.title")}}">
  </div>
   @if ($errors->has("title"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("title") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("link") ? "has-error" : "" }}" > 
   <label for="link">{{ trans("lectures3d.link")}}</label>
    <input type="text" name="link" class="form-control" id="link" value="{{ isset($item->link) ? $item->link : old("link") }}"  placeholder="{{ trans("lectures3d.link")}}">
  </div>
   @if ($errors->has("link"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("link") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('lectures3d.lectures3d') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
