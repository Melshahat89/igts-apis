@extends(layoutExtend())
 @section('title')
    {{ trans('lecturequestionsanswers.lecturequestionsanswers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('lecturequestionsanswers.lecturequestionsanswers') , 'model' => 'lecturequestionsanswers' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/lecturequestionsanswers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.lecturequestionsanswers.relation.lecturequestions.edit")
            @include("admin.lecturequestionsanswers.relation.user.edit")
     <div class="form-group {{ $errors->has("answer") ? "has-error" : "" }}" > 
   <label for="answer">{{ trans("lecturequestionsanswers.answer")}}</label>
    <textarea name="answer" class="form-control" id="answer"   placeholder="{{ trans("lecturequestionsanswers.answer")}}" >{{isset($item->answer) ? $item->answer : old("answer") }}</textarea >
  </div>
   @if ($errors->has("answer"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("answer") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('lecturequestionsanswers.lecturequestionsanswers') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
