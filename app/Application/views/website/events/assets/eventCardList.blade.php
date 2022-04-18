<?php

    $eventStatus = getEventStatus($data);
    
?>


<a href="/courses/view/{{$data->slug}}" class="course_card_link">
    @if($data->image)
            <span class="course_card_img">
                <img src="{{large1($data->image)}}">
            </span>
    @endif
    <div class="course_card_detail">
        <div class="course_card_detail_name">{{$data->title_lang}}</div>

        <p><{{ strip_tags(charLimit($data->description_lang, 500)) }}</p>
        @if(isset($data->created_at))
            تاريخ النشر: {{ $data->created_at->format('Y-m-d') }}
        @endif
        <br>
        @if(isset($data->updated_at))
            تاريخ اخر تحديث: {{ $data->updated_at->format('Y-m-d') }}
        @endif
    </div>
    
    <div class="course_card_price">
        <h3 class="price text_primary">{!!$data->PriceText!!}</h3>
        @if($data->EventRating)
        <div class="course_card_rating">
            <div class="jq_rating jq-stars" data-options='{"initialRating":{{round( $data->EventRating, 1 )}}, "readOnly":true, "starSize":19}'></div> 
            <div class="text_muted">{{round($data->EventRating, 1 )}}</div>
        </div>
        <div class="text_muted"><small>(<span>{{$data->EventCountRating}}</span> تقييم)</small></div>
        @endif


        @if($eventStatus == "going")
            <div class="pt-4">
                <h5><span class="badge badge-secondary" style="background-color: #bd951e;">{{ trans('courses.On-Going') }}</h5>
            </div>
        @elseif($eventStatus == "passed")
            <div class="pt-4">
                <h5><span class="badge badge-secondary" style="background-color: #d42828;">{{ trans('courses.Ended') }}</h5>
            </div>
        @elseif($eventStatus == "not started")
            <div class="pt-4">
                <h5><span class="badge badge-secondary" style="background-color: #4db719;">{{ trans('courses.Upcoming') }}</h5>
            </div>
        @endif

    </div>
    
  
</a>  

<hr>

