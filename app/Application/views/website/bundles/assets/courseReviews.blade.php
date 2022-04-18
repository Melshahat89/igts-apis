@php
use App\Application\Model\Coursereviews;
@endphp


@if ($courseReviews)
    <section id="section-6">
        <h5 class="mb-20"><strong> {{ trans('courses.Reviews') }} </strong></h5>
                    <div class="comments-list">
                        @if ($courseReviews)
                            @foreach ($courseReviews as $courseReview) 
                                <!-- Review Item -->
                                <div class="comment-card mb-20">
                                    <div class="row">
                                        <div class="col-md-4 flexLeft">
                                            @if ($courseReview->type == Coursereviews::TYPE_DYNAMIC) 

                                                @if ($courseReview->user)
                                                    <img alt="" src="{{ large($courseReview->user->image) }}" width="50px">
                                                @endif

                                            @else
                                                @if ($courseReview->user) 
                                                    <img alt="" src="{{ large($courseReview->image) }}" width="50px">
                                                @else
                                                    <img alt="" src="{{ asset('public/meduo') }}/fav/apple-touch-icon.png" width="50px">
                                                @endif
                                            @endif
                                            <p class="ml-10">
                                                {{  date('d-m-Y', strtotime($courseReview->created_at)) }}
                                                <br>
                                                <a href="#">
                                                    @if ($courseReview->type == Coursereviews::TYPE_DYNAMIC) 
                                                        {{  ($courseReview->user) ? $courseReview->user->fullname_lang : trans('website.Anonymous')   }}
                                                    @else
                                                        {{  $courseReview->manual_name}}
                                                    @endif
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-rating">
                                                
                                                @if ($courseReview->rating)
                                                    @for ($i = 1; $i <= round($courseReview->rating, 1); $i++) 
                                                        {!! " <i class='star-rating checked'></i> " !!} 
                                                    @endfor
                                                    @php
                                                        $notChecked = 5 - (int)$courseReview->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $notChecked; $i++)
                                                        {!!  " <i class='star-rating'></i> " !!}
                                                    @endfor
                                                @endif
                                            
                                            </div>
                                            <P>
                                                <?php echo $courseReview->review; ?>
                                            </P>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    



    </section>
@endif

@include('website.courses.assets.reviewForm', ["id" => $course->id])


