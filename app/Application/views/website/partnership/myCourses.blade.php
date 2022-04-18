@extends(layoutExtend('website'))
@section('title')
{{ trans('partnership.My Courses') }} | {{ trans('partnership.partnership') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
    <div class="bread-crumb">
        <div class="container">
            <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.My Courses') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1 class="mt-20 mb-20">{{ trans('partnership.My Courses') }}</h1>
            
        </div>
    </div>

    
    <section class="my_enrroled">
      <div class="container">
        {{--  <h4 class="mb-20">{{ trans('partnership.My Courses') }}</h4>  --}}
    
        <div class="my-btns mt-20 mb-20">
          <a class="more_button w-100 text-center" href="{{url('partnership/addCourse')}}">
            {{ trans('partnership.Add new course') }}
            <i class="fas fa-plus-circle"></i>
          </a>
        </div>


        @isset($Courses)
          @foreach($Courses as $key => $item)
          <div class="my_course_card mb-20">
            <div class="row">
              <div class="col-md-3">
                <div class="card-img">
                  <img class="w-100" src="{{large($item->image)}}" alt="...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-item">
                  <p class="card-date">{{trans('website.Last updated')}}: {{$item->created_at }}</p>
                  <h4>
                    {{ nl2br($item->title_lang) }}
                  </h4>
                           
      
                  <div class="card-info">
                    <p>
                      {!! nl2br($item->description_lang) !!}
                    </p>
                  </div>     
              </div>
              </div>
              <div class="col-md-3">
                <div class="completed">
                  <h1>{{ ($item->CourseCountStudents) }}</h1>
                  <span>{{ trans('partnership.Enrolled Students') }}</span>
                </div>
                <div class="my-btns mt-20">
                  <a class="more_button w-100 text-center" href="{{url('partnership/addCourse/'.$item->id)}}">{{ trans('partnership.edit') }}</a>
                  <a class="more_button w-100 text-center mt-10" href="{{url('/courses/view/'.$item->slug)}}">{{ trans('partnership.show') }}</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
            
        @endisset
        

      </div>
     </section>
    
    
      
  

@endsection