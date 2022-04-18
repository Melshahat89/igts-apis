
<section class="global-cards latest-release1" style="padding-top: 40px;">
    <div class="container">
    <div class="section_title_1 flexBetween">
        <h4>{!! trans('website.latest releases') !!}</h4>
        <div class="arrow-action">
                <i class="flaticon-back"></i>
                <i class="flaticon-right-arrow"></i>
            </div>
    </div>

    <div class="owl-carousel">
        @foreach ($Data as $course)
        <div>
            <div class="flip-box" style="height: 370px !important;">
                <div class="flip-box-inner">
                    <div class="flip-box-front card-item">
                        <!-- <div class="card-img">
                                    <i class="flaticon-fav {{CourseWishlisted($course->id)?'checked':''}}"  data-course-id="{{$course->id}} " ></i> -->

                        @if(getCurrency() == "EGP")
                        @if($course->discount_egp > 0)
                        <div class="card-img item promoted" data-awards="{{ $course->discount_egp }}% {{trans('courses.discount')}}">
                            @else
                            <div class="card-img">
                                @endif
                                @else
                                @if($course->discount_usd > 0)
                                <div class="card-img item promoted" data-awards="{{ $course->discount_usd }}% {{trans('courses.discount')}}">
                                    @else
                                    <div class="card-img">
                                        @endif
                                        @endif
                                        <img class="w-100" style="width:100%;height:250px" src="{{large1($course->image)}}" alt="{{ nl2br($course->title_lang) }}">
                                        <h4>{{ nl2br($course->instructor['fullname_lang']) }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <h6 class="card-title">


                                            {{ \Illuminate\Support\Str::words($course->title_lang, 9, $end='...') }}
                                        </h6>
                                        @if($course->coursereviews->count() > 0)
                                        <div class="card-rating">
                                            {{$course->CourseRating}}
                                        </div>
                                        @endif
                                        <div class="card-price flexBetween">
                                            {!!$course->PriceText !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="flip-box-back card-item  p-10">
                                    <p class="card-date"> {{ trans('website.Last updated') }} : <?= $course->created_at; ?></p>
                                    <a href="{{ url('/courses/view/'.$course->slug) }}">
                                        {{ \Illuminate\Support\Str::words($course->title_lang, 9, $end='...') }}
                                    </a>
                                    <div class="badges flexLeft">
                                        {{ trans('website.in') }}
                                        <a href="{{ url('/courses/view/'.$course->slug) }}">
                                            {{ \Illuminate\Support\Str::words($course->title_lang, 9, $end='...') }}
                                        </a>
                                    </div>

                                    <div class="card-data flexBetween">
                                        <span><i class="flaticon-play-button"></i><?= count($course->courselectures); ?> {{ trans('courses.lectures') }} </span>
                                        <span><i class="flaticon-clock"></i> {{$course->getHoursLectures($course->length)}} {{ trans('website.hours') }}</span>

                                    </div>
                                    <div class="card-info">
                                        <p>

                                            {{ \Illuminate\Support\Str::words($course->description_lang, 70, $end='...') }}
                                        </p>
                                    </div>
                                    <div class="action-btns flexBetween" style="padding-top: 39px;">
                                        
                                        @if(Auth::check())
                                        <a href="{{ url('/courses/view/'.$course->slug) }}" class="button button_primary button_large ">
                                            <button class="add-to-cart">
                                                {{ trans('website.More Details') }}
                                            </button>
                                        </a>
                                        <a href="javascript: void(0)" onclick="toggleWishListAjax({{$course->id}})">

<i class="flaticon-fav  {{CourseWishlisted($course->id)?'checked':''}}"  data-course-id="{{ $course->id }}" id="{{$course->id}}"></i>
</a>
                                        @else
                                        <a href="{{ url('/courses/view/'.$course->slug) }}" class="button button_primary button_large ">
                                            <button class="add-to-cart">
                                                {{ trans('website.More Details') }}
                                            </button>
                                        </a>
                                        <a href="/login" data-dismiss="modal" data-remote="/login" data-toggle="ajaxModal" class="bunch_item_wishlist">
                                            <i class="flaticon-fav  {{CourseWishlisted($course->id)?'checked':''}}" data-course-id="{{ $course->id }}"></i>
                                        </a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>



</section>