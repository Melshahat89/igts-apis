@php
use App\Application\Model\Courses;
$webinarDate = new DateTime($data->start_date);


$currentDate = new DateTime("now", new DateTimeZone('Egypt'));
$currentDate = $currentDate->format('Y-m-d h:i a');

$webinarDate = new DateTime($data->start_date);
$webinarDate = $webinarDate->format('Y-m-d h:i a');

$endDate = null;
if($data->webinar_duration){
$endDate = new DateTime($data->start_date);
$endDate->add(new DateInterval('PT' . $data->webinar_duration . 'H'));
$endDate = $endDate->format('Y-m-d h:i a');

}

$passed;
$going = false;
if($currentDate > $webinarDate){

    if($currentDate < $endDate){

        $going = true;

    }else{

        $passed = true;
    }

    

}else{

    $passed = false;
}
@endphp


<a href="/courses/view/{{$data->slug}}" class="course_card_link">
            <span class="course_card_img">
                <img src="{{large1($data->image)}}">
            </span>
    <div class="course_card_detail">
        <div class="course_card_detail_name text_primary">{{$data->title_lang}}</div>

        <p>{{ strip_tags(charLimit($data->description_lang, 500)) }}</p>
        @if(isset($data->created_at))
            {{trans('courses.created at')}} {{ $data->created_at->format('Y-m-d') }}
        @endif
        <br>
        @if(isset($data->updated_at))
            {{trans('courses.updated at')}} {{ $data->updated_at->format('Y-m-d') }}
        @endif
        <div class="course_card_price"> <i class="fas fa-eye"></i> <span>{{$data->visits}}</span> </div>
    </div>
    
    <div class="course_card_price" style="    justify-content: space-between;">
        @if($data->type != Courses::TYPE_WEBINAR)
        <h3 class="price text_primary">{!!$data->PriceText!!}</h3>
        @endif

        @if($data->CourseRating)
        <div class="course_card_rating">
            <div class="jq_rating jq-stars" data-options='{"initialRating":{{round( $data->CourseRating, 1 )}}, "readOnly":true, "starSize":19}'></div> 
            <div class="text_muted">{{round($data->CourseRating, 1 )}}</div>
        </div>
        <div class="text_muted"><small>(<span>{{$data->CourseCountRating}}</span> تقييم)</small></div>
        @endif


        @if($data->type == Courses::TYPE_WEBINAR)

            @if($going)

                <div class="pt-4">
                    <h5><span class="badge badge-secondary" style="background-color: #d2982e;">جارية</h5>
                </div>

            @elseif($passed)

                <div class="pt-4">
                    <h5><span class="badge badge-secondary" style="background-color: #18B289;">انتهت</h5>
                </div>

            @else

                <div class="pt-4">
                    <h5><span class="badge badge-secondary" style="background-color: #17a242;">قادمة</h5>
                </div>

            @endif

        @else

            @if(getCurrency() == "EGP")

	            @if($data->discount_egp > 0)

                    <div class="pt-4">
                        <h5><span class="badge badge-secondary" style="background-color: #18B289;"><?php echo $data->discount_egp ?>% {{trans('home.discount')}}</span></h5>
                    </div>

                @endif

            @else

                @if($data->discount_usd > 0) 

                    <div class="pt-4">
                        <h5><span class="badge badge-secondary" style="background-color: #18B289;"><?php echo $data->discount_usd ?>% {{trans('home.discount')}}</span></h5>
                    </div>

                @endif


            @endif

        @endif




    </div>
    
  
</a>  

<hr>