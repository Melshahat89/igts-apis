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
          
            
            <div class="partnership_form">

            <form action="{{ concatenateLangToUrl('partnership/saveLecturesSections/'.$course->id) }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}


              @include(layoutMessage('website'))
              <div class="row">
                <div class="col-md-12">
                <p class="text-center">{{ trans("coursesections.add_new_section") }}</p>

                  <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                    <label for="title">* {{ trans("partnership.Section Name")}}</label>
                    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courses",'form-control input-item') !!}
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
              </div> 
        
              <div class="col-md-12 mt-20">
                <div class="text-center">
        
                  <button class="submit_crtl">
                    {{ trans('partnership.Add Lecture Section') }}
                  </button>
        
                </div>
              </div>
            </form>

              <i class="divid"></i>
        
        
              <form action="{{ concatenateLangToUrl('partnership/saveLectures/'.$course->id) }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div id="lecture-data">
                <div class="row">

                  <div class="col-md-12">
                  <p class="text-center">{{ trans("courselectures.add_new_lecture") }}</p>
 
                    <div class="form-group mb-20">
                      <label for="title">* {{ trans("partnership.Section Name")}}</label>
                      <select name="coursesections_id" required class="form-control input-item select-custom" id="exampleFormControlSelect1">
                        <option value="">...</option>
                        @isset($courseSections)
                          @foreach($courseSections as $key => $section)
                            <option value="{{ $section->id }}">{{ $section->title_lang }}</option>
                          @endforeach
                        @endisset
                      </select>
                    </div>
                </div>

                  <div class="col-md-12">
                    <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                      <label for="title">* {{ trans("partnership.Lecture Name")}}</label>
                      {!! extractFiled(isset($item) ? $item : null , "titleLecture", isset($item->title) ? $item->title : old("title") , "text" , "courselectures",'form-control input-item') !!}
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
                </div> 


              

                @if($course->videosready)
                  <div class="col-md-12"> 
                    <div class="form-group select2-bootstrap-prepend">
                      <label for="video_file">{{ trans("courselectures.video_file")}}</label>
                      <!-- *********************** Start vdocipher ********************-->
                      <select name="vdocipher_id" id="vdocipher_id" class="form-control input-item select2 select-custom">
                        @isset($videos)
                          @foreach ($videos as $video)
                              <option value="{{$video->id}}" {{ isset($item)? ($item->vdocipher_id == $video->id)?'selected':'' :'' }}>
                                  {{ $video->title }}
                              </option>
                          @endforeach
                        @endisset
                      </select>
                      <span>* {{ trans('partnership.Pleasa Contact us') }}</span>
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
                @endif
              <div class="col-md-12">
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
              </div>
              <div class="col-md-12">
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
                </div>
                
          
              <div class="col-md-12">
                <div class="text-center">
          
                  <button class="submit_crtl">
                    {{ trans('partnership.Add Lecture') }}
                  </button>
          
                </div>
              </div>
            </form>

                </div>
              </div>
        
        
        
        
        
        
              <div class="col-md-11 view-area">
                <div class="accordion course-accordion" id="accordionExample">
                  

                    @isset($courseSections)
                      @foreach($courseSections as $key => $cSection)
                      <div class="card">
                        <div class="card-header" id="heading-{{ $cSection->id }}">
                          <h2 class="mb-0">
                            <div type="button" class="btn flexBetween" data-toggle="collapse" data-target="#collapse-{{ $cSection->id }}">
                                <div class="acco-title flexLeft">
                                  <img class="mr-10" src="{{ asset('public/partnership') }}/images/new/drag.png" >
                                  <span>{{ $cSection->title_lang }}</span>
                                </div>
                            <div class="flexBetween">
                              <a href="#lecture-data" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/add.png" alt="..." ></a>
                              <button type="button" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/edit.png" alt="..." ></button>
                              <button type="button" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/remove.png" alt="..." ></button>
                            </div> 
                          </div>									
                          </h2>
                        </div>
                        <div id="collapse-{{ $cSection->id }}" class="collapse {{ ($key == 0)?'show':'' }}" aria-labelledby="heading-{{ $cSection->id }}" data-parent="#accordionExample">
                          @isset($cSection->courselectures)
                            @foreach($cSection->courselectures as $key => $lecture)
                              <div class="course-line flexBetween watched">
                                <div class="flexLeft">
                                  <img class="mr-10" src="{{ asset('public/partnership') }}/images/new/drag.png" >

                                  <i class="flaticon-play-button mr-10 ml-20"></i>
                                  {{ $lecture->title_lang }}
                                </div>
                                <div class="flexBetween">
                                    <a type="button" href="{{ url('courselectures/item/'.$lecture->id) }}" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/edit.png" alt="..." ></a>

                                    <a type="button" href="{{ url('partnership/'.$lecture->id.'/delete') }}" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/remove.png" alt="..." ></a>
                                
                                </div>
                              </div>
                            @endforeach
                          @endisset
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
              
                    <a href="{{ url('partnership/addCourse/'.$course->id) }}" class="submit_crtl">
                      {{ trans('website.Back') }}
                    </a>
              
                    <a href="{{ url('partnership/addResources/'.$course->id) }}" class="submit_crtl">
                      {{ trans('website.Next') }}
                    </a>
              
                  </div>
                </div>
              </div>
            </div>
            

            
         

        </div>
      </section>
      
  

@endsection
@push("js")
<script>
  $(document).ready(function(){
  var postTitle = $('#title_en');
  var postSlug = $('#slug');
  
  postTitle.keyup(function() {
      postSlug.val(slugify(postTitle.val()));
  });
});

function slugify(text) {
  return text
    .toString()                     // Cast to string
    .toLowerCase()                  // Convert the string to lowercase letters
    .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
    .trim()                         // Remove whitespace from both sides of a string
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-');        // Replace multiple - with single -
}
</script>

@endpush
@push("js")
                                                        <script>
                                                            function AddNewseo_desc() {
                                                                $("#laraflat-seo_desc").append('<div class="seo_desc form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_desc[]"  type="text" placeholder="{{ trans("courses.seo_desc")}}" >'+'<span class="btn btn-warning" onclick="removeseo_desc(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                                            }
                                                            function removeseo_desc(e) {
                                                                $(e).closest("div.seo_desc").remove();
                                                            }
                                                            function clearAllseo_desc(e) {
                                                                $("#laraflat-seo_desc").html("");
                                                            }
                                                        </script>
                            @endpush

                            @push("js")
                                                        <script>
                                                            function AddNewseo_keys() {
                                                                $("#laraflat-seo_keys").append('<div class="seo_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_keys[]"  type="text" placeholder="{{ trans("courses.seo_keys")}}" >'+'<span class="btn btn-warning" onclick="removeseo_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                                            }
                                                            function removeseo_keys(e) {
                                                                $(e).closest("div.seo_keys").remove();
                                                            }
                                                            function clearAllseo_keys(e) {
                                                                $("#laraflat-seo_keys").html("");
                                                            }
                                                        </script>
                            @endpush

                            @push("js")
                                                        <script>
                                                            function AddNewsearch_keys() {
                                                                $("#laraflat-search_keys").append('<div class="search_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="search_keys[]"  type="text" placeholder="{{ trans("courses.search_keys")}}" >'+'<span class="btn btn-warning" onclick="removesearch_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                                            }
                                                            function removesearch_keys(e) {
                                                                $(e).closest("div.search_keys").remove();
                                                            }
                                                            function clearAllsearch_keys(e) {
                                                                $("#laraflat-search_keys").html("");
                                                            }
                                                        </script>
                            @endpush