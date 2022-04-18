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
            <a class="active cntrl-btn" href="#">{{ trans('partnership.Course') }}</a>

            @if(request()->route('id'))
                
                <a class="active cntrl-btn" href="{{ url('partnership/addLectures/'.request()->route('id')) }}">{{ trans('courses.lectures') }}</a>
                <a class="active cntrl-btn" href="{{ url('partnership/addResources/'.request()->route('id')) }}">{{ trans('courses.Resources') }}</a>
                <a class="active cntrl-btn" href="{{ url('partnership/addExams/'.request()->route('id')) }}">{{ trans('partnership.Exams') }}</a>
            @else
                <a class="cntrl-btn" href="#">{{ trans('courses.lectures') }}</a>
                <a class="cntrl-btn" href="#">{{ trans('courses.Resources') }}</a>
                <a class="cntrl-btn" href="#">{{ trans('partnership.Exams') }}</a>
            @endif

            
          </div>
          <form action="{{ concatenateLangToUrl('partnership/saveCourse') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="partnership_form">

              <div class="pull-{{ getDirection() }} col-lg-12">
                @include(layoutMessage('website'))
                
               
                   @include("website.courses.relation.categories.edit")

                       <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                        <label for="title">* {{ trans("courses.title")}}</label>
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
                    <div class="form-group {{ $errors->has("slug") ? "has-error" : "" }}" > 
                    <label for="slug">* {{ trans("courses.slug")}}</label>
                    <input type="text" name="slug" class="form-control input-item" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("courses.slug")}}">
                  </div>
                    @if ($errors->has("slug"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("slug") }}</strong>
                      </span>
                    </div>
                    @endif
                    <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
                    <label for="description">* {{ trans("courses.description")}}</label>
                    {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "courses",'form-control input-item' ) !!}
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
                    
                   
                
                    <div class="form-group {{ $errors->has("language_id") ? "has-error" : "" }}" > 
                    <label for="language_id">{{ trans("courses.language_id")}}</label>                  
                    <select name="language_id"  class="form-control input-item select-custom" >
                      @php  $language_id = isset($item) ? $item->language_id : null @endphp
                      @foreach( languages() as $key => $language)
                        <option value="{{ $key }}"  {{ $key == $language_id  ? "selected" : "" }}> {{ is_json($language) ? $language :  $language}}</option>
                      @endforeach
                    </select>

                    </div>
                    @if ($errors->has("language_id"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("language_id") }}</strong>
                      </span>
                    </div>
                    @endif
                   
                
                    <div class="form-group {{ $errors->has("price_in_dollar") ? "has-error" : "" }}" > 
                    <label for="price_in_dollar">* {{ trans("courses.suggested_price")}}</label>
                    <input type="text" name="price_in_dollar" class="form-control input-item" id="price_in_dollar" value="{{ isset($item->price_in_dollar) ? $item->price_in_dollar : old("price_in_dollar") }}"  placeholder="{{ trans("courses.suggested_price")}}">
                    </div>
                    @if ($errors->has("price_in_dollar"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("price_in_dollar") }}</strong>
                      </span>
                    </div>
                    @endif
                    
                 
                  
                   
                  <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
                    <label for="image">{{ trans("courses.Course Thumbnail")}}</label>
                    @if(isset($item) && $item->image != "")
                    <br>
                    <img src="{{ large1($item->image) }}" class="thumbnail" alt="" width="200">
                    <br>
                    @endif
                    <input type="file" name="image" >
                  </div>
                    @if ($errors->has("image"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("image") }}</strong>
                      </span>
                    </div>
                    @endif
                    {{--  <div class="form-group {{ $errors->has("promo_video") ? "has-error" : "" }}" > 
                    <label for="promo_video">{{ trans("courses.promo_video")}}</label>
                    <input type="text" name="promo_video" class="form-control input-item" id="promo_video" value="{{ isset($item->promo_video) ? $item->promo_video : old("promo_video") }}"  placeholder="{{ trans("courses.promo_video")}}">
                  </div>
                    @if ($errors->has("promo_video"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("promo_video") }}</strong>
                      </span>
                    </div>
                    @endif  --}}
                   
                    <div class="form-group {{ $errors->has("lectures_link") ? "has-error" : "" }}" > 
                    <label for="lectures_link">{{ trans("courses.lectures_link")}}</label>
                    <input type="text" name="lectures_link" class="form-control input-item" id="lectures_link" value="{{ isset($item->lectures_link) ? $item->lectures_link : old("lectures_link") }}"  placeholder="{{ trans("courses.lectures_link")}}">
                  </div>
                    @if ($errors->has("lectures_link"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("lectures_link") }}</strong>
                      </span>
                    </div>
                    @endif
                  
                  
                  
                  @if((Auth::user()->group_id == 5))
                    <div class="form-group  {{  $errors->has("doctor_name.en")  &&  $errors->has("doctor_name.ar")  ? "has-error" : "" }}" >
                    <label for="doctor_name">{{ trans("courses.doctor_name")}}</label>
                    {!! extractFiled(isset($item) ? $item : null , "doctor_name", isset($item->doctor_name) ? $item->doctor_name : old("doctor_name") , "text" , "courses",'form-control input-item') !!}
                    </div>
                    @if ($errors->has("doctor_name.en"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("doctor_name.en") }}</strong>
                      </span>
                    </div>
                    @endif
                    @if ($errors->has("doctor_name.ar"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("doctor_name.ar") }}</strong>
                      </span>
                    </div>
                    @endif
                  @endif
                   
                   
                    <div class="form-group d-none {{  $errors->has("seo_desc[].en")  &&  $errors->has("seo_desc[].ar")  ? "has-error" : "" }}" >
                    <label for="seo_desc">{{ trans("courses.seo_desc")}}</label>
                    <div id="laraflat-seo_desc">
                      @if(isset($item) || old("seo_desc"))
                      @if((isset($item->seo_desc) && json_decode($item->seo_desc) ) || old("seo_desc"))
                      @php $items = isset($item->seo_desc) && json_decode($item->seo_desc) ? json_decode($item->seo_desc)  : old("seo_desc") @endphp
                        @foreach($items as $jsonseo_desc)
                        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_desc[]"  value="{{ $jsonseo_desc}}" type="text" placeholder="{{ trans("courses.seo_desc")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
                        @endforeach
                      @endif
                      @endif
                    <span class="btn btn-success" onclick="AddNewseo_desc()"><i class="fa fa-plus"></i></span>
                    <span class="btn btn-danger" onclick="clearAllseo_desc(this)"><i class="fa fa-minus"></i></span>
                    
                      </div>
                  </div>
                    @if ($errors->has("seo_desc[].en"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("seo_desc[].en") }}</strong>
                      </span>
                    </div>
                    @endif
                    @if ($errors->has("seo_desc[].ar"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("seo_desc[].ar") }}</strong>
                      </span>
                    </div>
                    @endif
                    <div class="form-group d-none {{  $errors->has("seo_keys[].en")  &&  $errors->has("seo_keys[].ar")  ? "has-error" : "" }}" >
                    <label for="seo_keys">{{ trans("courses.seo_keys")}}</label>
                    <div id="laraflat-seo_keys">
                      @if(isset($item) || old("seo_keys"))
                      @if((isset($item->seo_keys) && json_decode($item->seo_keys) ) || old("seo_keys"))
                      @php $items = isset($item->seo_keys) && json_decode($item->seo_keys) ? json_decode($item->seo_keys)  : old("seo_keys") @endphp
                        @foreach($items as $jsonseo_keys)
                        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_keys[]"  value="{{ $jsonseo_keys}}" type="text" placeholder="{{ trans("courses.seo_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
                        @endforeach
                      @endif
                      @endif
                    <span class="btn btn-success" onclick="AddNewseo_keys()"><i class="fa fa-plus"></i></span>
                    <span class="btn btn-danger" onclick="clearAllseo_keys(this)"><i class="fa fa-minus"></i></span>
                    
                      </div>
                  </div>
                    @if ($errors->has("seo_keys[].en"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("seo_keys[].en") }}</strong>
                      </span>
                    </div>
                    @endif
                    @if ($errors->has("seo_keys[].ar"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("seo_keys[].ar") }}</strong>
                      </span>
                    </div>
                    @endif
                    <div class="form-group d-none {{  $errors->has("search_keys[].en")  &&  $errors->has("search_keys[].ar")  ? "has-error" : "" }}" >
                    <label for="search_keys">{{ trans("courses.search_keys")}}</label>
                    <div id="laraflat-search_keys">
                      @if(isset($item) || old("search_keys"))
                      @if((isset($item->search_keys) && json_decode($item->search_keys) ) || old("search_keys"))
                      @php $items = isset($item->search_keys) && json_decode($item->search_keys) ? json_decode($item->search_keys)  : old("search_keys") @endphp
                        @foreach($items as $jsonsearch_keys)
                        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="search_keys[]"  value="{{ $jsonsearch_keys}}" type="text" placeholder="{{ trans("courses.search_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
                        @endforeach
                      @endif
                      @endif
                    <span class="btn btn-success" onclick="AddNewsearch_keys()"><i class="fa fa-plus"></i></span>
                    <span class="btn btn-danger" onclick="clearAllsearch_keys(this)"><i class="fa fa-minus"></i></span>
                    
                      </div>
                  </div>
                    @if ($errors->has("search_keys[].en"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("search_keys[].en") }}</strong>
                      </span>
                    </div>
                    @endif
                    @if ($errors->has("search_keys[].ar"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("search_keys[].ar") }}</strong>
                      </span>
                    </div>
                    @endif
                    <div class="form-group {{ $errors->has("poster") ? "has-error" : "" }}" > 
                    <label for="promoPoster">{{ trans("courses.poster")}}</label>
                    @if(isset($item) && $item->promoPoster != "")
                    <br>
                    <img src="{{ large1($item->promoPoster) }}" class="thumbnail" alt="" width="200">
                    <br>
                    @endif
                    <input type="file" name="promoPoster" >
                  </div>
                    @if ($errors->has("promoPoster"))
                    <div class="alert alert-danger">
                      <span class='help-block'>
                      <strong>{{ $errors->first("promoPoster") }}</strong>
                      </span>
                    </div>
                    @endif
                            
                
                </div>
            </div>
            <div class="cntrls-content col-md-6">
              <div class="row">
                <div class="col-md-12 mt-40">
                  <div class="text-center flexRight">
              
                    <div class="form-group">
                      <button type="submit" name="submit" class="submit_crtl" >
                          <i class="fa fa-save"></i>
                          {{ trans('home.save') }}  {{ trans('website.courses') }}
                      </button>
                  </div>
                  @if(request()->route('id'))
                  <div class="form-group">
                    <a href="{{ url('partnership/addLectures/'.request()->route('id')) }}" class="submit_crtl">
                      {{ trans('website.Next') }}
                    </a>
                  </div>
                  @endif
                  

                  </div>
                </div>
              </div>
            </div>
          </form>

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