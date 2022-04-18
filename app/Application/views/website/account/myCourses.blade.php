@extends(layoutExtend('website'))
@section('title')
    {{ trans('website.My Courses') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
<?php
use App\Application\Model\User;
use App\Application\Model\Transactions;
use Carbon\Carbon;

?>
@section('content')

@include('website.account.profileBrief', ['page' => "myCourses"])    


<!-- courses -->
<section class="sec sec_pad_top sec_pad_bottom bg_lightgray " id="">
        <div class="wrapper">
            <section class="title mblg">
                <h2 class="text_primary text_capitalize">{{trans('home.my courses')}}</h2>
            </section>

            <div tag="" id="yw0" class="list-view">
            <div class="summary"></div>
            <div class="courses_cards">

            @foreach($myCourses as $course)

                <div class="course_card">
                    <a href="/courses/view/{{$course->slug}}">
                        @if($course->image)
                        <span class="course_card_img">
                            <img src="{{large1($course->image)}}">
                            <div class="play_icon"><i class="fas fa-play"></i></div>
                        </span>
                        @endif
                        <div class="course_card_detail" style="height: 130px !important;">
                            <div class="course_card_detail_name" title="{{$course->title_lang}}">{{ charLimit($course->title_lang, 50) }}</div>
                            <div class="course_card_rating_price">
                                @if($course->CourseRating >= 5)
                                <div class="course_card_rating">
                                    <div class="jq_rating jq-stars" data-options='{"initialRating":{{round($course->CourseRating, 1)}}, "readOnly":true, "starSize":15}'></div>
                                    <small class="text_muted">({{round($course->CourseRating, 1)}})</small>
                                </div>
                                @endif
                            </div>
                            
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ round(\App\Application\Model\Progress::getLectureProgress(Auth::user()->id,$course->id)) }}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <?php 

                            $soonExpireDate = Carbon::parse($course->usercourseenrollment()->end_time)->subDays(30)->format('Y-m-d');
                            $now = Carbon::now()->format('Y-m-d');
                            ?>

                            @if($now >= $soonExpireDate)
                            <div class="m-1">
                                <small>{{ trans('account.Expires in') }} {{ $course->usercourseenrollment()->end_time }}</small>
                            </div>
                            @endif
                        </div>
                    </a>
                    
                </div>
                
            @endforeach
            <div class="global-pagenation flexBetween">

                @if($myCourses instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{$myCourses->appends(request()->input())->links('pagination::meduo-pagination') }}
                @endif

            </div>

            </div>
            </div>
        </div>

        </div>
    </section>
    <!-- end courses -->

@endsection
