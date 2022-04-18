@php $quiz = App\Application\Model\Quiz::where('courses_id', $id)->first();  @endphp

@if(isset($quiz))
    <a href="{{ url('/lazyadmin/quiz/item/'.$quiz->id) }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
        <i class="file-icons">Quiz</i>
    </a>
@else
    <button class="btn btn-danger">Missing</button>
@endif