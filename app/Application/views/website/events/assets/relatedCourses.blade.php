@php
    use App\Application\Model\Courses;
@endphp

<section class="talk-course-content" id="similar-talks">
    <h5 class="mb-20"><strong>{{ trans('courses.Recommended courses') }}</strong></h5>

    <div class="owl-carousel">
        @foreach ($relatedCourses as $item)
            @php 
                $course = $item;
            @endphp
            @if($course)
            @php
                $shoppingCart = Courses::inShoppingCart($model->id);
                $enrolled = Courses::isEnrolledCourse($model->id);
            @endphp
                <div>
                    <div class="flip-box">
                        <div class="flip-box-inner">
                            <div class="flip-box-front card-item">
                                <div class="card-img">
                                    <i class="flaticon-fav {{CourseWishlisted($course->id)?'checked':''}}"  data-course-id="{{$course->id}} " ></i>
                                    <img class="w-100" style="width:100%;height:180px" src="{{large($course->image)}}" alt="{{ nl2br($course->title_lang) }}" >
                                    <h4>{{ nl2br($course->instructor['fullname_lang']) }}</h4>
                                </div>
                                <div class="card-content">
                                    <h6 class="card-title">
                                      
                                        {{ \Illuminate\Support\Str::words($course->title_lang, 9, $end='...') }}
                                   
                                    </h6>
                                    <div class="card-rating">
                                        {{$course->CourseRating}}
                                    </div>
                                    <div class="card-price flexBetween">
                                        {!!$course->PriceText !!}
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box-back card-item  p-10">
                                <p class="card-date"> {{ trans('website.Last updated') }} :  <?= $course->created_at; ?></p>
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
                                    <span><i class="flaticon-play-button" ></i><?= count($course->courselectures); ?> {{ trans('courses.lectures') }} </span>
                                    <span><i class="flaticon-clock"></i> <?= round($course->length / 60); ?> {{ trans('website.hours') }}</span>

                                </div>
                                <div class="card-info">
                                    <p>
                                       {{substr(strip_tags($course->description_lang),0,600) . " ..."}}
                                    </p>
                                </div>
                                <div class="action-btns flexBetween">
                                    @if(!$shoppingCart && !$enrolled)
                                        @if(Auth::check())
                                            <a href="{{ url('/courses/view/'.$course->slug) }}" class="button button_primary button_large ">
                                                <button class="add-to-cart">
                                                    {{ trans('website.More Details') }}
                                                </button>
                                            </a>
                                            <a href="{{ url('/courses/toggleFavourite/id/'.$course->slug) }}" class="bunch_item_wishlist">
                                                <i class="flaticon-fav  {{CourseWishlisted($course->id)?'checked':''}}"  data-course-id="{{ $course->id }}"></i>
                                            </a>
                                        @else
                                            <a href="{{ url('/courses/view/'.$course->slug) }}" class="button button_primary button_large ">
                                                <button class="add-to-cart">
                                                    {{ trans('website.More Details') }}
                                                </button>
                                            </a>
                                            <a href="/login" data-dismiss="modal" data-remote="/login" data-toggle="ajaxModal" class="bunch_item_wishlist">
                                                <i class="flaticon-fav  {{CourseWishlisted($course->id)?'checked':''}}"  data-course-id="{{ $course->id }}"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>