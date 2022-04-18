@php
use App\Application\Model\Courses;
@endphp

@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection

@push('css')
<style>
    /* Hidden class most be use for hide element is examwizerd, usally it's exsists by defualt in bootstrap' */
    .hidden {
        display: none!important;
    }

    /* Disabled class used for disable element is examwizerd, usally it's exsists by defualt in bootstrap' */
    .disabled {
        pointer-events: none;
        cursor: not-allowed;
        filter: alpha(opacity=65);
        -webkit-box-shadow: none;
        box-shadow: none;
        opacity: .2;
    }


    /* Temp Style Just For demo */
    body {
        padding-bottom: 60px;
    }


</style>
@endpush

@section('content')

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('website.Exams'), 'subTitle' => $model->title_lang]) 

<section class="questions">
    <div class="container">
        <?php
        $quizTimeInSeconds = $model->time * 60;
        $quizStartDate = (int) $studentExam->start_time;
        $quizRealEndDate = (int) ($quizStartDate + $quizTimeInSeconds);

        $formatedEndDate = date("Y-m-d H:i:s", $quizRealEndDate);
        ?>

        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("<?php echo $formatedEndDate; ?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get todays date and time
                var now = new Date().getTime();
                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("time").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    $(".form_submit").remove()
                    document.getElementById("time").innerHTML = "{{ trans('website.The Exam Finished') }}";
                }
            }, 1000);
        </script>
        <div class="timer-count">
            <div class="timer-content"> {{ trans('website.Remaining time') }}</a> <span id="time"></span></div>
        </div>

        <header class="quiz_progress_head">
            <div class="quiz_number"> {{ trans('website.Question') }}
                <span class="text_primary" id="current-question-number-label">1</span> 
                 
                 {{ trans('website.From') }}
                <span class="text_primary"><?php echo sizeof($model->quizquestions); ?></span>
            </div>
            <div class="quiz_timing">

                <!--/////////////////////////////-->
        <!--                <span class="text_danger">-->
        <!--                                <div class="countdown" id="countdown1">-->
        <!--                                    <i class="far fa-clock"></i> &nbsp;-->
        <!--                                    <span id="time"></span>-->
        <!--                                </div>-->
        <!---->
        <!--                            </span>-->
            </div>
        </header>

        <form id="examwizard-question" method="post" class="mtlg">
            {{ csrf_field() }}
            <input type="hidden" name="exam" value="<?php echo $model->id;?>"  />
            <?php $i = 1; ?>
            <?php foreach ($model->quizquestions as $question) { ?>
                <!--// Quetion with answers-->
                <div class="question <?php if ($i > 1) {echo "hidden";} ?>" data-question="<?php echo $i++; ?>">
                    <h5 class="q-title mt-40 mb-40"><?php echo $question->question_lang; ?></h5>
                    <?php $a = 1; ?>
                    <?php foreach ($question->quizquestionschoice as $choice) { ?>


                        <div class="form-check mb-40">
                            <input class="form-check-input" type="radio" data-alternatetype="radio" name="question<?php echo $question->id; ?>" data-alternateName="answer[<?php echo $i - 2; ?>]" data-alternateValue="<?php echo $choice->choice; ?>" value="<?php echo $choice->id; ?>"  id="answer-<?php echo $i - 2; ?>-<?php echo $a++; ?>">
                            <label class="form-check-label exam_question" for="exampleRadios1">
                                <?php echo $choice->choice_lang; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <input type="hidden" value="1" id="currentQuestionNumber" name="currentQuestionNumber" />
            <input type="hidden" value="<?php echo sizeof($model->quizquestions); ?>" id="totalOfQuestion" name="totalOfQuestion" />
            <input type="hidden" value="[]" id="markedQuestion" name="markedQuestions" />

    <!--            <div class="form_row form_submit mtmd">-->
    <!--                <a href="javascript:void(0);" id="go-to-next-question" class="button button_primary button_shadow" style="margin-left: 3px">السؤال التالي</a>-->
    <!--                <a href="javascript:void(0);" id="finishExams" class="button button_primary button_shadow disabled"  style="margin-left: 3px"  data-toggle="modal" data-target="#examModal">حفظ الإجابات</a>-->
    <!--                <a href="javascript:void(0);" id="back-to-prev-question" class="button button_primary button_shadow disabled"  style="margin-left: 3px">السؤال السابق</a>-->
    <!--            </div>-->


            <div class="action-bar mb-40 next-step">
                <div class="row">
                    <div class="col-md-10 mb-20 d-none">
                        <div class="flexBetween">
                            <a class="view-more-section disabled" id="back-to-prev-question" href="javascript:void(0);"><i class="flaticon-left-arrow"></i> <span> {{ trans('website.Back') }}</span></a>
                            <a class="view-more-section" id="go-to-next-question" href="javascript:void(0);"><span>{{ trans('website.Next') }}</span> <i class="flaticon-right-arrow-1"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2 mb-20 flexCenter">
                        <a class="view-more-section" id="finishExams" data-toggle="modal" data-target="#examModal"  href="javascript:void(0);" >
                            <span> {{ trans('website.Finish') }}</span></a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>


{{--  <?php // var_dump($model->quizquestions);die;?>

<script src="{{ asset('public/website') }}/js/jquery-3.3.1.min.js"></script>
<!-- Required -->  --}}


<script src="{{ asset('public/website') }}/js/examwizard.min.js"></script>
<script>
    function formSubmit()
{
    document.getElementById("examwizard-question").submit();
}

    var examWizard = $.fn.examWizard({
        finishOption: {
            enableModal: true,
            callBack: function () {
//                $( "#examwizard-question" ).submit();
            }
        },
        quickAccessOption: {
            quickAccessPagerItem: 9,
        },
    });

    
</script>



<div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="mt-20 mb-40 text-center">{{ trans('website.Are you sure you want to finish this exam?') }} </h3>
                <div class="flexCenter">
                    <button type="button" onclick="formSubmit()" class="add-to-cart mr-20 finishFinalExam" style="margin-left: 5px;">{{ trans('website.save answers to finish the exam') }}</button>
                    <button type="button" class="add-to-cart ml-20 button_default" data-dismiss="modal"> {{ trans('website.close') }}</button>

                </div>
            </div>
        </div>
    </div>



</div>

@endsection
