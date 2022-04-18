@php 
use App\Application\Model\Courses;
@endphp

<div class="row">
    <div class="d-flex justify-content-around modal-lec-title pt-3">
        <a href="javascript:void(0)" onclick="loadModal('/courses/courseLecture/id/', {{$next}} )" class="prev-next"><i class="fas fa-arrow-right"></i></a>
        <p style="color: white;">{{ \Illuminate\Support\Str::words($lecture->title_lang, 4, $end='...') }}</p>
        <a href="javascript:void(0)" onclick="loadModal('/courses/courseLecture/id/', {{$previous}} )" class="prev-next"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>
<div class="pt-4">
    <div class="">
        <div class="">

            <div class="vd_lesson">

                <div class="vd_content">
                    <header class="vd_video_qtn_head">
                        <a href="/">
                            <?php /*<img src="img/avatars/avatar_2.jpg" class="rounded" width="50" alt="">*/?>
                            <div class="inblock mrsm">
                                <span class="mbxs"><?php /*Ahmed Mukhtar*/?></span>
                                <div class="text_muted"><?php /* <span>15</span> كورس - <span>26</span> كبملت مُصورة */?></div>
                            </div>
                        </a>
                        <?php /*<button type="button" class="button button_link button_sm button_shadow text_underline">حمّل الملحقات</button>*/?>
                    </header>
                    <div class="vd_video_qtn_body">



                        <div class="accordion accordion_list vd_question_list ptxs pbxs prxs plxs" id="questions_container">
                            <!-- 1 -->


                            @if(count($lecture->lecturequestions) > 0)
                                <span class="card_header_title">
                                         {{trans('courses.lecture questions')}}
                                        </span>
                                <!-- Question Card-->
                                @foreach($lecture->lecturequestions as $question )
                                    <div class="card">
                                        <div class="card_header">
                                            <button data-toggle="collapse" data-target="#answer_<?=$question->id ?>" aria-expanded="true" aria-controls="answer_<?=$question->id ?>">
										<span class="card_header_title">
                                           <?= $question->question_title ?>
                                        </span>
                                            </button>
                                        </div>
                                        <div id="answer_<?=$question->id ?>" class="collapse">
                                            <div class="card_body">
                                                <div class="question_meta">
                                                    <div>
                                                        <small class="text_muted">{{trans('courses.by')}}
                                                            <a href="" class="text_underline">
                                                                <?php echo ($question->user) ? $question->user->name : 'زائر' ?>
                                                            </a>
                                                        </small>
                                                    </div>
                                                    <small class="text_muted"><?php echo date('d-m-Y', strtotime($question->created_at)); ?></small>

                                                </div>
                                                @if($question->lecturequestionsanswers)
                                                    <!--Answer Card-->
                                                    @foreach($question->lecturequestionsanswers as $answer )
                                                        <div class="question_answer_single">
                                                            <div>
                                                                <span class="time"><?php echo date('d-m-Y', strtotime($answer->created_at)); ?></span>
                                                                
                                                                @if($answer->user)
                                                                    @if($answer->user->image)
                                                                        <img src="{{ large1($answer->user->image) }}" style="width: 50px;">
                                                                    
                                                                    @else
                                                                        <img src="{{ asset('public/website') }}/images/user_avatar/placeholder.png" style="width: 50px;">
                                                                    @endif

                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div><a href="#">
                                                                        {{ ($answer->user) ? charLimit($answer->user->name, 12) : trans('courses.visitor')}}
                                                                    </a></div>
                                                                <div>
                                                                    {{ ($answer->answer) }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                @endif
                                            </div>

                                            <!-- Add answer form  -->

                                            @include('website.courses.assets.addAnswerForm', ['questionId' => $question->id, 'enrolled' => $enrolled, 'instructor_id' => $lecture->courses->instructor_id]) 

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center questions-placeholder">
                                    <img src="{{ asset('public/website') }}/images/questions-placeholder.png" style="height: 70%; width: 100%; object-fit: cover;">                                                               
                                    <p>{{ trans('courses.Best the first and type in your question in the box below') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <footer class="vd_video_qtn_foot">

                       <!-- Add question form -->

                       @include('website.courses.assets.addQuestionForm', ['lectureId' => $lecture->id, 'enrolled' => $enrolled]) 

                    </footer>
                </div>
            
                
                <div class="vd_video">
                    

                     <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">
                    
                            <?php if($lecture->vdocipher_id) { ?>

                                <?php   $response =  Courses::getVdoCipherOTP($lecture->vdocipher_id);  ?>

                                <iframe src="https://player.vdocipher.com/playerAssets/1.x/vdo/embed/index.html#otp=<?= $response->otp ?>&playbackInfo=<?= $response->playbackInfo ?>" style="width:100%;height:100%;border:none;max-width: 100%;position: absolute; right: 0px;" allowFullScreen="true" allow="encrypted-media"></iframe>


                            <?php }else { ?>

                                <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://player.vimeo.com/video/<?php echo $lecture->video_file; ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>


                            <?php } ?>
                    
                        </div>


                </div>

            </div>
        </div>
    </div>
