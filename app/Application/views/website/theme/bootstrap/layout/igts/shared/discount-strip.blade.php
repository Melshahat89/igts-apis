@php $discountApplied = 0; @endphp
<div class="coursecard">
    @if(userCountry()['code'] == "EG") 
        @if($data->discount_egp > 0)
            @php $discountApplied = 1; @endphp
            <figure class="img item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="<?php echo $data->discount_egp ?>% {{trans('home.discount')}}">
        @else
            <figure class="img">

        @endif
    @else
        @if($data->discount_usd > 0)
            @php $discountApplied = 1; @endphp
            <figure class="img item promoted-course" style="--colorcode: {{isset($data->categories->color_code) ? $data->categories->color_code : '#18B289'}}" data-awards="<?php echo $data->discount_usd ?>% {{trans('home.discount')}}">
        @else
            <figure class="img">

        @endif
    @endif

                <a href="/courses/view/{{$data->slug}}">
                    <img src="{{ medium($data->image) }}" loading="lazy" class="course-card-image {{ ($discountApplied) ? 'discount-applied' : '' }}">
                </a>
 

            </figure>