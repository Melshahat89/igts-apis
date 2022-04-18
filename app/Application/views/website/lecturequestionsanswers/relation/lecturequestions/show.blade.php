		<tr>
			<th>
			{{ trans( "lecturequestions.lecturequestions") }}
			</th>
			<td>
				@php $lecturequestions = App\Application\Model\Lecturequestions::find($item->lecturequestions_id);  @endphp
				{{ is_json($lecturequestions->question_title) ? getDefaultValueKey($lecturequestions->question_title) :  $lecturequestions->question_title}}
			</td>
		</tr>
