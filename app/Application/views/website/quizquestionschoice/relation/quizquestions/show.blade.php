		<tr>
			<th>
			{{ trans( "quizquestions.quizquestions") }}
			</th>
			<td>
				@php $quizquestions = App\Application\Model\Quizquestions::find($item->quizquestions_id);  @endphp
				{{ is_json($quizquestions->question) ? getDefaultValueKey($quizquestions->question) :  $quizquestions->question}}
			</td>
		</tr>
