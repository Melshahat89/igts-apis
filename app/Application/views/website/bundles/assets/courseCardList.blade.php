@php
use App\Application\Model\Courses;
$enrolled = Courses::isEnrolledCourse($data->id);
$shoppingCart = Courses::inShoppingCart($data->id);
@endphp
<div class="list-card">
    <div class="row">
        <div class="col-md-4">
        @if(getCurrency() == "EGP")
            @if($data->discount_egp > 0)
            <div class="card-img item promoted" data-awards="{{ $data->discount_egp }}% {{trans('courses.discount')}}">
            @else
            <div class="card-img">
            @endif
        @else
            @if($data->discount_usd > 0)
            <div class="card-img item promoted" data-awards="{{ $data->discount_usd }}">
            @else
            <div class="card-img">
            @endif
        @endif
            <!-- <div class="card-img"> -->
                @if (Auth::check())
                    <a href="{{ url('/courses/toggleFavourite/id/' . $data->id) }}">
                        <i class="flaticon-fav {{ CourseWishlisted($data->id) ? 'checked' : '' }} "></i>
                    </a>
                @else
                    <a href="/login" data-dismiss="modal" data-remote="/login" data-toggle="modal"
                        data-target="#loginModal">
                        <i class="flaticon-fav"></i>
                    </a>
                @endif
                <img class="w-100 img-fit" src="{{ large($data->image) }}" alt="{{ nl2br($data->title_lang) }}"
                    style="width:100%;height:180px">
                <h4>{{ nl2br($data->instructor['fullname_lang']) }}</h4>
                </a>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-item">
                <p class="card-date">{{ trans('website.Last updated') }}: {{ $data->created_at }}</p>
                <h6>
                    <a href="{{ url('/courses/view/' . $data->slug) }}">
                        {{ nl2br($data->title_lang) }}
                    </a>
                </h6>
                <div class="badges flexLeft">
                    <div class="card-data flexLeft">
                        <span><i class="flaticon-play-button"></i><?= count($data->courselectures) ?> {{ trans('courses.lectures') }} </span>
                        <span><i class="flaticon-clock"></i> <?= round($data->length / 60) ?> {{ trans('website.hours') }}</span>

                        <?php if (count($data->courseresources) > 0) { ?>

                            <span><i class="flaticon-download-arrow"></i><?= count($data->courseresources) ?> 
                                {{ trans('courses.downloadable resources') }}</span>
                        <?php } ?>
            
                    </div>

                </div>

                <div class="badges flexLeft">
                    <div class="card-data flexLeft">

                        @if ($data->full_access == 1)
                        <span><i class="flaticon-global"></i> {{ trans('courses.Full lifetime access') }}</span>
                    @else
                            <span><i class="flaticon-global"></i> {{ trans('courses.access 1 year') }}</span>
                        @endif
                        <span><i class="flaticon-graduation-cap"></i>{{ trans('courses.Certificate of Completion') }}</span>
                        <span><i class="flaticon-book"></i> {{ languages()[1] }}</span>
                    </div>
                </div>

                <div class="card-info">
                    <p>
                        
                       
                        {{ \Illuminate\Support\Str::words($data->description_lang, 35, $end='...') }}
                    </p>

                </div>
            </div>

        </div>
        <div class="col-md-3">

            <div class="card-price">
                {!!  $data->PriceTextH1 !!}
            </div>
            <div class="card-rating">
                {!!  $data->Rating !!}
            </div>
            <div class="action-btns mt-20">
                @if (!$shoppingCart && !$enrolled)
                    @if (Auth::check())   
                        <a href="{{ url('/courses/view/' . $data->slug) }}" class="button button_primary button_large ">
                            <button class="add-to-cart">
                                {{ trans('website.More Details') }}
                            </button>
                        </a>
                    @else
                        <a href="{{ url('/courses/view/' . $data->slug) }}" class="button button_primary button_large ">
                            <button class="add-to-cart">
                                {{ trans('website.More Details') }}
                            </button>
                        </a>
                        @endif
                @endif
            </div>
        </div>
    </div>
</div>