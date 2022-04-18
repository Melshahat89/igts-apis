@php $discountApplied = 0; @endphp
@if(userCountry()['code'] == "EG")
	@if($data->discount_egp > 0)
		@php $discountApplied = 1; @endphp
		<div class="course_card item promoted-course" style="min-width: 100%;--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="<?php echo $data->discount_egp ?>% {{trans('home.discount')}}">
	@else
		<div class="course_card" style="min-width: 100%;">
    @endif

@else
	@if($data->discount_usd > 0)
		@php $discountApplied = 1; @endphp
        <div class="course_card item promoted-course" style="min-width: 100%;--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="<?php echo $data->discount_usd ?>% {{trans('home.discount')}}">
    @else
        <div class="course_card" style="min-width: 100%;">

    @endif
@endif		<a href="/courses/view/<?php echo $data->slug?>">
			<span class="course_card_img">
			<img src="{{ medium($data->image) }}" loading="lazy" class="{{ ($discountApplied) ? 'discount-applied' : '' }}" style="height: 200px; width: 100%; object-fit: cover;">
				<div class="play_icon"><i class="fas fa-play"></i></div>
			</span>
			
			<div class="course_card_detail card-content-height">
				<div class="course_card_detail_name" style="direction: {{getDir()}}">{{ \Illuminate\Support\Str::words($data->title_lang, 4, $end='...') }}</div>
				<div class="course_card_rating_price" style="direction: {{  getDir() == 'rtl' ? 'ltr' : 'rtl'}}">
				
					<div class="course_card_price"> {!! $data->PriceText !!}</div>
					<div class="course_card_price home-bestlearning-visits"> <i class="fas fa-eye"></i> <span>{{$data->visits}}</span> </div>
					<div class="course_card_rating home-bestlearning-rating">
						<div class="jq_rating jq-stars" data-options='{"initialRating":<?php  echo '5'; ?>, "readOnly":true, "starSize":15}'></div>
						<small class="text_muted">(<?php  echo '5'; ?>)</small>
					</div>
				</div>
				
			</div>
		</a>
	</div>