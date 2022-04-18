		<tr>
			<th>
			{{ trans( "quizstudentsstatus.quizstudentsstatus") }}
			</th>
			<td>
				@php $quizstudentsstatus = App\Application\Model\Quizstudentsstatus::find($item->quizstudentsstatus_id);  @endphp
				{{ is_json($quizstudentsstatus->id) ? getDefaultValueKey($quizstudentsstatus->id) :  $quizstudentsstatus->id}}
			</td>
		</tr>
