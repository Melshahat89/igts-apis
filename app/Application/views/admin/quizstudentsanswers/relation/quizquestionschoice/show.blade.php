		<tr>
			<th>
			{{ trans( "quizquestionschoice.quizquestionschoice") }}
			</th>
			<td>
				@php $quizquestionschoice = App\Application\Model\Quizquestionschoice::find($item->quizquestionschoice_id);  @endphp
				{{ is_json($quizquestionschoice->choice) ? getDefaultValueKey($quizquestionschoice->choice) :  $quizquestionschoice->choice}}
			</td>
		</tr>
