<?php // $fullRating = ($data->reviewsCount) ? $data->reviewsSum / $data->reviewsCount : 0; ?>
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

        <a href="/courses/view/<?php echo $data->slug ?>">
            <span class="course_card_img">
            <img src="{{ medium($data->image) }}" loading="lazy" class="{{ ($discountApplied) ? 'discount-applied' : '' }}" style="height: 350px; width: 100%; object-fit: cover;">
            </span>
        </a>

			<div class="course_card_detail card-content-height">
				<div class="course_card_detail_name"><?php echo $data->title_lang; ?></div>
				<div class="course_card_rating_price">
					<div class="course_card_price">{!! $data->PriceText !!}</div>
				</div>
			</div>
		</a>
	</div>