@php $quiz = App\Application\Model\Quiz::find($quiz_id);  @endphp
{{ isset($quiz->title) ? $quiz->title_lang : $quiz->id }}