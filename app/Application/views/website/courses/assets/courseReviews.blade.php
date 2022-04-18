@php
use App\Application\Model\Coursereviews;
@endphp


 
<div class="course_comments">

    @if ($courseReviews)
        @foreach ($courseReviews as $courseReview)
            
            <!-- Review Item -->
            <div class="individual_comment">
                <div class="comments_right">
                    <div>

                       
                        @if($courseReview->type == Coursereviews::TYPE_DYNAMIC)
                            @if($courseReview->user AND $courseReview->user->image)
                                <img src="{{ large1($courseReview->user->image) }}" style="width: 50px;">
                            @else
                                <img src="{{ asset('public/website') }}/images/user_avatar/placeholder.png" style="width: 50px;">
                            @endif
                        
                        @endif
                        
                    </div>
                    <div>
                        <small class="text_muted"><?php


echo date('d-m-Y', strtotime($courseReview->created_at)); ?></small>
                        <div><?php

                            if($courseReview->type == Coursereviews::TYPE_DYNAMIC) {
                                echo ($courseReview->user) ? $courseReview->user->name : trans('courses.visitor');
                            }else{
                                echo $courseReview->manual_name;
                            }


                            ?></div>
                    </div>
                </div>



                <div class="comments_left">
                    <div class="comments_raring">
                        <div class="jq_rating jq-stars" data-options='{"initialRating":<?php echo round($courseReview->rating); ?>, "readOnly":true, "starSize":16}'></div>
                    </div>
                    <div class="comment_body"><?php echo $courseReview->review; ?></div>
                </div>
            </div>

        @endforeach
    @endif
</div>


@if($enrolled)
    @include('website.courses.assets.reviewForm', ["id" => $courseId])
@endif