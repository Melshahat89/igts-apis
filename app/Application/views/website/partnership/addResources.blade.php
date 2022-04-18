@extends(layoutExtend('website'))
@section('title')
{{ trans('partnership.Add new course') }} | {{ trans('partnership.partnership') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@push('css')
    <style>
        .tab-content>.active {
            display: inline;
        }

        .settings-container .input-item {
            padding-left: 35px;
        }

        .nav-link {
            color: #244092;
        }

    </style>
@endpush
@section('content')
    <div class="bread-crumb">
        <div class="container">
            <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.Add new course') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1 class="mt-20 mb-20">{{ trans('partnership.Add new course') }}</h1>
        </div>
    </div>

    


    <section class="settings-container">
      <div class="contianer">
        <div class="cntrls_btns">
          <a class="active cntrl-btn" href="{{ url('partnership/addCourse/'.$course->id) }}">{{ trans('partnership.Course') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addLectures/'.$course->id) }}">{{ trans('courses.lectures') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addResources/'.$course->id) }}">{{ trans('courses.Resources') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addExams/'.$course->id) }}">{{ trans('partnership.Exams') }}</a>
    </div>
        <form action="{{ concatenateLangToUrl('partnership/saveResources/'.$course->id) }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          
          <div class="partnership_form">
            @include(layoutMessage('website'))
            <div class="row">
              <div class="col-md-12"> 
                <p class="text-center">{{ trans("courseresources.upload_your_pdf") }}</p>
                <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                  <label for="title">{{ trans("courseresources.title")}}</label>
                      {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courseresources",'form-control input-item') !!}
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
                     
                    
                        <label id="msg" for="file-upload" class="custom-file-upload">
                          {{ trans('partnership.Upload File') }}
                        </label>
          
                        <input id="file-upload"  type="file" style="display:none;" name="file" accept="application/pdf,application/msword,
                        application/vnd.openxmlformats-officedocument.wordprocessingml.document">
          
                        <button type="button" class="browse btn btn-primary ">{{ trans('partnership.Upload File') }}</button>
                      
                  </div>
                  @if ($errors->has("file"))
                      <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("file") }}</strong>
                      </span>
                      </div>
                  @endif
              </div>
              
      
           
            <div id="preview" style="display: none;"></div>
      
            <div class="col-md-12 mt-20">
              <div class="text-center">
      
                <button class="submit_crtl">
                  {{ trans('partnership.Add Resources') }}
                </button>
      
              </div>
            </div>
      
      
            <div class="col-md-11 view-area">
              
        
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                @isset($courseResources)
                  @foreach($courseResources as $key => $resource)
                    <div class="course-line flexBetween watched">
                      <div class="flexLeft">
                        <img class="mr-10" src="{{ asset('public/partnership') }}/images/new/drag.png" >
                        {{ $resource->title_lang }}
                      </div>
                      <div class="flexBetween"> 
                          <button type="button" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/remove.png" alt="..." ></button>
                          <a type="button" download href="{{ url(env("UPLOAD_PATH")."/".$resource->file) }}" class="custom-add-btn">Download</a>
                      </div>
                    </div>
                  @endforeach                  
                @endisset
                
              </div> 
            
            </div>
      
           
          
               
              
          </div>
          </div>

          <div class="cntrls-content col-md-6">
            <div class="row">
              <div class="col-md-12 mt-40">
                <div class="text-center flexBetween">
                  <a href="{{ url('partnership/addLectures/'.$course->id) }}" class="submit_crtl">
                    {{ trans('website.Back') }}
                  </a>
                  <a href="{{ url('partnership/addExams/'.$course->id) }}" class="submit_crtl">
                    {{ trans('website.Next') }}
                  </a>
                </div>
              </div>
            </div>
          </div>

        </form>

      </div>
    </section>
    
      
  

@endsection