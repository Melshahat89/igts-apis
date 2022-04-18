<div>
    <div class="card-item" >

        <div class="card-img talks">
            <img class="w-100" src="{{large($data->image)}}" style="width:100%;height:180px"  alt="{{ nl2br($data->title_lang) }}" >
                    <h4>{{ nl2br($data->instructor['fullname_lang']) }}</h4>
        </div>
        <div class="card-content">
            <h6 class="card-title">
                <a href="{{url('talks/view/'.$data->slug)}}">  {{ nl2br($data->title_lang) }}</a>

            </h6>
            <div class="card-rating">
                {!! $data->Rating !!}
            </div>
            <div class="card-price flexBetween">
                <a href="{{url('talks/view/'.$data->slug)}}" class="more_button">{{trans('website.Watch Now')}}</a>
                <span class="free-badge">{{trans('website.Free')}}</span>
            </div>
        </div>


    </div>
</div>
