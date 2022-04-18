<div class="row">
    @foreach($Data as $item)
        <div class="col-lg-3 col-md-4 pb-30">
            <div class="flip-box"> <?php getCurrency() ?>
                <div class="flip-box-inner">
                    <div class="flip-box-front card-item" >
                        @if(getCurrency() == "EGP")
                            @if($item->discount_egp > 0)
                            <div class="card-img item promoted" data-awards="{{ $item->discount_egp }}% {{trans('courses.discount')}}">
                            @else
                            <div class="card-img">
                            @endif
                        @else
                            @if($item->discount_usd > 0)
                            <div class="card-img item promoted" data-awards="{{ $item->discount_usd }}% {{trans('courses.discount')}}">
                            @else
                            <div class="card-img">
                            @endif
                        @endif
                        <!-- <div class="card-img"> -->
                            <!-- <i class="flaticon-fav {{CourseWishlisted($item->id)?'checked':''}}" ></i> -->
                            <img class="w-100 img-fit" src="{{large($item->image)}}" alt="{{ nl2br($item->title_lang) }}" style="width:100%;height:180px">
                            <h4>{{ nl2br($item->instructor['fullname_lang']) }}</h4>
                            
                        </div>
                        <div class="card-content">
                            <h6 class="card-title">
                             
                               
                                {{ \Illuminate\Support\Str::words($item->title_lang, 9, $end='...') }}
                            </h6>
                            <div class="card-rating">
                                {!! $item->Rating !!}
                            </div>
                            <div class="card-price flexBetween">
                                {!! $item->PriceText !!}
                            </div>
                        </div>
                    </div>
                    <div class="flip-box-back card-item  p-10">
                        @if($item->type == 6)
                            <p class="card-date"> {{trans('website.Started at')}}: {{$item->start_date }}</p>
                        @else
                            <p class="card-date"> {{trans('website.Last updated')}}: {{$item->created_at }}</p>
                        @endif
                        
                        <h6>
                            <a href="{{url('/courses/view/'.$item->slug)}}" >
                               
                                {{ \Illuminate\Support\Str::words($item->title_lang, 9, $end='...') }}
                            </a>
                        </h6>
                        <div class="badges flexLeft">
                            {{--                        <span class="best-seller-badge">Best Seller</span>--}}
                            {{trans('website.in')}}
                            <a href="{{url('courses/category?category='.$item->categories->slug)}}">
                                {{ nl2br($item->categories->name_lang) }}
                            </a>
                        </div>

                        <div class="card-data flexBetween">
                        @if($item->type == 4)
                        
                        <span><i class="flaticon-play-button" ></i><?= $item->getIncludedCoursesLecturesSum(); ?> {{ trans('courses.lectures') }} </span>
                        <span><i class="flaticon-clock"></i> <?= $item->getBundleHours() ?> {{ trans('website.hours') }}</span>

                        @else
                        <span><i class="flaticon-play-button" ></i><?= count($item->courselectures); ?> {{ trans('courses.lectures') }} </span>
                        <span><i class="flaticon-clock"></i> {{$item->getHoursLectures($item->length)}} {{ trans('website.hours') }}</span>

                        @endif

                        <?php $item->getBundleHours(); ?>


                        </div>

                        <div class="card-info">
                            <p>
                                {{ \Illuminate\Support\Str::words($item->description_lang, 35, $end='...') }}
                            
                            </p>
                        </div>
                        <div class="action-btns flexBetween">
                            <a href="{{url('/courses/view/'.$item->slug)}}" class="add-to-cart">
                                {{trans('website.More Details')}}
                            </a>
                            @if(Auth::check())
                                <!-- <a href="{{url('/courses/toggleFavourite/id/'.$item->id)}}"> -->
                                <a href="javascript: void(0)" onclick="toggleWishListAjax({{$item->id}})">

                                    <i class="flaticon-fav {{CourseWishlisted($item->id)?'checked':''}} " id="{{$item->id}}" ></i>
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
    @endforeach
</div>

@push('js')


<script>


function toggleWishListAjax(id) {

        $.ajax({
            url: "/courses/toggleFavouriteAjax/id/" + id,
            type: "GET",
          
            success: function(data) {


                var wishlist = data.wishlist;
                var course_id = data.course_id;


                if(wishlist == 1){

                    $('#' + id).addClass('checked');
                    
                }else{
                    $('#' + id).removeClass('checked');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    }


</script>
@endpush
