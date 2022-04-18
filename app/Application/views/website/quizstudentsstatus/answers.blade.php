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

        <table class="table">
            <thead>
                <tr>
                    <th>
                        Question
                    </th>
                    <th>
                        Answer
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizStudentStatus->quizstudentsanswers as $answer)
                <tr>
                    <td>
                        {{ $answer->quizquestions->question }}
                    </td>
                    <td>
                        {{ $answer->quizquestionschoice->choice }}
                        @if($answer->quizquestionschoice->id == $answer->quizquestions->quizquestionschoicecorrect[0]->id)
                            <i class="fas fa-check" style="color: green;"></i>
                        @else
                            <i class="fas fa-times" style="color: red;"></i>
                        @endif
                         
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

		</div>

        <div class="action" style="width: 20%;">
            <a class="button button_primary button_large m-4 d-flex justify-content-center text_capitalize" href="{{url('/courses/examResults')}}/{{$course->slug}}" ><span>{{ trans('website.Back') }} </span></a>
        </div>
	</section>

</main>



@endsection
