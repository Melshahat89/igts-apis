@extends(layoutExtend())
  @section('title')
    {{ trans('quizstudentsstatus.quizstudentsstatus') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('quizstudentsstatus.quizstudentsstatus') , 'model' => 'quizstudentsstatus' , 'action' => trans('home.view')  ])
@php
use App\Application\Model\Quiz;
@endphp

    <table class="table">

    <thead>
      <tr>
        <th>
          Passing Percentage
</th>
<th>
  Student's Percentage
</th>
<th>
  Student Exam Status
</th>
</tr>
</thead>

<tbody>
@php
  $quizSum = $item->quiz->quizSum;
  $studentSum = Quiz::currentStudentMark($item->id);
  $studentPercentage =  (int) round($studentSum / $quizSum * 100);
@endphp
<tr>
  <td>
    {{ $item->quiz->pass_percentage }}%
</td>
<td>
    {{ $studentPercentage }}%
</td>
<td>
<span class="badge badge-warning">{{ ($item->passed == 1) ? 'Passed' : 'Failed' }}</span>

</td>
</tr>

</tbody>

</table>


   <table class="table table-bordered  table-striped" > 

    <thead>
      <tr>
        <th>Question</th>
        <th>Student's Answer</th>
        <th>Correct Answer</th>
</tr>
</thead>
<tbody>
@foreach($item->quizstudentsanswers as $answer)
<tr>
  <td>
    {{ $answer->quizquestions->question }}
</td>

  <td class="{{ ($answer->quizquestionschoice->id == $answer->quizquestions->quizquestionschoicecorrect[0]->id) ? 'correct' : 'wrong' }}">
    {{ $answer->quizquestionschoice->choice }}
</td>
<td>
    {{ $answer->quizquestions->quizquestionschoicecorrect[0]->choice }}
</td>
</tr>
@endforeach
  
</tbody>

  </table>
    @endcomponent
@endsection
