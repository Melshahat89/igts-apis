@extends(layoutExtend())
@section('title')
{{ trans('quiz.quiz') }} {{ isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('content')
@component(layoutForm() , ['title' => trans('quiz.quiz') , 'model' => 'quiz' , 'action' => isset($item) ? trans('home.edit') : trans('home.add') ])
@include(layoutMessage())

<div class="tabs-container">

  
      <!--    START QUIZ QUESTIONS    -->

      <div class="admin-course-content">
          <button class="btn btn-primary pb-4" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/quizquestions/item', '', {{$item->id}})">Add new Question</button>
      </div>

      <div class="accordion" id="accordionQuestions">
      @foreach($data['questions'] as $question)
      <div class="list-questions" id="{{$question->id}}">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#sec-{{$question->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{ $question->question_lang }}
                            </button>
                            <button class="btn btn-primary test" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/quizquestions/item/', {{$question->id}})">
                                Edit
                            </button>
                            <!-- <button class="btn btn-primary test" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/quizquestionschoice/item/')">
                                Add Answer
                            </button> -->
                            <a href="/lazyadmin/quizquestions/{{$question->id}}/delete" class="btn btn-danger" type="button" onclick="return confirm('Are you sure you want to delete this item?');">
                                Remove
                            </a>
                        </h5>
                    </div>

                    <div id="sec-{{$question->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionQuestions">
                        <div class="card-body">
                            <ul class="sortable sortable-style" id="{{$question->id}}">
                                @foreach($question->quizquestionschoice as $choice)

                                <li class="ui-state-default lecture-li row list-lectures-{{$question->id}}" id="{{$choice->id}}">
                                      <div class="d-flex justify-content-between" style="{{ ($choice->is_correct == 1) ? 'background-color: #5ada56;' : '' }}">
                                        <p>{{ $choice->choice_lang }}</p>
                                        <button class="btn btn-primary test" type="button" data-toggle="modal" data-target="#exampleModal" onclick="loadWidget('/quizquestionschoice/item/', {{$choice->id}})">
                                            Edit
                                        </button>
                                        <a href="/lazyadmin/quizquestionschoice/{{$choice->id}}/delete" class="btn btn-danger" type="button" onclick="return confirm('Are you sure you want to delete this item?');">
                                            Remove
                                        </a>
                                    </div>

                                </li>


                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
</div>
@endforeach
     
      <!--    END QUIZ QUESTIONS    -->

    </div>
  </div>


@endcomponent
@endsection