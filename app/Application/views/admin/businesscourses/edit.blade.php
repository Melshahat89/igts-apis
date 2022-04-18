@extends(layoutExtend())
 @section('title')
    {{ trans('businesscourses.businesscourses') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('businesscourses.businesscourses') , 'model' => 'businesscourses' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/businesscourses/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.businesscourses.relation.courses.edit")
            @include("admin.businesscourses.relation.businessdata.edit")
     <div class="form-group {{ $errors->has("comment") ? "has-error" : "" }}" > 
   <label for="comment">{{ trans("businesscourses.comment")}}</label>
    <input type="text" name="comment" class="form-control" id="comment" value="{{ isset($item->comment) ? $item->comment : old("comment") }}"  placeholder="{{ trans("businesscourses.comment")}}">
  </div>
   @if ($errors->has("comment"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("comment") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label for="status">{{ trans("businesscourses.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("businesscourses.status")}}">
  </div>
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
                    {{ trans('home.save') }}  {{ trans('businesscourses.businesscourses') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
