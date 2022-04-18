@if ($relatedTalks)
@if(count($relatedTalks) > 0)
    <section class="talk-course-content" id="related-talks">
        <h5 class="mb-20"><strong> {{ trans('courses.Related talks') }} </strong></h5>
        <div class="owl-carousel">
            @foreach ($relatedTalks as $item)
                @php
                    $talk = $item->relatedTalk;
                @endphp
                @if($talk)
                    <div class="card-item">
                        <div class="card-img">
                            <a href="{{ url('/talks/view/'.$talk->slug)}}">    
                                <i class="flaticon-play-button"></i>
                            </a>
                            <img class="w-100" title="{{ $talk->title_lang }}" src="{{ large($talk->image) }}">
                        </div>
                        <div class="card-content">
                            <h6 class="card-title">
                                <a href="{{ url('/talks/view/'.$talk->slug)}}">  
                                    {{ $talk->title_lang }}
                                </a>
                            </h6>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif
@endif