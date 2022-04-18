@if ($talkReviews)
    <section id="section-6">
        <h5 class="mb-20"><strong> {{ trans('courses.Reviews') }} </strong></h5>
                    <div class="comments-list">
                        @if ($talkReviews)
                            @foreach ($talkReviews as $talkReview) 
                                <!-- Review Item -->
                                <div class="comment-card mb-20">
                                    <div class="row">
                                        <div class="col-md-4 flexLeft">
                                                @if ($talkReview->user)
                                                    <img alt="" src="{{ large($talkReview->user->image) }}" width="50px">
                                                @endif
                                            <p class="ml-10">
                                                {{  date('d-m-Y', strtotime($talkReview->created_at)) }}
                                                <br>
                                                <a href="#">
                                                       {{  ($talkReview->user) ? $talkReview->user->fullname_lang : trans('website.Anonymous')   }}
                                                   
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-rating">
                                                
                                                @if ($talkReview->rating)
                                                    @for ($i = 1; $i <= round($talkReview->rating, 1); $i++) 
                                                        {!! " <i class='star-rating checked'></i> " !!} 
                                                    @endfor
                                                    @php
                                                        $notChecked = 5 - (int)$talkReview->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $notChecked; $i++)
                                                        {!!  " <i class='star-rating'></i> " !!}
                                                    @endfor
                                                @endif
                                            
                                            </div>
                                            <P>
                                                <?php echo $talkReview->review; ?>
                                            </P>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                
    </section>
@endif

@include('website.talks.assets.reviewForm', ["id" => $model->id])


