@if ($relatedEvents)
    <section class="talk-course-content" id="related-talks">
        <h5 class="mb-20"><strong> {{ trans('eventsdata.Related Events') }} </strong></h5>
        <div class="owl-carousel">
            @foreach ($relatedEvents as $item)
                @if($item)
                    <div class="card-item">
                        <div class="card-img">
                            <a href="{{ url('/events/view/'.$item->id)}}">    
                                <i class="flaticon-play-button"></i>
                            </a>
                            <img class="w-100" title="{{ $item->title_lang }}" src="{{ large($item->image) }}">
                        </div>
                        <div class="card-content">
                            <h6 class="card-title">
                                <a href="{{ url('/events/view/'.$item->id)}}">  
                                    {{ $item->title_lang }}
                                </a>
                            </h6>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif