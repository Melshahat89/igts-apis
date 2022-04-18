		<tr>
			<th>
			{{ trans( "quiz.quiz") }}
			</th>
			<td>
				@php $quiz = App\Application\Model\Quiz::find($item->quiz_id);  @endphp
				{{ is_json($quiz->title) ? getDefaultValueKey($quiz->title) :  $quiz->title}}
			</td>
		</tr>
