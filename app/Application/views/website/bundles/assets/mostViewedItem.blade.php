<div>
    <div class="flip-box">
        <div class="flip-box-inner">
            <div class="flip-box-front card-item">
                <div class="card-img">
                    <i class="flaticon-fav {{CourseWishlisted($data->id)?'checked':''}}" ></i>
                    <img class="w-100 img-fit" src="{{large($data->image)}}" alt="{{ nl2br($data->title_lang) }}" style="width:100%;height:180px">
                    <h4>{{ nl2br($data->instructor['fullname_lang']) }}</h4>
                </div>
                <div class="card-content">
                    <h6 class="card-title">
                      
                        {{ \Illuminate\Support\Str::words($data->title_lang, 9, $end='...') }}
                    </h6>
                    <div class="card-rating">
                        {!! $data->Rating !!}
                    </div>
                    <div class="card-price flexBetween">
                        {!! $data->PriceText !!}
                    </div>
                </div>


            </div>
            <div class="flip-box-back card-item  p-10">
                <p class="card-date"> {{trans('website.Last updated')}}: {{$data->created_at }}</p>

                <h6>
                    <a href="{{url('/courses/view/'.$data->slug)}}" >
                        {{ \Illuminate\Support\Str::words($data->title_lang, 9, $end='...') }}
                    </a>
                </h6>

                <div class="badges flexLeft">
                    {{trans('website.in')}}
                            <a href="{{url('courses/category?category='.$data->categories->slug)}}">
                                {{ nl2br($data->categories->name_lang) }}
                            </a>
                </div>

                <div class="card-data flexBetween">
                    <span><i class="flaticon-play-button" ></i><?= count($data->courselectures); ?> {{ trans('courses.lectures') }} </span>
                    <span><i class="flaticon-clock"></i> <?= round($data->length / 60); ?> {{ trans('website.hours') }}</span>
                </div>


                <div class="card-info">
                   <p> 

                
                    {{ \Illuminate\Support\Str::words($data->description_lang, 35, $end='...') }}

                   </p>
                </div>

                <div class="action-btns flexBetween">
                    <a href="{{url('/courses/view/'.$data->slug)}}" class="add-to-cart">
                        {{trans('website.More Details')}}
                    </a>
                    @if(Auth::check())
                        <a href="{{url('/courses/toggleFavourite/id/'.$data->id)}}">
                            <i class="flaticon-fav {{CourseWishlisted($data->id)?'checked':''}} " ></i>
                        </a>
                    @else
                        <a href="/login" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" >
                            <i class="flaticon-fav" ></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>