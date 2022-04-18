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
    use App\Application\Model\Talks;
@endphp

<div class="bread-crumb">
    <div class="container">
        <a href="{{ url('/talks/category') }}"> {{ trans('website.talks') }} </a> > 
        <span> {{ $model->title_lang }} </span>
    </div>
</div>

<section class="talks-content">
    <div class="container">
        @if($model->video_file)
            <div class="talk_video_wrapper">
                <!-- video-js -->
                <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">
                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://player.vimeo.com/video/<?php echo $model->video_file; ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay"></iframe>
                </div>
                <!-- end video -->

            </div>
        @endif

        <div class="col-md-12 d-flex p-0">
            <div class="col-md-6 mt-3">
                <a id="status-1" onclick="ajaxLike(1)" href="javascript: void(0)" style="width: 100%; height: 50px;" type="button" class="btn btn-success {{(isset ($model->UserTalklike)) ? (($model->UserTalklike['status'] == 1) ? 'isDisabled':'') : ''}} " disabled aria-disabled="true">
                <i class="fas fa-thumbs-up mt-2" style="color: white;">  {{$model->TalkCountLike}} </i>
                
            {{-- <i class="fas fa-sign-language"></i> --}}
            </a>

            </div>
            <div class="col-md-6 mt-3">
                <a id="status-0" onclick="ajaxLike(0)" href="javascript: void(0)" style="width: 100%; height: 50px;" type="button" class="btn btn-info {{(isset ($model->UserTalklike)) ? (($model->UserTalklike['status'] == 0) ? 'isDisabled':'') : ''}}">
                <i class="fas  mt-2" style="color: white;"><img style="height: 25px;" src="{{ asset('public/meduo') }}/images/clapping.png"> {{$model->TalkCountDislike}} </i>
                
                </a>
        
            </div>
        </div>


        <div class="instructor-talks">
                    <div class="instructor-area mt-20">
                        <div class="row">
                            <div class="col-md-2 col-3">
                                <a href=" {{ url('/instructors/view/'.$model->instructor->slug) }}">
                                    <img class="w-100"  width="60" src="{{ large1($model->instructor->image) }}">
                                </a>

                            </div>
                            <div class="col-md-5 col-9">
                                <a href="{{ url('/instructors/view/'.$model->instructor->slug) }}"><h4>{{ $model->instructor->fullname_lang }}</h4></a>
                                <p>{{ $model->instructor->title_lang }}</p>
                                <div class="card-rating white-color" style="width: 190px !important;">
                                    {!! $model->Rating !!}
                                </div>
                                <div class="card-rating white-color"  style="width: 190px !important;">
                                    {{ $model->visits }}  {{ trans('courses.Views') }}
                                </div>
                            </div>

                            <div class="col-md-5 col-12">
                                <div class="share-course flexBetween">
                                    <p>{{ trans('courses.Share') }}</p>
                                    <div class="social sign-ico flexCenter">
                                    {{--    <a href="#"  onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u={{ Request::url() }}');return false;" class="ace-color"><i class="facebook"></i></a>    --}}
                                    {{--    <a href="#" onclick="javascript:genericSocialShare('http://twitter.com/share?text={{$model->title_lang}}&url={{ Request::url() }}');return false;" class="twitt-color"><i class="twitter"></i></a> --}}
                                    {{--    <a href="#" onclick="javascript:genericSocialShare('https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}&title={{$model->title_lang}}&summary=&source=MEDUO');return false;" class="in-color"><i class="linkedin"></i></a> --}}
                                     <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


        <Section class="talk-course-content">
            <h5><strong>{{ $model->description_lang }}</strong></h5>
        </Section>

        {{--  //_relatedTalks  --}}
        @include('website.talks.assets.relatedTalks', ['relatedTalks'=>$relatedTalks])
        {{--  //_relatedCourses  --}}
        @include('website.talks.assets.relatedCourses', ['relatedCourses'=>$relatedCourses , 'course_id',$model->id])


        <section class="students-rate talk-course-content">
            <h5 class="mb-20"><strong>
            {{ trans('courses.Students Feedback') }}</strong></h5>

            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <h1><?php echo $fullRating = ($model->TalkCountRating) ? round($model->TalkSumRating / $model->TalkCountRating, 1) : 0;
                        
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



                        <span>{{ trans('courses.Talk Rating') }}</span>
                    </div>
                    <div class="col-md-9">
                        <?php
                        $ratingDetailsArr = $model->TalkRatingDetails;
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

                <!-- Reviews -->
                  @include('website.talks.assets.talkReviews', ['talkReviews'=>$model->talksreviews, "talkId" => $model->id])
                
    </div>
</section>

@endsection

@push('js')

<script>

function ajaxLike(status){
    $.ajax({

        url: "/talks/likeAjax/{{$model->id}}/" + status,
        type: "GET",

        success: function(data){

            
            if(status == 1){
                $('#status-1').addClass('isDisabled');
                $('#status-0').removeClass('isDisabled');
            }else{
                $('#status-1').removeClass('isDisabled');
                $('#status-0').addClass('isDisabled');
            }

            $('#status-1').html('<i class="fas fa-thumbs-up mt-2" style="color: white;">' + data.talkLikes1 + '</i>');
            $('#status-0').html('<i class="fas  mt-2" style="color: white;"><img style="height: 25px;" src="{{ asset('public/meduo') }}/images/clapping.png">' + data.talkLikes0 +  '</i>');

        },

        error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }

    });
}

</script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5eaf37774ba4f9001384cb34&product=inline-share-buttons' async='async'></script>

@endpush

