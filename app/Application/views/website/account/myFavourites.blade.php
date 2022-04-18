@extends(layoutExtend('website'))
@section('title')
    {{ trans('account.My Favourites') }}
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
?>
@section('content')

@include('website.account.profileBrief', ['page' => "myFavourites"])    


    <!-- courses -->
    <section class="sec sec_pad_top sec_pad_bottom bg_lightgray">
        <div class="wrapper">
            <section class="title mblg">
                <h2 class="text_primary text_capitalize">{{trans('home.my favorites')}}</h2>
            </section>

                
               
            @if(count($myFavourites) > 0)

                @foreach($myFavourites as $data)
                    <div class="course_card">
                        <a type="button" href="{{ url('/courses/toggleFavourite/id/'.$data->courses->id) }}" class="course_card_remove favourite_remove" data-course-id="{{$data->courses->id}}"><i class="fas fa-times"></i></a>
                        <a href="/courses/view/{{$data->courses->slug}}">
                        @if($data->courses->image)
                            <span class="course_card_img">
                                <img src="{{large1($data->courses->image)}}">
                                <div class="play_icon"><i class="fas fa-play"></i></div>
                            </span>
                        @endif
                        <div class="course_card_detail">
                            <div class="course_card_detail_name" title="{{$data->courses->title_lang}}">{{ charLimit($data->courses->title_lang, 50) }}</div>
                            <div class="course_card_rating_price">
                                @if($data->CourseRating >= 5){
                                    <div class="course_card_rating">
                                        <div class="jq_rating jq-stars" data-options='{"initialRating":{{round($data->courses->CourseRating, 1)}}, "readOnly":true, "starSize":15}'></div>
                                        <small class="text_muted">({{round($data->courses->CourseRating, 1)}})</small>
                                    </div>
                                @endif
                                <div class="course_card_price">{!! $data->courses->PriceText !!}</div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach

                <div class="global-pagenation flexBetween">

                    @if($myFavourites instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{$myFavourites->appends(request()->input())->links('pagination::meduo-pagination') }}
                    @endif

                </div>
            @endif
            


        </div>
    </section>
    <!-- end courses -->

@endsection
