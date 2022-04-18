<div class="d-flex justify-content-center">
    @php $discountApplied = 0; @endphp
    @if(userCountry()['code'] == "EG")
        @if($data->discount_egp > 0)
            @php $discountApplied = 1; @endphp
            <div class="course_card item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="{{$data->discount_egp}}% {{trans('home.discount')}}">
        @else
            <div class="course_card">
        @endif

    @else

        @if($data->discount_usd > 0)
            @php $discountApplied = 1; @endphp
            <div class="course_card item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="{{$data->discount_usd}}% {{trans('home.discount')}}">
        @else	
            <div class="course_card">

        @endif
    @endif
        <a href="/courses/view/<?php echo $data->slug?>">
            <span class="course_card_img">
                <img src="{{ medium($data->image) }}" loading="lazy" class="{{ ($discountApplied) ? 'discount-applied' : '' }}" style="height: 200px; object-fit: cover;">
                <div class="play_icon"><i class="fas fa-play"></i></div>
            </span>
            <div class="course_card_detail" style="height:118px;"> 
                <div class="course_card_detail_name" title="<?php echo $data->title_lang; ?>"><?php echo charlimit($data->title_lang, 40) ?></div>
                <div class="course_card_rating_price">
                    <div class="course_card_rating">
                        <div class="jq_rating jq-stars" data-options='{"initialRating":<?php echo round( $data->CourseRating, 1 ); ?>, "readOnly":true, "starSize":15}'></div>
                        <small class="text_muted">(<?php echo round( $data->CourseRating, 1 ); ?>)</small>
                    </div>
                    <div class="course_card_price"><?php // echo $data->getCurrency();?> <?php echo $data->PriceText;  ?></div>
                </div>
            </div>
        </a>
    </div> 
</div>
