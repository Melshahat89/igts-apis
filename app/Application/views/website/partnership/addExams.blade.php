@extends(layoutExtend('website'))
@section('title')
{{ trans('partnership.Add new course') }} | {{ trans('partnership.partnership') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@push('css')
    <style>
        .tab-content>.active {
            display: inline;
        }

        .settings-container .input-item {
            padding-left: 35px;
        }

        .nav-link {
            color: #244092;
        }

    </style>
@endpush
@section('content')
    <div class="bread-crumb">
        <div class="container">
            <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.Add new course') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1 class="mt-20 mb-20">{{ trans('partnership.Add new course') }}</h1>
        </div>
    </div>

    


    <section class="settings-container">
      <div class="contianer">
        <div class="cntrls_btns">
          <a class="active cntrl-btn" href="{{ url('partnership/addCourse/'.$course->id) }}">{{ trans('partnership.Course') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addLectures/'.$course->id) }}">{{ trans('courses.lectures') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addResources/'.$course->id) }}">{{ trans('courses.Resources') }}</a>
          <a class="active cntrl-btn" href="{{ url('partnership/addExams/'.$course->id) }}">{{ trans('partnership.Exams') }}</a>
    </div>
        
          
        <div class="partnership_form">

            @if(!isset($item))
          {{--  Add New Exam  --}}
            <form action="{{ concatenateLangToUrl('partnership/saveExams/'.$course->id) }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}

              @include(layoutMessage('website'))
              <div class="row">
                <div class="col-md-12"> 
                  <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                    <label for="title">{{ trans("quiz.title")}}</label>
                        {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "quiz",'form-control input-item') !!}
                  </div>
                    @if ($errors->has("title.en"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                        <strong>{{ $errors->first("title.en") }}</strong>
                        </span>
                        </div>
                    @endif
                    @if ($errors->has("title.ar"))
                        <div class="alert alert-danger">
                        <span class='help-block'>
                        <strong>{{ $errors->first("title.ar") }}</strong>
                        </span>
                        </div>
                    @endif

                    <div class="form-group {{ $errors->has("time") ? "has-error" : "" }}" > 
                      <label for="time">{{ trans("quiz.time_in_mins")}}</label>
                        <input type="text" name="time" class="form-control time" id="time" value="{{ isset($item->time) ? $item->time : old("time") }}"  placeholder="{{ trans("quiz.time_in_mins")}}" > 
                     </div>
                      @if ($errors->has("time"))
                       <div class="alert alert-danger">
                        <span class='help-block'>
                         <strong>{{ $errors->first("time") }}</strong>
                        </span>
                       </div>
                      @endif

                    

                        <div class="form-group {{ $errors->has("pass_percentage") ? "has-error" : "" }}" > 
                          <label for="pass_percentage">{{ trans("quiz.pass_percentage")}}</label>
                           <input type="text" name="pass_percentage" class="form-control" id="pass_percentage" value="{{ isset($item->pass_percentage) ? $item->pass_percentage : old("pass_percentage") }}"  placeholder="{{ trans("quiz.pass_percentage")}}">
                         </div>
                          @if ($errors->has("pass_percentage"))
                           <div class="alert alert-danger">
                            <span class='help-block'>
                             <strong>{{ $errors->first("pass_percentage") }}</strong>
                            </span>
                           </div>
                          @endif
                </div>
              </div>

              <div class="col-md-12 mt-20">
                <div class="text-center">
        
                  <button class="submit_crtl">
                    {{ trans('partnership.Add Exam') }}
                  </button>
        
                </div>
              </div>
          </form>

          @endif
         
          @isset($item)
            <i class="divid"></i>
            {{--  Add New Question  --}}
            <form action="{{ concatenateLangToUrl('partnership/saveQuestion/'.$course->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}

                    @include(layoutMessage('website'))
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group  {{  $errors->has("question.en")  &&  $errors->has("question.ar")  ? "has-error" : "" }}" >
                          <label for="question">{{ trans("quizquestions.question")}}</label>
                              {!! extractFiled(isset($item) ? $item : null , "question", old("question") , "text" , "quizquestions",'form-control input-item') !!}
                        </div>
                          @if ($errors->has("question.en"))
                              <div class="alert alert-danger">
                              <span class='help-block'>
                              <strong>{{ $errors->first("question.en") }}</strong>
                              </span>
                              </div>
                          @endif
                          @if ($errors->has("question.ar"))
                              <div class="alert alert-danger">
                              <span class='help-block'>
                              <strong>{{ $errors->first("question.ar") }}</strong>
                              </span>
                              </div>
                          @endif
                      </div>
                    </div>

                    <div class="col-md-12 mt-20">
                      <div class="text-center">
                        <button class="submit_crtl">
                          {{ trans('partnership.Add Question') }}
                        </button>
                      </div>
                    </div>
            </form>

            <i class="divid"></i>
            {{--  Add New Answer  --}}
            <form action="{{ concatenateLangToUrl('partnership/saveAnswer/'.$course->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}

                    @include(layoutMessage('website'))
                    <div class="row">
                      <div class="col-md-12"> 

                        <div class="form-group {{ $errors->has("quizquestions_id") ? "has-error" : "" }}" > 
                          <label for="quizquestions_id">{{ trans("quizquestionschoice.quizquestions_id")}}</label>                  
                          <select required name="quizquestions_id"  class="form-control input-item select-custom" >
                            @isset($questions)
                              @foreach( $questions as $key => $question)
                                <option value="{{ $question->id }}"> {{ $question->question_lang}}</option>
                              @endforeach
                            @endisset
                          </select>

                          </div>
                          @if ($errors->has("quizquestions_id"))
                          <div class="alert alert-danger">
                            <span class='help-block'>
                            <strong>{{ $errors->first("quizquestions_id") }}</strong>
                            </span>
                          </div>
                          @endif

                        <div class="form-group  {{  $errors->has("choice.en")  &&  $errors->has("choice.ar")  ? "has-error" : "" }}" >
                          <label for="choice">{{ trans("quizquestionschoice.choice")}}</label>
                              {!! extractFiled(isset($item) ? $item : null , "choice", old("choice") , "text" , "quizquestionschoice",'form-control input-item') !!}
                        </div>
                          @if ($errors->has("choice.en"))
                              <div class="alert alert-danger">
                              <span class='help-block'>
                              <strong>{{ $errors->first("choice.en") }}</strong>
                              </span>
                              </div>
                          @endif
                          @if ($errors->has("choice.ar"))
                              <div class="alert alert-danger">
                              <span class='help-block'>
                              <strong>{{ $errors->first("choice.ar") }}</strong>
                              </span>
                              </div>
                          @endif


                          <div class="form-group {{ $errors->has("is_correct") ? "has-error" : "" }}" > 
                            <label for="is_correct">{{ trans("quizquestionschoice.is_correct")}}</label>
                              <div class="form-check">
                              <label class="form-check-label">
                              <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 0 ? "checked" : "" }} type="radio" value="0" > 
                              {{ trans("quizquestionschoice.No")}}
                              </label > 
                            <label class="form-check-label">
                            <input class="form-check-input" name="is_correct" {{ isset($item->is_correct) && $item->is_correct == 1 ? "checked" : "" }} type="radio" value="1" > 
                                  {{ trans("quizquestionschoice.Yes")}}
                              </label> 
                            </div> 		</div>
                            @if ($errors->has("is_correct"))
                            <div class="alert alert-danger">
                              <span class='help-block'>
                              <strong>{{ $errors->first("is_correct") }}</strong>
                              </span>
                            </div>
                            @endif
                      </div>
                    </div>

                    <div class="col-md-12 mt-20">
                      <div class="text-center">
                        <button class="submit_crtl">
                          {{ trans('partnership.Add Answer') }}
                        </button>
                      </div>
                    </div>
            </form>
          @endisset




          <div class="col-md-11 view-area">
            <div class="accordion course-accordion" id="accordionExample">
              

                @isset($questions)
                  @foreach($questions as $key => $question)
                  <div class="card">
                    <div class="card-header" id="heading-{{ $question->id }}">
                      <h2 class="mb-0">
                        <div type="button" class="btn flexBetween" data-toggle="collapse" data-target="#collapse-{{ $question->id }}">
                            <div class="acco-title flexLeft">
                              <img class="mr-10" src="{{ asset('public/partnership') }}/images/new/drag.png" >
                              <span>{{ $question->question_lang }}</span>
                            </div>
                        <div class="flexBetween">
                          {{--  <a href="#lecture-data" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/add.png" alt="..." ></a>
                          <button type="button" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/edit.png" alt="..." ></button>
                          <button type="button" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/remove.png" alt="..." ></button>  --}}
                        </div> 
                      </div>									
                      </h2>
                    </div>
                    <div id="collapse-{{ $question->id }}" class="collapse {{ ($key == 0)?'show':'' }}" aria-labelledby="heading-{{ $question->id }}" data-parent="#accordionExample">
                      @isset($question->quizquestionschoice)
                        @foreach($question->quizquestionschoice as $key => $choice)
                          <div class="course-line flexBetween watched">
                            <div class="flexLeft">
                              <img class="mr-10" src="{{ asset('public/partnership') }}/images/new/{{ ($choice->is_correct == 1)?'correct.png':'drag.png' }}">
                              

                              <i class="flaticon-play-button mr-10 ml-20"></i>
                              {{ $choice->choice_lang }}
                            </div>
                            <div class="flexBetween">
                                {{--  <a type="button" href="{{ url('partnership/item/'.$choice->id) }}" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/edit.png" alt="..." ></a>  --}}

                                {{--  <a type="button" href="{{ url('partnership/'.$choice->id.'/delete') }}" class="custom-add-btn"><img  src="{{ asset('public/partnership') }}/images/new/remove.png" alt="..." ></a>  --}}
                            
                            </div>
                          </div>
                        @endforeach
                      @endisset
                    </div>
                  </div>
                  @endforeach
                @endisset
    
          </div>
          </div>

        </div>
      </div>









          <div class="cntrls-content col-md-6">
            <div class="row">
              <div class="col-md-12 mt-40">
                <div class="text-center flexBetween">
                  <a href="{{ url('partnership/addResources/'.$course->id) }}" class="submit_crtl">
                    {{ trans('website.Back') }}
                  </a>
                  <a href="{{ url('partnership/myCourses') }}" class="submit_crtl">
                    {{ trans('website.Finish') }}
                  </a>
                </div>
              </div>
            </div>
          </div>

       

      </div>
    </section>
    
      
  

@endsection