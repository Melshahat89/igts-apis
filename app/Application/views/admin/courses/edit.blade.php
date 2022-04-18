@extends(layoutExtend())
@section('title')
    {{ trans('courses.courses') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('style')
<link rel="stylesheet" href="{{ url('/public/admin/plugins/multi-select/css/multi-select.css') }}">
{{ Html::style('/public/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endsection
@section('content')
    @component(layoutForm() , ['title' => trans('courses.courses') , 'model' => 'courses' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
        @include(layoutMessage())


@if(isset($item))
<a href="/lazyadmin/courses/item/{{$item->id}}/update" class="btn btn-primary pb-4" type="button">Update Course Content</a>
@endif


        <form action="{{ concatenateLangToUrl('lazyadmin/courses/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courses.relation.categories.edit")
            <div class="form-group">
                <div class="">
                    <label for="">{{ trans('courses.other_categories') }}</label>
                    @php $other_categories = isset($item['other_categories']) ? json_decode($item['other_categories'], true) : null ;

                    @endphp
                    {!! Form::select('other_categories[]' , json_decode($data['allCats'], true) ,$other_categories , ['multiple' => true  , 'id' => 'other_categories' ] ) !!}
                </div>
            </div>



            @include("admin.courses.relation.instructor.edit")
            <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                <label for="title">{{ trans("courses.title")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "courses") !!}
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
                <label for="slug">{{ trans("courses.slug")}}</label>
                <input type="text" name="slug" class="form-control" id="slug" value="{{ isset($item->slug) ? $item->slug : old("slug") }}"  placeholder="{{ trans("courses.slug")}}">
            </div>
            @if ($errors->has("slug"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("slug") }}</strong>
                     </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("vdocipher_tag") ? "has-error" : "" }}" >
                <label for="vdocipher_tag">{{ trans("courses.vdocipher_tag")}}</label>
                <input type="text" name="vdocipher_tag" class="form-control" id="vdocipher_tag" value="{{ isset($item->vdocipher_tag) ? $item->vdocipher_tag : old("vdocipher_tag") }}"  placeholder="{{ trans("courses.vdocipher_tag")}}">
            </div>
            @if ($errors->has("vdocipher_tag"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("vdocipher_tag") }}</strong>
                     </span>
                </div>
            @endif


            <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
                <label for="description">{{ trans("courses.description")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "courses", 'tinymce' ) !!}
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

            <div class="form-group  {{  $errors->has("additional_field")  &&  $errors->has("additional_field")  ? "has-error" : "" }}" >
                <label for="additional_field">Add Additional Field</label>
                {!! extractFiled(null, "additional_field_title", null, "text", "courses") !!}
                {!! extractFiled(null, "additional_field_description", null , "textarea" , "courses",'tinymce' ) !!}

            </div>



            @if(isset($item) && isset($item->dynamicfields))
                @foreach($item->dynamicfields as $field)
                <label for="{{$field->name}}_description">{{$field->title_en}}</label>
                {!! extractTexAreaArr($field , "dynamicfields", "description", 'tinymce') !!}
                @endforeach
            @endif

            
            <!-- <div class="form-group  {{  $errors->has("welcome_message.en")  &&  $errors->has("welcome_message.ar")  ? "has-error" : "" }}" >
                <label for="welcome_message">{{ trans("courses.welcome_message")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "welcome_message", isset($item->welcome_message) ? $item->welcome_message : old("welcome_message") , "text" , "courses") !!}
            </div> -->
            @if ($errors->has("welcome_message.en"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("welcome_message.en") }}</strong>
     </span>
                </div>
            @endif
            @if ($errors->has("welcome_message.ar"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("welcome_message.ar") }}</strong>
     </span>
                </div>
            @endif
            <!-- <div class="form-group  {{  $errors->has("congratulation_message.en")  &&  $errors->has("congratulation_message.ar")  ? "has-error" : "" }}" >
                <label for="congratulation_message">{{ trans("courses.congratulation_message")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "congratulation_message", isset($item->congratulation_message) ? $item->congratulation_message : old("congratulation_message") , "text" , "courses") !!}
            </div> -->
            @if ($errors->has("congratulation_message.en"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("congratulation_message.en") }}</strong>
     </span>
                </div>
            @endif
            @if ($errors->has("congratulation_message.ar"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("congratulation_message.ar") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" >
                <label for="type">{{ trans("courses.type")}}</label>
                {{-- <input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("courses.type")}}"> --}}
            
                <select name="type"  class="form-control input-item select-custom" >
                    @php  $type = isset($item) ? $item->type : null @endphp
                    @foreach( typesCourses() as $key => $typesCourse)
                      <option value="{{ $key }}"  {{ $key == $type  ? "selected" : "" }}> {{ is_json($typesCourse) ? $typesCourse :  $typesCourse}}</option>
                    @endforeach
                  </select>
            </div>
            @if ($errors->has("type"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("type") }}</strong>
     </span>
                </div>
            @endif


            <div class="form-group {{ $errors->has("zoom_link") ? "has-error" : "" }}" >
                <label for="zoom_link">{{ trans("courses.zoom_link")}}</label>
                <input type="text" name="zoom_link" class="form-control" id="zoom_link" value="{{ isset($item->zoom_link) ? $item->zoom_link : old("zoom_link") }}"  placeholder="{{ trans("courses.zoom_link")}}">
            </div>
            @if ($errors->has("zoom_link"))
            <div class="alert alert-danger">
                <span class='help-block'>
                <strong>{{ $errors->first("zoom_link") }}</strong>
                </span>
            </div>
            @endif


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


            <div class="form-group {{ $errors->has("skill_level") ? "has-error" : "" }}" >
                <label for="skill_level">{{ trans("courses.skill_level")}}</label>
                <input type="text" name="skill_level" class="form-control" id="skill_level" value="{{ isset($item->skill_level) ? $item->skill_level : old("skill_level") }}"  placeholder="{{ trans("courses.skill_level")}}">
            </div>
            @if ($errors->has("skill_level"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("skill_level") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("language_id") ? "has-error" : "" }}" >
                <label for="language_id">{{ trans("courses.language_id")}}</label>
                {{-- <input type="text" name="language_id" class="form-control" id="language_id" value="{{ isset($item->language_id) ? $item->language_id : old("language_id") }}"  placeholder="{{ trans("courses.language_id")}}"> --}}
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
            <div class="form-group {{ $errors->has("has_captions") ? "has-error" : "" }}" >
                <label for="has_captions">{{ trans("courses.has_captions")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="has_captions" {{ isset($item->has_captions) && $item->has_captions == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="has_captions" {{ isset($item->has_captions) && $item->has_captions == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("has_captions"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("has_captions") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("has_certificate") ? "has-error" : "" }}" >
                <label for="has_certificate">{{ trans("courses.has_certificate")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="has_certificate" {{ isset($item->has_certificate) && $item->has_certificate == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="has_certificate" {{ isset($item->has_certificate) && $item->has_certificate == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("has_certificate"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("has_certificate") }}</strong>
                 </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("length") ? "has-error" : "" }}" >
                <label for="length">{{ trans("courses.length")}}</label>
                <input type="text" name="length" class="form-control" id="length" value="{{ isset($item->length) ? $item->length : old("length") }}"  placeholder="{{ trans("courses.length")}}">
            </div>
            @if ($errors->has("length"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("length") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("price") ? "has-error" : "" }}" >
                <label for="price">{{ trans("courses.price")}}</label>
                <input type="text" name="price" class="form-control" id="price" value="{{ isset($item->price) ? $item->price : old("price") }}"  placeholder="{{ trans("courses.price")}}">
            </div>
            @if ($errors->has("price"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("price_in_dollar") ? "has-error" : "" }}" >
                <label for="price_in_dollar">{{ trans("courses.price_in_dollar")}}</label>
                <input type="text" name="price_in_dollar" class="form-control" id="price_in_dollar" value="{{ isset($item->price_in_dollar) ? $item->price_in_dollar : old("price_in_dollar") }}"  placeholder="{{ trans("courses.price_in_dollar")}}">
            </div>
            @if ($errors->has("price_in_dollar"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("price_in_dollar") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("affiliate1_per") ? "has-error" : "" }}" >
                <label for="affiliate1_per">{{ trans("courses.affiliate1_per")}}</label>
                <input type="text" name="affiliate1_per" class="form-control" id="affiliate1_per" value="{{ isset($item->affiliate1_per) ? $item->affiliate1_per : old("affiliate1_per") }}"  placeholder="{{ trans("courses.affiliate1_per")}}">
            </div>
            @if ($errors->has("affiliate1_per"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate1_per") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("affiliate2_per") ? "has-error" : "" }}" >
                <label for="affiliate2_per">{{ trans("courses.affiliate2_per")}}</label>
                <input type="text" name="affiliate2_per" class="form-control" id="affiliate2_per" value="{{ isset($item->affiliate2_per) ? $item->affiliate2_per : old("affiliate2_per") }}"  placeholder="{{ trans("courses.affiliate2_per")}}">
            </div>
            @if ($errors->has("affiliate2_per"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate2_per") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("affiliate3_per") ? "has-error" : "" }}" >
                <label for="affiliate3_per">{{ trans("courses.affiliate3_per")}}</label>
                <input type="text" name="affiliate3_per" class="form-control" id="affiliate3_per" value="{{ isset($item->affiliate3_per) ? $item->affiliate3_per : old("affiliate3_per") }}"  placeholder="{{ trans("courses.affiliate3_per")}}">
            </div>
            @if ($errors->has("affiliate3_per"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate3_per") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("affiliate4_per") ? "has-error" : "" }}" >
                <label for="affiliate4_per">{{ trans("courses.affiliate4_per")}}</label>
                <input type="text" name="affiliate4_per" class="form-control" id="affiliate4_per" value="{{ isset($item->affiliate4_per) ? $item->affiliate4_per : old("affiliate4_per") }}"  placeholder="{{ trans("courses.affiliate4_per")}}">
            </div>
            @if ($errors->has("affiliate4_per"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("affiliate4_per") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("instructor_per") ? "has-error" : "" }}" >
                <label for="instructor_per">{{ trans("courses.instructor_per")}}</label>
                <input type="text" name="instructor_per" class="form-control" id="instructor_per" value="{{ isset($item->instructor_per) ? $item->instructor_per : old("instructor_per") }}"  placeholder="{{ trans("courses.instructor_per")}}">
            </div>
            @if ($errors->has("instructor_per"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("instructor_per") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("discount_egp") ? "has-error" : "" }}" >
                <label for="discount_egp">{{ trans("courses.discount_egp")}}</label>
                <input type="text" name="discount_egp" class="form-control" id="discount_egp" value="{{ isset($item->discount_egp) ? $item->discount_egp : old("discount_egp") }}"  placeholder="{{ trans("courses.discount_egp")}}">
            </div>
            @if ($errors->has("discount_egp"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_egp") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("discount_usd") ? "has-error" : "" }}" >
                <label for="discount_usd">{{ trans("courses.discount_usd")}}</label>
                <input type="text" name="discount_usd" class="form-control" id="discount_usd" value="{{ isset($item->discount_usd) ? $item->discount_usd : old("discount_usd") }}"  placeholder="{{ trans("courses.discount_usd")}}">
            </div>
            @if ($errors->has("discount_usd"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("discount_usd") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("featured") ? "has-error" : "" }}" >
                <label for="featured">{{ trans("courses.featured")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="featured" {{ isset($item->featured) && $item->featured == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("featured"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("featured") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" >
                <label for="image">{{ trans("courses.image")}}</label>
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
            <div class="form-group {{ $errors->has("promo_video") ? "has-error" : "" }}" >
                <label for="promo_video">{{ trans("courses.promo_video")}}</label>
                {{--  <input type="text" name="promo_video" class="form-control" id="promo_video" value="{{ isset($item->promo_video) ? $item->promo_video : old("promo_video") }}"  placeholder="{{ trans("courses.promo_video")}}">  --}}
            
                <div class="input-group select2-bootstrap-prepend col-md-8">
                    {{--  <span class="input-group-btn">
                        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>  --}}
                <select name="promo_video" id="single-prepend-text" class="form-control select2">
                    
                    
                    <option value=""> -- Select Promo Video -- </option>
                    @php
                        $videos = \App\Application\Model\Courses::getAllVimeoPromos();
                    @endphp
                    
                    @foreach ($videos as $video)
                    @php
                        $url = explode("/",$video['uri']);
                    @endphp
                        <option value="{{ $url[2] }}"
                            @if(isset($item->promo_video))
                            {{($item->promo_video == $url[2]) ? 'selected' : ''}}
                            @endif
                            >
                                <?php echo $video['name'];?>    
                        </option>
                            
                       
                    @endforeach
    
                </select>
            </div>
            
            
            </div>
            @if ($errors->has("promo_video"))
                <div class="alert alert-danger">
                <span class='help-block'>
                <strong>{{ $errors->first("promo_video") }}</strong>
                </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("visits") ? "has-error" : "" }}" >
                <label for="visits">{{ trans("courses.visits")}}</label>
                <input type="text" name="visits" class="form-control" id="visits" value="{{ isset($item->visits) ? $item->visits : old("visits") }}"  placeholder="{{ trans("courses.visits")}}">
            </div>
            @if ($errors->has("visits"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("visits") }}</strong>
     </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("webinar_url") ? "has-error" : "" }}" >
                <label for="webinar_url">{{ trans("courses.webinar_url")}}</label>
                <input type="text" name="webinar_url" class="form-control" id="webinar_url" value="{{ isset($item->webinar_url) ? $item->webinar_url : old("webinar_url") }}"  placeholder="{{ trans("courses.webinar_url")}}">
            </div>
            @if ($errors->has("webinar_url"))
                <div class="alert alert-danger">
                    <span class='help-block'>
                    <strong>{{ $errors->first("webinar_url") }}</strong>
                    </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("published") ? "has-error" : "" }}" >
                <label for="published">{{ trans("courses.published")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="published" {{ isset($item->published) && $item->published == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("published"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("published") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("position") ? "has-error" : "" }}" >
                <label for="position">{{ trans("courses.position")}}</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ isset($item->position) ? $item->position : old("position") }}"  placeholder="{{ trans("courses.position")}}">
            </div>
            @if ($errors->has("position"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("position") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("sort") ? "has-error" : "" }}" >
                <label for="sort">{{ trans("courses.sort")}}</label>
                <input type="text" name="sort" class="form-control" id="sort" value="{{ isset($item->sort) ? $item->sort : old("sort") }}"  placeholder="{{ trans("courses.sort")}}">
            </div>
            @if ($errors->has("sort"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("sort") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group  {{  $errors->has("doctor_name")  &&  $errors->has("doctor_name")  ? "has-error" : "" }}" >
                <label for="doctor_name">{{ trans("courses.doctor_name")}}</label>
                <input type="text" name="doctor_name" class="form-control" id="doctor_name" value="{{ isset($item->doctor_name) ? $item->doctor_name : old("doctor_name") }}"  placeholder="{{ trans("courses.doctor_name")}}">

            </div>
            @if ($errors->has("doctor_name"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("doctor_name") }}</strong>
     </span>
                </div>
            @endif
          
            <div class="form-group {{ $errors->has("full_access") ? "has-error" : "" }}" >
                <label for="full_access">{{ trans("courses.full_access")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="full_access" {{ isset($item->full_access) && $item->full_access == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="full_access" {{ isset($item->full_access) && $item->full_access == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("full_access"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("full_access") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("access_time") ? "has-error" : "" }}" >
                <label for="access_time">{{ trans("courses.access_time")}}</label>
                <input type="text" name="access_time" class="form-control" id="access_time" value="{{ isset($item->access_time) ? $item->access_time : old("access_time") }}"  placeholder="{{ trans("courses.access_time")}}">
            </div>
            @if ($errors->has("access_time"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("access_time") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("soon") ? "has-error" : "" }}" >
                <label for="soon">{{ trans("courses.soon")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="soon" {{ isset($item->soon) && $item->soon == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="soon" {{ isset($item->soon) && $item->soon == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		</div>
            @if ($errors->has("soon"))
                <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("soon") }}</strong>
     </span>
                </div>
            @endif
            <div class="form-group  {{  $errors->has("seo_desc.en")  &&  $errors->has("seo_desc.ar")  ? "has-error" : "" }}" >
                <label for="seo_desc">{{ trans("courses.seo_desc")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "seo_desc", isset($item->seo_desc) ? $item->seo_desc : old("seo_desc") , "text" , "courses") !!}
            </div>
            @if ($errors->has("seo_desc.en"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("seo_desc.en") }}</strong>
                 </span>
                </div>
            @endif
            @if ($errors->has("seo_desc.ar"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("seo_desc.ar") }}</strong>
                 </span>
                </div>
            @endif

            <div class="form-group  {{  $errors->has("seo_keys[].en")  &&  $errors->has("seo_keys[].ar")  ? "has-error" : "" }}" >
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
            <div class="form-group  {{  $errors->has("search_keys[].en")  &&  $errors->has("search_keys[].ar")  ? "has-error" : "" }}" >
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
                <label for="poster">{{ trans("courses.poster")}}</label>
                @if(isset($item) && $item->poster != "")
                    <br>
                    <img src="{{ small($item->poster) }}" class="thumbnail" alt="" width="200">
                    <br>
                @endif
                <input type="file" name="poster" >
            </div>
            @if ($errors->has("poster"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("poster") }}</strong>
                     </span>
                </div>
            @endif
            <div class="form-group {{ $errors->has("promoPoster") ? "has-error" : "" }}" >
                <label for="promoPoster">{{ trans("courses.promoPoster")}}</label>
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

            <div class="form-group  {{  $errors->has("will_learn.en")  &&  $errors->has("will_learn.ar")  ? "has-error" : "" }}" >
                <label for="will_learn">{{ trans("courses.You Will Learn")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "will_learn", isset($item->will_learn) ? $item->will_learn : old("will_learn") , "textarea" , "courses",'tinymce' ) !!}
            </div>
            @if ($errors->has("will_learn.en"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("will_learn.en") }}</strong>
                 </span>
                </div>
            @endif
            @if ($errors->has("will_learn.ar"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("will_learn.ar") }}</strong>
                 </span>
                </div>
            @endif

            <div class="form-group  {{  $errors->has("requirments.en")  &&  $errors->has("requirments.ar")  ? "has-error" : "" }}" >
                <label for="requirments">{{ trans("courses.Requirments")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "requirments", isset($item->requirments) ? $item->requirments : old("requirments") , "textarea" , "courses",'tinymce' ) !!}
            </div>
            @if ($errors->has("requirments.en"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("requirments.en") }}</strong>
                 </span>
                </div>
            @endif
            @if ($errors->has("requirments.ar"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("requirments.ar") }}</strong>
                 </span>
                </div>
            @endif


            <div class="form-group  {{  $errors->has("description_large.en")  &&  $errors->has("description_large.ar")  ? "has-error" : "" }}" style="display: none;">
                <label for="description_large">{{ trans("courses.description_large")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "description_large", isset($item->description_large) ? $item->description_large : old("description_large") , "textarea" , "courses",'tinymce' ) !!}
            </div>
            @if ($errors->has("description_large.en"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("description_large.en") }}</strong>
                 </span>
                </div>
            @endif
            @if ($errors->has("description_large.ar"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("description_large.ar") }}</strong>
                 </span>
                </div>
            @endif

            <div class="form-group  {{  $errors->has("target_students.en")  &&  $errors->has("target_students.ar")  ? "has-error" : "" }}" >
                <label for="target_students">{{ trans("courses.target_students")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "target_students", isset($item->target_students) ? $item->target_students : old("target_students") , "textarea" , "courses",'tinymce' ) !!}
            </div>
            @if ($errors->has("target_students.en"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("target_students.en") }}</strong>
                 </span>
                </div>
            @endif
            @if ($errors->has("target_students.ar"))
                <div class="alert alert-danger">
                 <span class='help-block'>
                  <strong>{{ $errors->first("target_students.ar") }}</strong>
                 </span>
                </div>
            @endif

            <div class="form-group  {{  $errors->has("accreditation_text.en")  &&  $errors->has("accreditation_text.ar")  ? "has-error" : "" }}" >
                <label for="accreditation_text">{{ trans("courses.accreditation_text")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "accreditation_text", isset($item->accreditation_text) ? $item->accreditation_text : old("accreditation_text") , "textarea" , "courses",'tinymce' ) !!}
            </div>
            

            <div class="form-group {{ $errors->has("is_partnership") ? "has-error" : "" }}" >
                <label for="is_partnership">{{ trans("courses.is_partnership")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="is_partnership" {{ isset($item->is_partnership) && $item->is_partnership == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="is_partnership" {{ isset($item->is_partnership) && $item->is_partnership == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		
            </div>
            @if ($errors->has("is_partnership"))
                <div class="alert alert-danger">
                <span class='help-block'>
                <strong>{{ $errors->first("is_partnership") }}</strong>
                </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("videosready") ? "has-error" : "" }}" >
                <label for="videosready">{{ trans("courses.videosready")}}</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="videosready" {{ isset($item->videosready) && $item->videosready == 0 ? "checked" : "" }} type="radio" value="0" >
                        {{ trans("courses.No")}}
                    </label >
                    <label class="form-check-label">
                        <input class="form-check-input" name="videosready" {{ isset($item->videosready) && $item->videosready == 1 ? "checked" : "" }} type="radio" value="1" >
                        {{ trans("courses.Yes")}}
                    </label>
                </div> 		
            </div>
            @if ($errors->has("videosready"))
                <div class="alert alert-danger">
                <span class='help-block'>
                <strong>{{ $errors->first("videosready") }}</strong>
                </span>
                </div>
            @endif

            <div class="form-group">
                <div class="">
                    <label for="">{{ trans('courseincludes.courseincludes') }}</label>


                    @php $courseincludes = isset($data['Allcourseincludes']) ? $data['Allcourseincludes']->coursesincluded->pluck('id')->all() : null 
                    @endphp


                    {!! Form::select('coursesincluded[]' , json_decode($data['allCourses'], true) ,$courseincludes , ['multiple' => true  , 'id' => 'courseincludes' ] ) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="">
                    <label for="">Related Courses</label>


                    @php $courserelated = isset($data['Allcourserelated']) ? $data['Allcourserelated']->courserelatedsync->pluck('id')->all() : null 
                    @endphp

<?php //dd($courserelated); ?>
                    {!! Form::select('courserelated[]' , json_decode($data['allCourses'], true) ,$courserelated , ['multiple' => true  , 'id' => 'courserelated' ] ) !!}


                    </div>
            </div>

            <div class="form-group">
                <div class="">
                    <label for="">Related Events</label>


                    @php $eventsrelated = isset($data['Alleventincludes']) ? $data['Alleventincludes']->coursesrelatedevents->pluck('id')->all() : null 
                    @endphp


                    {!! Form::select('coursesrelatedevents[]' , json_decode($data['allEvents'], true) ,$eventsrelated , ['multiple' => true  , 'id' => 'coursesrelatedevents' ] ) !!}
                


                    </div>
            </div>



            <div class="form-group {{ $errors->has("certificates") ? "has-error" : "" }}" > 
                <label for="certificates">{{ trans("eventsdata.certificates")}}</label>
                @isset($item)
                    @if(json_decode($item->certificates))
                        <input type="hidden" name="oldFiles_certificates" value="{{ $item->certificates }}">
                        @php $certificates = returnFilesImages($item , "certificates"); @endphp
                        <div class="row text-center">
                            @foreach($certificates["image"] as $jsonimage )
                                <div class="col-lg-2 text-center"><img src="{{ small($jsonimage) }}" class="img-responsive" /><br>
                                <a class="btn btn-danger" onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/courses/".$item->id."?name=".$jsonimage."&filed_name=certificates") }}"><i class="fa fa-trash"></i></a></div>
                            @endforeach
                        </div>
                        <div class="row text-center">
                            @foreach($certificates["file"] as $jsonimage )
                                <div class="col-lg-2 text-center"><a href="{{ url(env("UPLOAD_PATH")."/".$jsonimage) }}" ><i class="fa fa-file"></i></a>
                                <span  onclick="deleteThisItem(this)" data-link="{{ url("deleteFile/courses/".$item->id."?name=".$jsonimage."&filed_name=certificates") }}"><i class="fa fa-trash"></i> {{ $jsonimage }} </span></div>
                            @endforeach
                        </div>
                    @endif
                @endisset
            <input type="file" name="certificates[]" multiple>
            </div>
            @if ($errors->has("certificates"))
                <div class="alert alert-danger">
                    <span class='help-block'>
                        <strong>{{ $errors->first("certificates") }}</strong>
                    </span>
                </div>
            @endif



            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('courses.courses') }}
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
    $('#other_categories').multiSelect(search("{{ trans('courses.other_categories') }}"));
    {{-- $('#instructor_id').multiSelect(search("{{ trans('courses.instructor_id') }}")); --}}
    $('#courseincludes').multiSelect(search("{{ trans('courseincludes.courseincludes') }}"));
    $('#courserelated').multiSelect(search("Related Courses"));
    $('#coursesrelatedevents').multiSelect(search("Related Events"));

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
