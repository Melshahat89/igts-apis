@extends(layoutExtend2())
@include('admin.shared.select2styles')

 @section('title')
    {{ trans('courselectures.courselectures') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('courselectures.courselectures') , 'model' => 'courselectures' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())

        <form action="{{ concatenateLangToUrl('lazyadmin/courselectures/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courselectures.relation.coursesections.edit")
            @include("admin.courselectures.relation.user.edit")
            @include("admin.courselectures.relation.courses.edit")
            @include("admin.courselectures.relation.events.edit")
     <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("courselectures.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courselectures") !!}
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
   <div class="form-group {{ $errors->has("slug") ? "has-error" : "" }}" > 
   <label for="slug">{{ trans("courselectures.slug")}}</label>
    <input type="text" name="slug" class="form-control" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("courselectures.slug")}}">
  </div>
   @if ($errors->has("slug"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("slug") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
   <label for="description">{{ trans("courselectures.description")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "courselectures" ) !!}
  </div>
   @if ($errors->has("description.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("description.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("description.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("description.ar") }}</strong>
     </span>
    </div>
   @endif
    <div class="form-group {{ $errors->has("video_file") ? "has-error" : "" }}" > 
   <label for="video_file">{{ trans("courselectures.video_file")}}</label>
    <input type="text" name="video_file" class="form-control" id="video_file" value="{{ isset($item->video_file) ? $item->video_file : old("video_file") }}"  placeholder="{{ trans("courselectures.video_file")}}">
  </div>
   @if ($errors->has("video_file"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("video_file") }}</strong>
     </span>
    </div>
   @endif 

   <div class="col-md-12"> 
    <div class="form-group select2-bootstrap-prepend" id="drop-down-parent">
      <label for="vdocipher_id">{{ trans("courselectures.video_file")}}</label>
      @php
            if(isset($item)){
              $fields = \App\Application\Model\Courselectures::findOrFail($item->id);
              $videos = \App\Application\Model\Courses::getAllVdocipherCourses($fields->courses->vdocipher_tag, 1);
          }
      @endphp
      <!-- *********************** Start vdocipher ********************-->
      <select name="vdocipher_id" id="vdocipher_id" class="form-control input-item select2 select-custom">
        <option value="">Select Lecture</option>
        @isset($videos)
          @foreach ($videos as $video)
              <option value="{{$video->id}}" {{ isset($item)? ($item->vdocipher_id == $video->id)?'selected':'' :'' }}>
                  {{ $video->title }}
              </option>
          @endforeach


          
          @if(count($videos) == 40)
            @php $videos2 = \App\Application\Model\Courses::getAllVdocipherCourses($fields->courses->vdocipher_tag, 2); @endphp

            @foreach($videos2 as $video)
              <option value="{{$video->id}}" {{ isset($item)? ($item->vdocipher_id == $video->id)?'selected':'' :'' }}>
                  {{ $video->title }}
              </option>
            @endforeach

              @if(count($videos2) == 40)
              @php $videos3 = \App\Application\Model\Courses::getAllVdocipherCourses($fields->courses->vdocipher_tag, 3); @endphp

              @foreach($videos3 as $video)
                <option value="{{$video->id}}" {{ isset($item)? ($item->vdocipher_id == $video->id)?'selected':'' :'' }}>
                    {{ $video->title }}
                </option>
              @endforeach

              @if(count($videos3) == 40)
               @php $videos4 = \App\Application\Model\Courses::getAllVdocipherCourses($fields->courses->vdocipher_tag, 4); @endphp

                @foreach($videos4 as $video)
                  <option value="{{$video->id}}" {{ isset($item)? ($item->vdocipher_id == $video->id)?'selected':'' :'' }}>
                      {{ $video->title }}
                  </option>
                @endforeach

                

              @endif

            @endif
            

          @endif
          
          
        @endisset
      </select>
      
      <!-- *********************** End vdocipher ********************-->
      @if ($errors->has("vdocipher_id"))
        <div class="alert alert-danger">
        <span class='help-block'>
          <strong>{{ $errors->first("vdocipher_id") }}</strong>
        </span>
        </div>
      @endif
    </div>
  </div>

  <div class="form-group {{ $errors->has("start_date") ? "has-error" : "" }}" > 
    <label for="start_date">{{ trans("promotions.start_date")}}</label>
      <input type="text" name="start_date" class="form-control datepicker" id="start_date" value="{{ isset($item->start_date) ? $item->start_date : old("start_date") }}"  placeholder="{{ trans("promotions.start_date")}}">
  </div>
    @if ($errors->has("start_date"))
      <div class="alert alert-danger">
        <span class='help-block'>
          <strong>{{ $errors->first("start_date") }}</strong>
        </span>
      </div>
    @endif

   <div class="form-group {{ $errors->has("length") ? "has-error" : "" }}" > 
   <label for="length">{{ trans("courselectures.length")}}</label>
    <input type="text" name="length" class="form-control" id="length" value="{{ isset($item->length) ? $item->length : old("length") }}"  placeholder="{{ trans("courselectures.length")}}">
  </div>
   @if ($errors->has("length"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("length") }}</strong>
     </span>
    </div>
   @endif

   <div class="form-group {{ $errors->has("webinar_link") ? "has-error" : "" }}" > 
   <label for="webinar_link">{{ trans("courselectures.webinar_link")}}</label>
    <input type="text" name="webinar_link" class="form-control" id="webinar_link" value="{{ isset($item->webinar_link) ? $item->webinar_link : old("webinar_link") }}"  placeholder="{{ trans("courselectures.webinar_link")}}">
  </div>
   @if ($errors->has("webinar_link"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("webinar_link") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("is_free") ? "has-error" : "" }}" > 
   <label for="is_free">{{ trans("courselectures.is_free")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="is_free" {{ isset($item->is_free) && $item->is_free == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courselectures.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="is_free" {{ isset($item->is_free) && $item->is_free == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courselectures.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("is_free"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("is_free") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" > 
   <label for="position">{{ trans("courselectures.position")}}</label>
    <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("courselectures.position")}}">
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
                    {{ trans('home.save') }}  {{ trans('courselectures.courselectures') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
@include('admin.shared.select2scripts')
