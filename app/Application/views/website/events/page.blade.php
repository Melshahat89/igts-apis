@extends(layoutExtend('website'))
@section('title')
   {{ $model->title_lang }} - Meduo.net
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
@php
    use App\Application\Model\Events;
@endphp
<?php $eventStatus = getEventStatus($model); ?>
<div class="bread-crumb">
    <div class="container">
        <a href="{{ url('/events/category') }}"> {{ trans('website.events Menu') }} </a> > 
        <span> {{ $model->title_lang }} </span>
    </div>
</div>

<section class="talks-content">
    <div class="container">
        @if($model->type == Events::TYPE_LIVE)
            <div class="talk_video_wrapper">
                <div class="flowplayer-embed-container" style="position: relative; overflow: hidden; max-width:100%;">
                    <!-- {!! $model->live_link !!} -->

                    <img src="{{ large1($model->image) }}" class="w-100">
                </div>
            </div>
        @elseif($model->type == Events::TYPE_RECORDED)
            <div class="talk_video_wrapper">
                <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">
                    {!! $model->recorded_link !!}
                </div>
            </div>
        @elseif($model->type == Events::TYPE_OFFLINE)
            <div class="talk_video_wrapper">
                <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">
                    {!! $model->location !!}
                </div>
            </div>
        @endif

        @if(!$enrolled)

            @if($model->is_free)
                <div class="card-price flexCenter">
                    <a href="javascript:void(0)" class="view-more-section course-action-btns w-100 text-center mb-10 add_cart"> 
                        <span class="">
                            
                        {{ trans('events.is_free') }}
                            
                        </span>
                    </a>
                </div>
            @else
                <div class="card-price flexCenter">
                    <a href="javascript:void(0)" class="view-more-section course-action-btns w-100 text-center mb-10 add_cart"> 
                        <span class="">
                            
                        {{ number_format($model->originalPrice) }} {{ getCurrency() }}
                            
                        </span>
                    </a>
                </div>
            @endif

        @endif



        @if (!$shoppingCart && !$enrolled)
            @if($eventStatus == "passed")

                <a class="view-more-section course-action-btns w-100 text-center mb-4 mt-4 add_cart"
                    href="javascript: void(0)"
                    style="background: #c5302b !important;"
                    >
                    {{ trans('courses.Ended') }}
                </a>

            @elseif($eventStatus == "going")

                <a class="view-more-section course-action-btns w-100 text-center mb-4 mt-4 add_cart"
                    href="javascript: void(0)"
                    style="background: #bd951e !important;"
                    >
                    {{ trans('courses.On-Going') }}
                </a>

            @else
                @if (Auth::check())

                    @if($model->is_free == 0)
                        <a class="view-more-section course-action-btns w-100 text-center mb-10 add_cart"
                        href="{{ url('/events/addEventToCart/' . $model->id) }}">
                        {{ trans('courses.Add to cart') }}
                        </a>
                    @else
                        <a class="view-more-section course-action-btns w-100 text-center mb-4 mt-4 add_cart" data-toggle="modal" data-target="#exampleModal"
                        href="#">
                        {{ trans('courses.Register in Zoom') }}
                        </a>
                    @endif

                @else
                    <a class="view-more-section course-action-btns w-100 text-center mb-4 mt-4" href="#"
                    data-dismiss="modal" data-remote="/login" data-toggle="modal"
                    data-target="#loginModal">
                        {{ trans('courses.Register in Zoom') }} 
                    </a>
                @endif

            @endif

            
        @elseif($enrolled) 
        
            @if($model->type == Events::TYPE_LIVE)

                @if($eventStatus == "passed")
                    <div class="card-price flexCenter">
                    <a href="/account/myCertificates" class="view-more-section course-action-btns w-100 text-center mb-10 add_cart" target="_blank"> 
                        <span class="">
                            
                                {{ trans('courses.View Certificate') }}
                            
                        </span>
                        </a>
                    </div>
                @else

                    <div class="card-price flexCenter">
                    <a href="{{$model->live_link}}" class="view-more-section course-action-btns w-100 text-center mb-10 add_cart" target="_blank"> 
                        <span class="">
                            
                                {{ trans('courses.View in Zoom') }}
                            
                        </span>
                        </a>
                    </div>

                @endif

            @endif


           
        @else
                <a class="view-more-section course-action-btns w-100 text-center mb-10 add_cart"
                    href="{{ url('/cart') }}">
                    {{ trans('courses.Go to cart') }}
                </a>
        @endif

        <div class="instructor-talks">
                    <div class="instructor-area mt-20">
                        <div class="row">
                            <div class="col-md-2 col-3">
                                <a href="">
                                    <img class="w-100"  width="60" src="{{ large1($model->eventsdata->logo) }}">
                                </a>

                            </div>
                            <div class="col-md-5 col-9">
                                <a href=""><h4>{{ $model->eventsdata->name_lang }}</h4></a>
                                <p>{{ $model->eventsdata->website }}</p>
                                <div class="card-rating white-color d-none" style="width: 190px !important;">
                                    {!! $model->Rating !!}
                                </div>
                                <div class="card-rating white-color"  style="width: 190px !important;">
                                    {{ $model->visits }}  {{ trans('courses.Views') }}
                                </div>
                                
                                
                            </div>

                            <div class="col-md-5 col-12">
                                <div class="share-course flexRight">
                                    <p>{{ trans('courses.Share') }}</p>
                                    <div class="social sign-ico flexCenter">
                                        <a href="#"  onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u={{ Request::url() }}');return false;" class="ace-color"><i class="facebook"></i></a>
                                        <a href="#" onclick="javascript:genericSocialShare('http://twitter.com/share?text={{$model->title_lang}}&url={{ Request::url() }}');return false;" class="twitt-color"><i class="twitter"></i></a>
                                        <a href="#" onclick="javascript:genericSocialShare('https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}&title={{$model->title_lang}}&summary=&source=MEDUO');return false;" class="in-color"><i class="linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


        <Section class="talk-course-content mb-4">
            <p class="card-date d-none">
                {{ trans('eventsdata.start_date') }} :  {{$model->start_date }}
            </p>
            <p class="card-date d-none">
                {{ trans('eventsdata.end_date') }} : {{$model->end_date}}
            </p>
            <h5>{!! $model->description_lang !!}</h5>
        </Section>

        <!-- {{--  //_relatedEvents  --}}
        @include('website.events.assets.relatedEvents', ['relatedEvents'=>$relatedEvents]) -->
        

        
        @if($model->TalkCountRating)
        <section class="students-rate talk-course-content">
            <h5 class="mb-20"><strong>
            {{ trans('courses.Students Feedback') }}</strong></h5>

            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <h1><?php echo $fullRating = ($model->EventCountRating) ? round($model->EventSumRating / $model->EventCountRating, 1) : 0;
                        
                        ?></h1>
                        <div class="card-rating">
                            <?php
                            $rate = '';
                            $fullRating = ($model->TalkCountRating) ? $model->TalkSumRating / $model->TalkCountRating : 0;
                            if($fullRating){
                                for($i=1 ;$i <= round( $fullRating, 1 );$i++){
                                    $rate.= " <i class='star-rating checked'></i> ";
                                }
                                $notChecked = 5 - (int)$fullRating;

                                for($i=1 ;$i <= $notChecked ;$i++){
                                    $rate.= " <i class='star-rating'></i> ";
                                }

                            }
                            echo $rate;
                            ?>
                        </div>



                        <span>{{ trans('eventsdata.Event Rating') }}</span>
                    </div>
                    <div class="col-md-9">
                        <?php
                        $ratingDetailsArr = $model->EventRatingDetails;
                        $ratingDetails = $ratingDetailsArr['ratingDetails'];
                        $ratingCount = $ratingDetailsArr['count'];
                        ?>
                        <?php if($ratingDetails){?>

                            <?php foreach ($ratingDetails as $ratingItem) {
                                $ratingPercent = round( (( $ratingItem->ratingCount / $ratingCount ) * 100), 1 ) ;
                                ?>
                                <div class="row mb-15">
                                    <div class="col-md-8">
                                        <div class="progress ">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $ratingPercent?>%" aria-valuenow="<?php echo $ratingPercent?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-rating">
                                            <?php
                                            if($ratingItem->rating){
                                                for($i=1 ;$i <= round( $ratingItem->rating, 1 );$i++){
                                                    echo " <i class='star-rating checked'></i> ";
                                                }
                                                $notChecked = 5 - (int)$ratingItem->rating;

                                                for($i=1 ;$i <= $notChecked ;$i++){
                                                    echo " <i class='star-rating'></i> ";
                                                }
                                            }
                                            ?>
                                            <span><?php echo $ratingPercent?>%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section>  

        @endif

                <!-- Reviews -->
                  @include('website.events.assets.eventReviews', ['eventsreviews'=>$model->eventsreviews, "eventId" => $model->id])
                
    </div>
</section>

@endsection


