@extends(layoutExtend('website'))
 @section('title')
    {{ trans('lecturequestionsanswers.lecturequestionsanswers') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('lecturequestionsanswers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('lecturequestionsanswers/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.lecturequestionsanswers.relation.lecturequestions.edit")
            @include("website.lecturequestionsanswers.relation.user.edit")
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
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.lecturequestionsanswers') }}
                </button>
            </div>
        </form>
</div>
@endsection
