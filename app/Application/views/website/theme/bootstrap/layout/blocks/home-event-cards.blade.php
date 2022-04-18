<div class="row">
    @foreach($Data as $item)
        <div class="col-lg-3 col-md-4 pb-30">
            <div class="card-item" >
                <div class="card-img talks">
                    {{-- <i class="flaticon-fav" ></i> --}}
                    <img class="w-100" style="width:100%;height:180px" src="{{large1($item->image)}}" alt="{{ nl2br($item->title_lang) }}" >
                    <h4>{{ nl2br($item->instructor['fullname_lang']) }}</h4>
                </div>
                <div class="card-content">
                    <h6 class="card-title">
                     <a href="{{url('events/view/'.$item->id)}}">  {{ nl2br($item->title_lang) }}</a>
                    </h6>
                    <div class="card-rating">
                         {!! $item->Rating !!}
                    </div>
                    <div class="card-price flexBetween">
                        <a href="{{url('events/view/'.$item->id)}}" class="more_button">{{trans('website.Watch Now')}}</a>
                        @if($item->is_free == 1)
                            <span class="free-badge">{{trans('website.Free')}}</span>
                        @else
                            {!! $item->PriceText !!}
                        @endif

                        
                    </div>
                </div>


            </div>
        </div>
    @endforeach
</div>