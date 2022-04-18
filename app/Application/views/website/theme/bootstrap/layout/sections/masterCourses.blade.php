<?php $fullRating = ($data->reviewsCount) ? $data->reviewsSum / $data->reviewsCount : 0; ?>
@include('website.theme.bootstrap.layout.igts.shared.discount-strip')
    <div class="item_content bunch_item bunch_item_dark_bg course-details-container">
        <h5 class="item_content_title mbsm course-title-container"><a class="course_card_detail_name course-title" href="/courses/view/<?php echo $data->slug ?>">{{ \Illuminate\Support\Str::words($data->title_lang, 5, $end='...') }}
</a></h5>
        <p class="d-none">{{ strip_tags(\Illuminate\Support\Str::words($data->description_lang, 8, $end='...')) }}</p>
        <div class="course_card_detail card-content-height" style="bottom: -56px;">
            <div class="course_card_rating_price">
                <?php // if($fullRating){?>
                    <!--<div class="course_card_rating">-->
                    <!--<div class="jq_rating jq-stars" data-options='{"initialRating":<?php // echo round( $fullRating, 1 ); ?>, "readOnly":true, "starSize":15}'></div>-->
                    <!--<small class="text_muted">(<?php // echo round( $fullRating, 1 ); ?>)</small>-->
                    <!--</div>-->
                <?php // }?>
                <div class="d-flex justify-content-between text-center">
                    <div class="course_card_price"> {!! $data->PriceText !!}</div>
                    <div class="course_card_price"> <i class="fas fa-eye"></i> <span>{{$data->visits}}</span> </div>
                </div>
            </div>
        </div>
    </div>
</div>