@extends(layoutExtend())
 @section('title')
    {{ trans('talks.talks') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('talks.talks') , 'model' => 'talks' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/talks/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.talks.relation.categories.edit")
            @include("admin.talks.relation.instructor.edit")
     <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
   <label for="title">{{ trans("talks.title")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "talks") !!}
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
   <label for="slug">{{ trans("talks.slug")}}</label>
    <input type="text" name="slug" class="form-control" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("talks.slug")}}">
  </div>
   @if ($errors->has("slug"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("slug") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("subtitle.en")  &&  $errors->has("subtitle.ar")  ? "has-error" : "" }}" >
   <label for="subtitle">{{ trans("talks.subtitle")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "subtitle", isset($item->subtitle) ? $item->subtitle : old("subtitle") , "text" , "talks") !!}
  </div>
   @if ($errors->has("subtitle.en"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("subtitle.en") }}</strong>
     </span>
    </div>
   @endif
   @if ($errors->has("subtitle.ar"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("subtitle.ar") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
   <label for="description">{{ trans("talks.description")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "talks" ) !!}
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
   <label for="language_id">{{ trans("talks.language_id")}}</label>
    <input type="text" name="language_id" class="form-control" id="language_id" value="{{ isset($item->language_id) ? $item->language_id : old("language_id") }}"  placeholder="{{ trans("talks.language_id")}}">
  </div>
   @if ($errors->has("language_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("language_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("length") ? "has-error" : "" }}" > 
   <label for="length">{{ trans("talks.length")}}</label>
    <input type="text" name="length" class="form-control" id="length" value="{{ isset($item->length) ? $item->length : old("length") }}"  placeholder="{{ trans("talks.length")}}">
  </div>
   @if ($errors->has("length"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("length") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("featured") ? "has-error" : "" }}" > 
   <label for="featured">{{ trans("talks.featured")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("talks.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("talks.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("featured"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("featured") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("published") ? "has-error" : "" }}" > 
   <label for="published">{{ trans("talks.published")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("talks.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("talks.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("published"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("published") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("visits") ? "has-error" : "" }}" > 
   <label for="visits">{{ trans("talks.visits")}}</label>
    <input type="text" name="visits" class="form-control" id="visits" value="{{ isset($item->visits) ? $item->visits : old("visits") }}"  placeholder="{{ trans("talks.visits")}}">
  </div>
   @if ($errors->has("visits"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("visits") }}</strong>
     </span>
    </div>
   @endif



   <?php

use App\Application\Model\Courses;

   ?>

   @php
   if(isset($item)){
    $videos = Courses::getAllVimeoTalks($item->categories_id);
   }
   @endphp


@if(isset($item))

    <div class="form-group {{ $errors->has("video_file") ? "has-error" : "" }}" > 
        <label for="video_file">{{ trans("talks.video_file")}}</label>

        <select name="video_file" id="single-prepend-text" class="form-control select2">
            <!--                    <option value="">--><?php // echo 'Select Video File';?><!--</option>-->
            <?php foreach ($videos as $video) {
                $url = explode("/",$video['uri']);

                ?>
                <?php // if($categoryName){?>
                <option value="<?php echo $url[2];?>"
                <?php echo ($item->video_file == $url[2]) ? 'selected' : ''?>>
                <?php echo $video['name'];?></option>
                <?php // }?>
            <?php }?>

        </select>
    </div>

    @if ($errors->has("video_file"))
        <div class="alert alert-danger">
            <span class='help-block'>
                <strong>{{ $errors->first("video_file") }}</strong>
            </span>
        </div>
    @endif


@endif
   <!-- <div class="form-group {{ $errors->has("video_file") ? "has-error" : "" }}" > 
   <label for="video_file">{{ trans("talks.video_file")}}</label>
    <input type="text" name="video_file" class="form-control" id="video_file" value="{{ isset($item->video_file) ? $item->video_file : old("video_file") }}"  placeholder="{{ trans("talks.video_file")}}">
  </div>
   @if ($errors->has("video_file"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("video_file") }}</strong>
     </span>
    </div>
   @endif -->
   <div class="form-group {{ $errors->has("sort") ? "has-error" : "" }}" > 
   <label for="sort">{{ trans("talks.sort")}}</label>
    <input type="text" name="sort" class="form-control" id="sort" value="{{ isset($item->sort) ? $item->sort : old("sort") }}"  placeholder="{{ trans("talks.sort")}}">
  </div>
   @if ($errors->has("sort"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("sort") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group  {{  $errors->has("doctor_name.en")  &&  $errors->has("doctor_name.ar")  ? "has-error" : "" }}" >
   <label for="doctor_name">{{ trans("talks.doctor_name")}}</label>
    {!! extractFiled(isset($item) ? $item : null , "doctor_name", isset($item->doctor_name) ? $item->doctor_name : old("doctor_name") , "text" , "talks") !!}
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

   <div class="form-group">
        <div class="">
            <label for="">Related Talks</label>


            @php $talksrelated = isset($data['Alltalksrelated']) ? $data['Alltalksrelated']->talksrelatedsync->pluck('id')->all() : null 
            @endphp


            {!! Form::select('talksrelated[]' , json_decode($data['allTalks'], true) ,$talksrelated , ['multiple' => true  , 'id' => 'talksrelated' ] ) !!}
        </div>
    </div>


   <div class="form-group  {{  $errors->has("seo_desc[].en")  &&  $errors->has("seo_desc[].ar")  ? "has-error" : "" }}" >
   <label for="seo_desc">{{ trans("talks.seo_desc")}}</label>
    <div id="laraflat-seo_desc">
     @if(isset($item) || old("seo_desc"))
      @if((isset($item->seo_desc) && json_decode($item->seo_desc) ) || old("seo_desc"))
      @php $items = isset($item->seo_desc) && json_decode($item->seo_desc) ? json_decode($item->seo_desc)  : old("seo_desc") @endphp
       @foreach($items as $jsonseo_desc)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_desc[]"  value="{{ $jsonseo_desc}}" type="text" placeholder="{{ trans("talks.seo_desc")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewseo_desc()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllseo_desc(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewseo_desc() {
                                                $("#laraflat-seo_desc").append('<div class="seo_desc form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_desc[]"  type="text" placeholder="{{ trans("talks.seo_desc")}}" >'+'<span class="btn btn-warning" onclick="removeseo_desc(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_desc(e) {
                                                $(e).closest("div.seo_desc").remove();
                                            }
                                            function clearAllseo_desc(e) {
                                                $("#laraflat-seo_desc").html("");
                                            }
                                        </script>
            @endpush
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
   <div class="form-group  {{  $errors->has("seo_keys[].en")  &&  $errors->has("seo_keys[].ar")  ? "has-error" : "" }}" >
   <label for="seo_keys">{{ trans("talks.seo_keys")}}</label>
    <div id="laraflat-seo_keys">
     @if(isset($item) || old("seo_keys"))
      @if((isset($item->seo_keys) && json_decode($item->seo_keys) ) || old("seo_keys"))
      @php $items = isset($item->seo_keys) && json_decode($item->seo_keys) ? json_decode($item->seo_keys)  : old("seo_keys") @endphp
       @foreach($items as $jsonseo_keys)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_keys[]"  value="{{ $jsonseo_keys}}" type="text" placeholder="{{ trans("talks.seo_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewseo_keys()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllseo_keys(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewseo_keys() {
                                                $("#laraflat-seo_keys").append('<div class="seo_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_keys[]"  type="text" placeholder="{{ trans("talks.seo_keys")}}" >'+'<span class="btn btn-warning" onclick="removeseo_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_keys(e) {
                                                $(e).closest("div.seo_keys").remove();
                                            }
                                            function clearAllseo_keys(e) {
                                                $("#laraflat-seo_keys").html("");
                                            }
                                        </script>
            @endpush
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
   <div class="form-group {{ $errors->has("search_keys[]") ? "has-error" : "" }}" > 
   <label for="search_keys">{{ trans("talks.search_keys")}}</label>
    <div id="laraflat-search_keys">
     @if(isset($item) || old("search_keys"))
      @if((isset($item->search_keys) && json_decode($item->search_keys) ) || old("search_keys"))
      @php $items = isset($item->search_keys) && json_decode($item->search_keys) ? json_decode($item->search_keys)  : old("search_keys") @endphp
       @foreach($items as $jsonsearch_keys)
        <div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="search_keys[]"  value="{{ $jsonsearch_keys}}" type="text" placeholder="{{ trans("talks.search_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
       @endforeach
      @endif
     @endif
    <span class="btn btn-success" onclick="AddNewsearch_keys()"><i class="fa fa-plus"></i></span>
    <span class="btn btn-danger" onclick="clearAllsearch_keys(this)"><i class="fa fa-minus"></i></span>
    @push("js")
                                        <script>
                                            function AddNewsearch_keys() {
                                                $("#laraflat-search_keys").append('<div class="search_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="search_keys[]"  type="text" placeholder="{{ trans("talks.search_keys")}}" >'+'<span class="btn btn-warning" onclick="removesearch_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removesearch_keys(e) {
                                                $(e).closest("div.search_keys").remove();
                                            }
                                            function clearAllsearch_keys(e) {
                                                $("#laraflat-search_keys").html("");
                                            }
                                        </script>
            @endpush
     </div>
  </div>
   @if ($errors->has("search_keys[]"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("search_keys[]") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
   <label for="image">{{ trans("talks.image")}}</label>
    @if(isset($item) && $item->image != "")
    <br>
    <img src="{{ small($item->image) }}" class="thumbnail" alt="" width="200">
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
   <div class="form-group {{ $errors->has("promoPoster") ? "has-error" : "" }}" > 
   <label for="promoPoster">{{ trans("talks.promoPoster")}}</label>
    @if(isset($item) && $item->promoPoster != "")
    <br>
    <img src="{{ small($item->promoPoster) }}" class="thumbnail" alt="" width="200">
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
   <div class="form-group {{ $errors->has("cover") ? "has-error" : "" }}" > 
   <label for="cover">{{ trans("talks.cover")}}</label>
    @if(isset($item) && $item->cover != "")
    <br>
    <img src="{{ small($item->cover) }}" class="thumbnail" alt="" width="200">
    <br>
    @endif
    <input type="file" name="cover" >
  </div>
   @if ($errors->has("cover"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("cover") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('talks.talks') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

@section('script')
@include(layoutPath('layout.helpers.tynic'))


<script src="{{ url('/public/admin/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ url('/public/admin/js/search.js') }}"></script>
<script>

    $('#talksrelated').multiSelect(search("Related Talks"));

    function search(name){
        return {
            selectableHeader: "<input type='text' class='form-control' autocomplete='off'  placeholder='"+name+"'>",
            selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='"+name+"'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });
                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        }
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("instructor_id");
        filter = input.value.toUpperCase();
      
        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
           
          } else {
            
          }
        }
      }
</script>
@endsection
