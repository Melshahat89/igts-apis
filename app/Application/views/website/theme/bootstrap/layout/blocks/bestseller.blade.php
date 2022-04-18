<div class="owl-carousel">
    @foreach($Data as $item)
        <div class="latest-item">
            <div class="row">
                <div class="col-md-4">
                    <img style="   height: 230px" src="{{large($item['image'])}}" alt="{{ nl2br($item->title_lang) }}" />
                </div>
                <div class="col-md-8">
                    <span class="badge mb-10">{{trans('website.Trending')}}</span>
                    <h4>
                        <a href="{{url('courses/view/'.$item->slug)}}" class="">
                        {{ nl2br($item->title_lang) }}
                        </a>
                     </h4>
                    <p>
                    
                        {{ \Illuminate\Support\Str::words($item->description_lang, 35, $end='...') }}
                     </p>
                    <a href="{{url('courses/view/'.$item->slug)}}" class="more_button float-right">
                        {{trans('website.View More')}}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
