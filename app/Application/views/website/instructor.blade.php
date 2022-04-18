@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }} - {{ trans('website.My Cart') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection
@section('content')

<main class="main_content">


@if(isset($instructor))

    @include('website.instructorBrief', ['instructor' => $instructor])


    <section class="about-instructor talk-course-content">
        <div class="container instructor-desc">
            {!! $instructor->description_lang !!}
        </div>
    </section>



    @if(count($latestTenCourses) > 0)

        <section class="sec sec_pad_top sec_pad_bottom">
            <div class="wrapper">

                <section class="title mbmd">
                    <h2 class="text_primary text_capitalize">{{ trans('website.Discover My Courses') }}</h2>
                </section>
        
                <div id="instructorCoursesList">
                    <div class="courses_cards owl-carousel owl-theme instructorCoursesList">
                        @foreach($latestTenCourses as $course)
                            @include(sectionBestLearning('website'), ['data' => $course])
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
                            
    @endif

@endif


</main>

@endsection