<div class="coming-soon-outter">
    <div class="card-item coming-soon-inner">

        <div class="card-img talks">
            <img class="w-100 img-fit" src="{{large($data->image)}}" alt="{{ nl2br($data->title_lang) }}" style="width:100%;height:180px">
            <h4>{{ ($data->instructor)? nl2br($data->instructor['fullname_lang']) :nl2br($data->title_lang)  }}</h4>
        </div>
        <div class="card-content">
            <h6 class="card-title">
                <a href="?utm_course name={{ nl2br($data->title_lang) }}" id="notify-{{ nl2br($data->id) }}" class="">
                 
                    {{ \Illuminate\Support\Str::words($data->title_lang, 9, $end='...') }}
                </a>
            </h6>

            <div class="card-info m-2">
                <p style="height: 87px;">
                   
                
                    {{ \Illuminate\Support\Str::words($data->description_lang, 35, $end='...') }}
                </p>
            </div>
            <div class="card-price flexBetween">
                <a href="?utm_course name={{ nl2br($data->title_lang) }}" id="notify-{{ nl2br($data->id) }}" class="more_button">
                {{ trans('courses.Notify Me') }}
                </a>
                <span class="free-badge" style="background-color: #e00000 !important;">
                    {{ trans('courses.Coming Soon') }}
                </span>
            </div>
        </div>
    </div>
</div>