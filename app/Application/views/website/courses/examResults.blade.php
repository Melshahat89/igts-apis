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
@section('content')

<main class="main_content">

	<section class="sec sec_pad_top sec_pad_bottom">
		<div class="wrapper">
                        <?php if($isPassed == 1){?>
                            <section class="questions mt-40">
                                <div class="container">
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('public/website') }}/images/succes.svg" alt="..." >
                                        </div>
                                        <div class="col-md-8 succes-container">
                                            <div class="grade mt-20">
                                                <h1><?php echo $percentage . "%";?></h1>
                                                <span><strong> {{ trans('website.Congratulations') }} ,</strong>
                                                  {{ trans('website.You are passed the exam successfully') }}
                                                </span>
                                            </div>
                                            <br>
                                            <p class="succes-msg mb-10"><i class="right-answers" ></i> <?php echo $correctansweredQuestions;?>  {{ trans('website.Correct answers') }} </p>
                                            <p class="wrong-msg mb-10"><i class="wrong-answers" ></i> <?php echo $totalQuestions - $correctansweredQuestions;?>  {{ trans('website.Wrong answers') }}</p>
                                            <p class="total-msg mb-10"><i class="all-answers" ></i> <?php echo $totalQuestions;?>  {{ trans('website.Total questions') }}</p>
                                        </div>
                                    </div>

                                    @if(!$certificate)
                                        <div class="action">
                                            <a class="button button_primary button_large m-4 d-flex justify-content-center text_capitalize" data-toggle="modal" data-target="#addNameToCertificate" href="#">
                                                <span>{{ trans('website.Create Certificate') }} </span></a>
                                        </div>
                                    @else
                                        <div class="action">
                                            <a class="button button_primary button_large m-4 d-flex justify-content-center text_capitalize" href="{{url('/account/myCertificates')}}" ><span>{{ trans('website.View Certificate') }} </span></a>
                                        </div>
                                    @endif
                                    <div class="action">
                                        <a class="button button_primary button_large m-4 d-flex justify-content-center text_capitalize" href="{{url('/quiz/answers')}}/{{$studentExam->id}}" ><span>{{ trans('website.View Answers') }} </span></a>
                                    </div>
                                </div>


                            </section>

                        <?php }else{?>
                            <section class="questions mt-40">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('public/website') }}/images/fail.svg" alt="..." >
                                        </div>
                                        <div class="col-md-8 succes-container fail-container">
                                            <div class="grade mt-20">
                                                <h1><?php echo $percentage . "%";?></h1>
                                                <span><strong>{{ trans('website.Unfortunately') }} ,</strong>
                                                   {{ trans('website.You are failed to pass the exam') }}</span>
                                            </div>
                                            <br>
                                            <p class="succes-msg mb-10"><i class="right-answers" ></i> <?php echo $correctansweredQuestions;?>  {{ trans('website.Correct answers') }} </p>
                                            <p class="wrong-msg mb-10"><i class="wrong-answers" ></i> <?php echo $totalQuestions - $correctansweredQuestions;?>  {{ trans('website.Wrong answers') }}</p>
                                            <p class="total-msg mb-10"><i class="all-answers" ></i> <?php echo $totalQuestions;?>  {{ trans('website.Total questions') }}</p>
                                        </div>
                                    </div>
                                    <div class="action-bar flexRight  mt-40 mb-40 next-step">
                                        <a class="view-more-section ml-10 mb-10 disable-reexam-btn" ><span>{{ trans('website.Re-Exam on') }}<?php echo date(" Y-m-d", ($studentExam->start_time + 14*24*60*60))?> </span></a>
                                    </div>
                                    <div class="action">
                                        <a class="button button_primary button_large m-4 d-flex justify-content-center text_capitalize" href="{{url('/quiz/answers')}}/{{$studentExam->id}}" ><span>{{ trans('website.View Answers') }} </span></a>
                                    </div>
                                </div>

                            </section>
                        <?php }?>
                        

		</div>
	</section>

</main>



@if(!$certificate && $isPassed == 1)
    {{--  Yii::app()->clientScript->registerScript("certGenerate",'
        $("#genButton").trigger("click");
');  --}}

@endif


<div class="modal fade" id="addNameToCertificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="mt-20 mb-40 text-center">
                    {{ trans('website.Type your name that will be used in certificate') }}
                    </h5>
                   
                    <form id="examwizard-question" method="post" class="login-form">
                    {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control input-item user-login-ico" name="name" placeholder="Full Name" aria-label="Username">
                        </div>

                        <div class="text-center">

                            <button type="submit"  class="add-to-cart">
                                {{ trans('website.Submit') }}
                            </button>
                        </div>
                    </form>

                <div class="text_center ptmd pbmd bb" >
                    <h6>
                    {{ trans('website.The name must be in English') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
