<?php $fullRating = ($data->reviewsCount) ? $data->reviewsSum / $data->reviewsCount : 0; ?>
@include('website.theme.bootstrap.layout.igts.shared.discount-strip')
    <div class="item_content">
        <h5 class="item_content_title mbsm"><a href="/courses/view/<?php echo $data->slug ?>">{{ charlimit($data->title_lang, 35) }}</a></h5>
        <p>{{ \Illuminate\Support\Str::words($data->description_lang, 10, $end='...') }}</p>
        <footer class="item_content_footer">
            <?php if ($fullRating) { ?>
                <div class="item_content_rating">
                    <div class="jq_rating jq-stars" data-options='{"initialRating":<?php echo round($fullRating, 1); ?>, "readOnly":true, "starSize":18}'></div>
                </div>
            <?php } ?>
            <div class="item_content_price"><?php // echo $data->getCurrency();?> {!! $data->PriceText; !!}</div>
        </footer>
    </div>
</div>