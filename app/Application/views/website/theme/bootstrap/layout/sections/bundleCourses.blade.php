<?php $fullRating = ($data->reviewsCount) ? $data->reviewsSum / $data->reviewsCount : 0; ?>
@php $discountApplied = 0; @endphp
<div class="bunch_item">


@if(userCountry()['code'] == "EG")
    @if($data->discount_egp > 0)
        @php $discountApplied = 1; @endphp
		<figure class="img item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="{{$data->discount_egp}}% {{trans('home.discount')}}">
	@else
		<figure class="img">
    @endif
@else
    @if($data->discount_usd > 0)
        @php $discountApplied = 1; @endphp
	    <figure class="img item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="{{$data->discount_usd}}% {{trans('home.discount')}}">
    @else
	    <figure class="img">s
    @endif
@endif

@php $includedCourses = $data->courseincludes; @endphp
    @if($includedCourses)
        <span class="course_number">{{ sizeof($includedCourses) }} {{trans('home.programs')}}</span>
                <a href="/courses/view/{{$data->slug}}">
                    <img src="{{ medium($data->image) }}" loading="lazy" class="{{ ($discountApplied) ? 'discount-applied' : '' }}" style="height: 300px; width: 100%;
                object-fit: cover;">
                </a>
    </figure>
    <div class="item_content bunch_item">
        <h5 class="item_content_title mbsm"  style="height: 66px;"><a href="/courses/view/{{$data->slug}}">{{$data->title_lang}}</a></h5>
        <p class="d-none">{{ charlimit($data->description_lang, 100) }}</p>
        <div class="course_card_detail card-content-height" style="bottom: -56px;">
            <div class="course_card_rating_price">
                <?php // if($fullRating){?>
                    <!--<div class="course_card_rating">-->
                    <!--<div class="jq_rating jq-stars" data-options='{"initialRating":<?php // echo round( $fullRating, 1 ); ?>, "readOnly":true, "starSize":15}'></div>-->
                    <!--<small class="text_muted">(<?php // echo round( $fullRating, 1 ); ?>)</small>-->
                    <!--</div>-->
                <?php // }?>
                <div class="d-flex justify-content-between">
                    <div class="course_card_price"> {!! $data->PriceText !!}</div>
                    <div class="course_card_price"> <i class="fas fa-eye"></i> <span>{{$data->visits}}</span> </div>
                </div>
            </div>
        </div>
        @if(0)
        <footer class="item_common_courses footer_included_courses">
            @foreach ($includedCourses as $includedCourse)
            <a class="common_course" href="/courses/view/{{$includedCourse->includedCourse->slug}}">
                @if($includedCourse->includedCourse->image)
                <figure class="img common_course_figure"><img src="{{ medium($includedCourse->includedCourse->image) }}" loading="lazy" style="height: 70px; width: 100%;"></figure>
                @endif
                <div class="common_course_div">
                    <h6 class="common_course_title">{{$includedCourse->includedCourse->title_lang}}</h6>
                    <!--<small>4 فيديوهات 10 ساعات</small>-->
                </div>
            </a>
            @endforeach
        </footer>
        @endif
    </div>
    @endif
</div>