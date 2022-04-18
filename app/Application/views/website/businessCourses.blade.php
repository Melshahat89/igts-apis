@extends(layoutExtend('website'))
@section('title')
    {{ trans('courses.businessCourses') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
<?php
use App\Application\Model\User;
use App\Application\Model\Courses;
use App\Application\Model\Transactions;
?>
@section('content')

    <div class="bread-crumb">
        <div class="container">
            <a href="/">{{ trans('website.home') }}</a> > 
            <span> {{ trans('courses.businessCourses') }} </span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1>{{ trans('courses.businessCourses') }} ({{$businessdata->name_lang}})</h1>
            <p class="mt-15">
            </p>
        </div>
    </div>


    <section class="my_enrroled">
        <div class="container">

        @if($businessdata->banner)
        {{-- //Desc --}}
        <img style="width: 100%; padding:20px;" class="w-100 p-4" src="{{ url(env('UPLOAD_PATH') . '/' . $businessdata->banner) }}" />
        @endif

            @foreach($businessCourses as $key => $courseE)
            <?php
            $course = $courseE->courses;
            ?>
            <div class="my_course_card mb-20">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-img">
                            <img class="w-100" style="width:100%;height:180px" src="{{large($course->image)}}" alt="{{ nl2br($course->title_lang) }}" >
                                        <h4>{{ nl2br($course->instructor['fullname_lang']) }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-item">
                            <p class="card-date">{{trans('website.expires in')}}: {{$businessdata->end_time}}</p>
                            <h4>
                                {{ nl2br($course->title_lang) }}
                            </h4>
            
            
                            <div class="card-info">
                                <p>
                                    {!! substr(nl2br($course->description_lang),0,500) . " ..." !!} 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="completed enrolled-style">
                            {{--  <h1>{{ trans('account.Enrolled') }}</h1>  --}}
                            <span>{{ trans('account.Start your path') }}
                               </span>
                        </div>
                        <div class="my-btns mt-20">
                            @if(Courses::isEnrolledCourse($course->id, Auth::user()->id))
                            <a class="view-more-section w-100 text-center" href="{{ url('/courses/view/'.$course->slug) }} "> {{ trans('account.Start Now') }} </a>
                            @else
                            <a class="view-more-section w-100 text-center" href="{{ url('/courses/view/'.$course->slug) }} "> {{ trans('account.Enroll Now') }} </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
