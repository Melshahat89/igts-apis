@if ($eventsreviews)
    <section id="section-6">
        <h5 class="mb-20"><strong> {{ trans('courses.Reviews') }} </strong></h5>
                    <div class="comments-list">
                        @if ($eventsreviews)
                            @foreach ($eventsreviews as $eventreview) 
                                <!-- Review Item -->
                                <div class="comment-card mb-20">
                                    <div class="row">
                                        <div class="col-md-4 flexLeft">
                                                @if ($eventreview->user)
                                                    <img alt="" src="{{ large($eventreview->user->image) }}" width="50px">
                                                @endif
                                            <p class="ml-10">
                                                {{  date('d-m-Y', strtotime($eventreview->created_at)) }}
                                                <br>
                                                <a href="#">
                                                       {{  ($eventreview->user) ? $eventreview->user->fullname_lang : trans('website.Anonymous')   }}
                                                   
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-rating">
                                                
                                                @if ($eventreview->rating)
                                                    @for ($i = 1; $i <= round($eventreview->rating, 1); $i++) 
                                                        {!! " <i class='star-rating checked'></i> " !!} 
                                                    @endfor
                                                    @php
                                                        $notChecked = 5 - (int)$eventreview->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $notChecked; $i++)
                                                        {!!  " <i class='star-rating'></i> " !!}
                                                    @endfor
                                                @endif
                                            
                                            </div>
                                            <P>
                                                <?php echo $eventreview->review; ?>
                                            </P>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                
    </section>
@endif

@include('website.events.assets.reviewForm', ["id" => $model->id])


