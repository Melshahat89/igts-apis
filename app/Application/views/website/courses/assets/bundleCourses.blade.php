
<div class="col-md-6 mb-4">
    <div class="coming-soon-outter">
        <div class="card-item coming-soon-inner">
            <div class="card-img talks">
                <img class="w-100" alt="" style="height: 300px;
                object-fit: cover" src="https://meduo.net/public/uploads/files/{{$course->image}}">

                <h4>{{ $course->instructor->Fullname_lang }}</h4>
            </div>
            <div class="card-content">
                <h6 class="card-title">
                    <a href="{{$course->slug}}" id="">
                    
                        {{$course->title_lang}}
                    </a>
                </h6>
                <div class="card-info" style="margin: 10px;">
                    <p style="height: 80px;">
                

                        {{ str_limit($course->description_lang, $limit = 220, $end = '...') }}

                    </p>
                </div>
                <div class="card-price flexBetween">
                    <a href="{{$course->slug}}" id="" class="more_button">{{ trans('courses.View Course') }}</a>
                    <span class="free-badge" style="background-color: #1f8ebb !important;">{{ trans('courses.Bundle Course') }}</span>
                </div>
            </div>
        </div>
</div>
</div>
