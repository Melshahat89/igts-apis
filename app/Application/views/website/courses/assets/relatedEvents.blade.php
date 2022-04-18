<section class="global-cards">
    <h5 class="mb-20"><strong>{{ trans('courses.Related Events') }}</strong></h5>

    <div class="owl-carousel">
    @foreach($relatedEvents as $data)

    @php $eventStatus = getEventStatus($data); @endphp
    <div class="coming-soon-outter">
    <div class="card-item coming-soon-inner">

        <div class="card-img talks">
            <img class="w-100 img-fit" src="{{large1($data->image)}}" alt="{{ nl2br($data->title_lang) }}" style="width:100%;height:180px">
            <h4>{{ ($data->eventsdata->name)? nl2br($data->eventsdata->name_lang) :''  }}</h4>
        </div>
        <div class="card-content">
            <h6 class="card-title">
                <a href="/events/view/{{ $data->id }}">
                 
                    {{ \Illuminate\Support\Str::words($data->title_lang, 9, $end='...') }}
                </a>
            </h6>

            <div class="card-info m-2">
                <p style="height: 87px;">
                   
                
                    {{ strip_tags(\Illuminate\Support\Str::words($data->description_lang, 35, $end='...')) }}
                </p>
            </div>
            <div class="card-price flexBetween">
                <a href="/events/view/{{ $data->id }}" id="notify-{{ nl2br($data->id) }}" class="more_button">
                {{ trans('events.Details') }}
                </a>
                @if($eventStatus == "going")
                        <span class="free-badge" style="background: #bd951e"> {{ trans('courses.On-Going') }} </span>
                    @elseif($eventStatus == "passed")
                        <span class="free-badge" style="background: #d42828 !important"> {{ trans('courses.Ended') }} </span>
                    @elseif($eventStatus == "not started")
                        <span class="free-badge" style="background: #4db719"> {{ trans('courses.Upcoming') }} </span>
                    @endif
            </div>
        </div>
    </div>
</div>
    @endforeach
    </div>
            
</section>