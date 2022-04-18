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
      <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.Add Lecture') }}</span>
  </div>
</div>

<div class="page-title general-gred">
  <div class="container">
      <h1 class="mt-20 mb-20">{{ trans('partnership.Add Lecture') }}</h1>
  </div>
</div>




<section class="settings-container">
  <div class="contianer">

<div class="partnership_form">
         @include(layoutMessage('website'))
        <form action="{{ concatenateLangToUrl('courselectures/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @include("website.courselectures.relation.coursesections.edit") -->
           
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
   <div class="form-group d-none {{ $errors->has("slug") ? "has-error" : "" }}" > 
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


   @if($item->courses['videosready'])

   <div class="form-group {{ $errors->has("video_file") ? "has-error" : "" }}" > 
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

  </div>
   @if ($errors->has("video_file"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("video_file") }}</strong>
     </span>
    </div>
   @endif

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
   
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.courselectures') }}
                </button>
            </div>
        </form>
</div>


</div>
</section>
@endsection
